(function () {
    'use strict';

    /**
    * Admin - Student
    */
    var showFilter = document.getElementById("showFilter");
    if (showFilter != null) {
        showFilter.addEventListener("change", function () {
            var value = showFilter.options[showFilter.selectedIndex].value;
            // Redirect with parameter
            var url = window.location.href;
            url = url.replace("search=", "");   // Remove search param
            var index = url.indexOf("&filter");
            if (index > 0) {
                window.location.href = url.substr(0, index) + "&filter=" + value;
            } else {
                window.location.href = url + ("&filter=") + value;
            }
        });
    }

    /**
    * Admin - Planning - Time spinner
    */
    var timeSpinner = document.getElementById("timeSpinner");
    if (timeSpinner != null) {
        timeSpinner.addEventListener("change", function () {
            var time = timeSpinner.options[timeSpinner.selectedIndex].value;
            // for (var i = 0; i < 28 ; i++) {
            //     if (document.getElementById("h" + i)
            //     .classList.contains("selected")) {
            //         var hour = i;
            //         var length = value;
            //     }
            // }
            // Redirect with parameter
            var url = window.location.href;
            var index = url.indexOf("&spinTime");
            if (index > 0) {
                window.location.href = url.substr(0, index) + "&spinTime=" + time;
            } else {
                window.location.href = url + "&spinTime=" + time;
            }
        });
    }

    /**
    * Admin - Planning - Students spinner
    */
    var studentSpinner = document.getElementById("studentSpinner");
    if (studentSpinner != null) {
        studentSpinner.addEventListener("change", function () {
            var student = studentSpinner.options[studentSpinner.selectedIndex].value;
            var url = window.location.href;
            var index = url.indexOf("&spinStudent");
            if (index > 0) {
                window.location.href = url.substr(0, index) + "&spinStudent=" + student;
            } else {
                window.location.href = url + "&spinStudent=" + student;
            }
        });
    }
})();
