
(function () {
    let user_id = $("#current_user").val();

    $(".chat-toggle").on("click", function (e) {
        e.preventDefault();
alert("test");
        let ele = $(this);

        let user_id = ele.attr("data-id");

        let username = ele.attr("data-user");
    });

    window.Echo.private(`chat.${user_id}`)
        .listen('.message.sent', (e) => {
            console.log(e);
        });

})();
