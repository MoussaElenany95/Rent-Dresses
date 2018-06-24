$(function () {
    window.onbeforeunload = function() {
        sessionStorage.setItem("username", $('#username').val());
    };


    if (typeof(Storage) !== "undefined") {

        var username = sessionStorage.getItem("username");
        $('#username').val(username);
    }
});