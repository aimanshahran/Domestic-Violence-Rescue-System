(function () {

    let lastScrollTop = 0;
    let scrollEvery = 0;
    let noMoreMessages = false;
    let alreadyLoadedLatestMessages = false;

    $(".chat-toggle").on("click", function (e) {
        e.preventDefault();

        let ele = $(this);

        let user_id = ele.attr("data-id");

        let username = ele.attr("data-user");

        openChatBox(user_id, username,  () => {

            let chatBox = $("#chat_box_" + user_id);

            if(!chatBox.hasClass("chat-opened")) {

                chatBox.addClass("chat-opened").slideDown("fast");

                if(!alreadyLoadedLatestMessages) {
                    loadLatestMessages(chatBox, user_id, (response) => {
                        alreadyLoadedLatestMessages = true;
                    });
                }
                chatBox.find(".chat-area").animate({scrollTop: chatBox.find(".chat-area").outerHeight(true)}, 800, 'swing');
            }
        });
    });

    // on close chat close the chat box but don't remove it from the dom
    $(".close-chat").on("click", function (e) {
        $(this).parents("div.chat-opened").removeClass("chat-opened").slideUp("fast");
    });

    // on click the btn send the message
    $(".btn-chat").on("click", function (e) {
        send($(this).attr('data-to-user'), $("#chat_box_" + $(this).attr('data-to-user')).find(".chat_input").val(), null);
    });

    $(".emoji").on("click", function (e) {
        e.preventDefault();
        const textinput = $(this).parents(".chat-opened").find(".chat_input");

        textinput.val(textinput.val() + $(this).text());

        $(this).parents(".chat-opened").find(".btn-chat").prop("disabled", false);
        //send($(this).parents(".chat-opened").find('.to_user_id').val(), $(this).text(), null);

    });

    $(".upload-btn").on("click", function () {
        $(this).parents(".panel-footer").find(".image").trigger("click");
    });

    $(".image").on("change", function () {
        $(this).parent(".upload-frm").submit();
    });

    $(".upload-frm").on("submit", function (e) {
        e.preventDefault();
        send($(this).parents(".chat-opened").find('.to_user_id').val(), null, $(this).find('.image')[0].files[0]);
    });

    // on change chat input text toggle the chat btn disabled state
    $(".chat_input").on("change keyup", function (e) {
        if($(this).val() != "") {
            $(this).parents(".form-controls").find(".btn-chat").prop("disabled", false);
        } else {
            $(this).parents(".form-controls").find(".btn-chat").prop("disabled", true);
        }
    });

    // handle the scroll top of any chat box
    // the idea is to load the last messages by date depending on last message
    // that's already loaded on the chat box
    $(".chat-area").on("scroll", function (e) {
        if(noMoreMessages) {
            return;
        }
        let st = $(this).scrollTop();

        if(st < lastScrollTop) {
            scrollEvery += 1;

            if(scrollEvery % 10 == 0) {
                fetchOldMessages($(this).parents(".chat-opened").find(".to_user_id").val(), $(this).find(".msg_container:first-child").attr("data-message-id"), (response) => {
                    noMoreMessages = response.no_more_messages;

                    if(noMoreMessages) {
                        let chatArea = $(this).parents(".chat-opened").find(".chat-area");
                        chatArea.prepend(noMoreTemplate());

                        setTimeout(() => {
                            chatArea.find(".no-more-messages").remove();
                        }, 1500);

                    }
                });
            }
        }

        lastScrollTop = st;

    });

    // here listen for pusher events
    setTimeout(() => {
        let current_user_id = $("#current_user").val();
        window.Echo.private(`chat-message.${current_user_id}`)
            .listen('.message.sent', (e) => {
                displayReceiverMessage(e.message);
            });
    }, 200);

})();

function openChatBox(user_id, username, callback)
{

    if($("#chat_box_" + user_id).length == 0) {

        let cloned = $("#chat_box").clone(true);

        // change cloned box id
        cloned.attr("id", "chat_box_" + user_id);

        cloned.find(".chat-user").text(username);

        cloned.find(".btn-chat").attr("data-to-user", user_id);

        cloned.find(".to_user_id").val(user_id);

        $("#chat-overlay").append(cloned);
    }

    $("#chat_box_" + user_id).show();

    if(callback) {
        callback();
    }
}

/**
 * send message function
 *
 * @param to_user
 * @param message
 */
function send(to_user, message, file)
{
    let chat_box = $("#chat_box_" + to_user);
    let chat_area = chat_box.find(".chat-area");

    let formData = new FormData();
    formData.append("to_user", to_user);
    formData.append("_token", $("meta[name='csrf-token']").attr("content"));
    formData.append("message", message);
    formData.append("image", file);


    $.ajax({
        url: window.base_url + "/send",
        data: formData,
        method: "POST",
        dataType: "json",
        processData: false,
        contentType: false,
        beforeSend: function () {
            if(chat_area.find(".loader").length  == 0) {
                chat_area.append(loaderHtml());
            }
        },
        success: function (response) {
            displaySenderMessage(response.message);
        },
        complete: function () {
            chat_area.find(".loader").remove();
            chat_box.find(".btn-chat").prop("disabled", true);
            chat_box.find(".chat_input").val("");
            //chat_area.animate({scrollTop: chat_area.offset().top + chat_area.outerHeight(true)}, 800, 'swing');
        }
    });
}

function loaderHtml() {
    return `<i class="glyphicon glyphicon-refresh loader"></i>`;
}


/**
 * display message on the sender side
 *
 * @param message
 */
function displaySenderMessage(message)
{
    if($("#current_user").val() == message.from_user.id) {

        let messageLine = getMessageSenderTemplate(message);

        $("#chat_box_" + message.to_user.id).find(".chat-area").append(messageLine);

    }
}

/**
 * display message on the receiver side
 *
 * @param message
 */
function displayReceiverMessage(message)
{
    if($("#current_user").val() == message.to_user.id) {
        let alert_sound = document.getElementById("chat-alert-sound");

        alert_sound.play();

        // for the receiver user check if the chat box is already opened otherwise open it
        openChatBox(message.from_user.id, message.from_user.name,  () => {

            let chatBox = $("#chat_box_" + message.from_user.id);

            if(!chatBox.hasClass("chat-opened")) {

                chatBox.addClass("chat-opened").slideDown("fast");

                loadLatestMessages(chatBox, message.from_user.id);

                chatBox.find(".chat-area").animate({scrollTop: chatBox.find(".chat-area").outerHeight(true)}, 800, 'swing');
            } else {
                if($("#message-line-"+message.id).length == 0) {
                    let messageLine = getMessageReceiverTemplate(message);

                    // append the message for the receiver user
                    $("#chat_box_" + message.from_user.id).find(".chat-area").append(messageLine);
                }
            }
        });
    }
}

/**
* loadLatestMessages
*
*/
function loadLatestMessages(container, user_id, callback = null)
{
    let chat_area = container.find(".chat-area");

    chat_area.html("");

    $.ajax({
        url: window.base_url + "/load-latest-messages",
        data: {user_id: user_id, _token: $("meta[name='csrf-token']").attr("content")},
        method: "GET",
        dataType: "json",
        beforeSend: function () {
            if(chat_area.find(".loader").length  == 0) {
                chat_area.html(loaderHtml());
            }
        },
        success: function (response) {
            if(response.state == 1) {
                response.messages.map(function (val, index) {
                    $(val).appendTo(chat_area);
                });

                if(callback) {
                    callback(response);
                }
            }
        },
        complete: function () {
            chat_area.find(".loader").remove();
        }
    });
}

/**
 * fetchOldMessages
 *
 * this function load the old messages if scroll up triggerd
 */
function fetchOldMessages(to_user, old_message_id, callback = null)
{
    let chat_box = $("#chat_box_" + to_user);
    let chat_area = chat_box.find(".chat-area");

    $.ajax({
        url: window.base_url + "/fetch-old-messages",
        data: {to_user: to_user, old_message_id: old_message_id, _token: $("meta[name='csrf-token']").attr("content")},
        method: "GET",
        dataType: "json",
        beforeSend: function () {
            if(chat_area.find(".loader").length  == 0) {
                chat_area.prepend(loaderHtml());
            }
        },
        success: function (response) {
            response.messages.map(function (val, index) {
                $(chat_area).prepend(val);
            });

            if(callback) {
                callback(response);
            }
        },
        complete: function () {
            chat_area.find(".loader").remove();
        }
    });
}

/**
 * getMessageSenderTemplate
 *
 * this is the message template for the sender
 *
 * @param message
 * @returns {string}
 */
function getMessageSenderTemplate(message)
{
    const body = getMessageBody(message);

    return `
           <div class="row msg_container base_sent" data-message-id="${message.id}" id="message-line-${message.id}">
        <div class="col-md-9 col-xs-9">
            <div class="messages msg_sent text-right">
                ${body}
                <time datetime="${message.date_time_str}"> ${message.from_user.name} • ${message.date_time_str} </time>
            </div>
        </div>
        <div class="col-md-3 col-xs-3 avatar">
            <img src="` + window.base_url +  '/images/user-avatar.png' + `" width="50" height="50" class="img-responsive">
        </div>
    </div>
    `;
}

/**
 * getMessageReceiverTemplate
 *
 * this is the message template for the receiver
 *
 * @param message
 * @returns {string}
 */
function getMessageReceiverTemplate(message)
{
    const body = getMessageBody(message);

    return `
           <div class="row msg_container base_receive" data-message-id="${message.id}" id="message-line-${message.id}">
           <div class="col-md-3 col-xs-3 avatar">
             <img src="` + window.base_url +  '/images/user-avatar.png' + `" width="50" height="50" class="img-responsive">
           </div>
        <div class="col-md-9 col-xs-9">
            <div class="messages msg_receive text-left">
                ${body}
                <time datetime="${message.date_time_str}"> ${message.from_user.name}  • ${message.date_human_readable} </time>
            </div>
        </div>
    </div>
    `;
}

function getMessageBody(message)
{
    let content = '';

    if(message.content) {
        content = '<p>' + message.content + '</p>';
    } else if (message.image_url) {
        content = '<div style="width: 100%;"><img class="img-responsive" src="'+message.image_url+'" /></div>';
    }

    return content;
}

function noMoreTemplate()
{
    return `<div class="no-more-messages text-center">No more messages</div>`;
}
