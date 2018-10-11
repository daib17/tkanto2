(function () {
    'use strict';

    /**
    * Listeners
    */
    var spinner = document.getElementById("spinner");
    if (spinner != null) {
        spinner.addEventListener("click", function () {
            var value = spinner.options[spinner.selectedIndex].value;
            for (var i = 0; i < 28 ; i++) {
                if (document.getElementById("h" + i)
                .classList.contains("selected")) {
                    var hour = i;
                    var length = spinner.options[spinner.selectedIndex].value;
                }
            }
            // Redirect with parameter
            var url = window.location.href;
            var index = url.indexOf("&spinTime");
            if (index > 0) {
                window.location.href = url.substr(0, index) + "&spinTime=" + length;
            } else {
                window.location.href = url + "&spinTime=" + length;
            }

            // var index = url.indexOf("&hourId");
            // if (index > 0) {
            //     window.location.href = url.substr(0, index) + "&hourId=" + hour + "&length=" + length;
            // } else {
            //     window.location.href = url + ("&hours=") + hour + "&length=" + length;
            // }
        });
    }
})();
