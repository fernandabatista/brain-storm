
$(document).ready(function(){

    $("#hide").click(function(){
        $("#hide").hide();
        $("#hdnform").removeClass("hidden");
    });
    $("#show").click(function(){
        $("p").show();
    });
});


function openNav() {
    document.getElementById("mySidenav").classList.add('col-sm-3');
    document.getElementById("mySidenav").classList.remove('col-sm-0');
}

function closeNav() {
    document.getElementById("mySidenav").classList.remove('col-sm-3');
    document.getElementById("mySidenav").classList.add('col-sm-0');
}
