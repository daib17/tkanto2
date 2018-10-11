(function () {
    'use strict';

    /**
    * Listeners
    */
    var showFilter = document.getElementById("showFilter");
    if (showFilter != null) {
        showFilter.addEventListener("click", function () {
            var value = showFilter.options[showFilter.selectedIndex].value;
            // Redirect with parameter
            var url = window.location.href;
            var index = url.indexOf("&filter");
            if (index > 0) {
                window.location.href = url.substr(0, index) + "&filter=" + value;
            } else {
                window.location.href = url + ("&filter=") + value;
            }
        });
    }
})();
