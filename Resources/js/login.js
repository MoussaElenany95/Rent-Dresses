$(function () {
    window.onbeforeunload = function() {
        localStorage.setItem("username", $('#username').val());
    };

    window.onload = function() {

        var username = localStorage.getItem("username");
        $('#username').val(username);

    };

});