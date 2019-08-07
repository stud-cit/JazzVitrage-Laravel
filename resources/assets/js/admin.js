$(document).ready(function(){

    if(window.innerWidth < 992){
        // Toggle sidebar
        $(".navbar-toggler-right").click(function(e) {
            e.preventDefault();
            $("body").toggleClass("sidenav-toggled");
            $(".navbar-sidenav .nav-link-collapse").addClass("collapsed");
            $(".navbar-sidenav .sidenav-second-level").removeClass("show");
        });
    }
    $("#sidenavToggler").click(function(e) {
        e.preventDefault();
        $("body").toggleClass("sidenav-toggled");
        $(".navbar-sidenav .nav-link-collapse").addClass("collapsed");
        $(".navbar-sidenav .sidenav-second-level").removeClass("show");
    });

    // Text redactor

    $(".field-redactor").click(function(){
        $(this).htmlarea({
            // Override/Specify the Toolbar buttons to show
            toolbar: [
                ["html","bold", "italic", "underline","strikethrough"],
                ["justifyleft","justifycenter","justifyright"],
                ["p", "h1", "h2", "h3", "h4", "h5", "h6"],
                ["indent", "outdent"],
                ["link", "unlink"],
                ["orderedlist","unorderedlist"],
            ],
        });

        $(this).prev().find('iframe').focus();
    });

});