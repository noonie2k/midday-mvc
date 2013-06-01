/**
 * Set the Current Page in Navigation as Active
 */
$(document).ready(function () {
    "use strict";

    var topBarLinks;
    topBarLinks = $("nav.top-bar ul li");

    // Clear Active Links
    topBarLinks.removeClass("active");

    // Set Active Page
    topBarLinks.find("a[href='" + window.location.pathname + "']").parent("li").addClass("active");
});