'use strict';

function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}

function getStudentTable() {
    setTimeout(function() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // var filter = getCookie("filter");
                // var page = getCookie("page");
                // var studentID = getCookie("studentID");
                // var search = getCookie("search");

                $('#output').replaceWith(this.response);
            }
        };
        xmlhttp.open("GET", "src/createStudentTable.php", true);
        xmlhttp.send();
    }, 1000);
}
