$(document).ready(function(){

    
    $("#sidenavToggler").click(function(e) {
        e.preventDefault();
        $("body").toggleClass("sidenav-toggled");
        $(".navbar-sidenav .nav-link-collapse").addClass("collapsed");
        // $(".navbar-sidenav .sidenav-second-level").removeClass("show");
    });

    // Text redactor
   

});