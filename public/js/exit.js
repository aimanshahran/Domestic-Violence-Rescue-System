function getAway() {
    // Clear DOM to tackle with slow internet connection
    document.title = "Unable to load the page";
    document.body.innerHTML = "Unable to load the page";
    $("body").hide();
    //Clear history
    const quickExitCookieName = "quick-exit-fired";
    var Backlen=history.length;
    history.go(-Backlen);
    sessionStorage.setItem(quickExitCookieName, 1);
    // Get away right now
    // Replace current site with another benign site
    document.body.innerHTML = '';
    setTimeout(function() {
        window.location.replace('http://beta-host.co.uk/');
    }, 100);
    window.open("https://www.google.com.my/", "_newtab");

}

$(function() {

    $("#get-away").on("click", function(e) {
        e.preventDefault();
        getAway();
    });

    $("#get-away a").on("click", function(e) {
        // allow the (?) link to work
        e.preventDefault();
        e.stopPropagation();
    });

    $(document).keyup(function(e) {
        if (e.keyCode == 27) { // escape key
            e.preventDefault();
            getAway();
        }
    });

});

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
