
$(document).ready(function () {
    $("#info-card").hide()
    $("#card").hide()

    $("#info-card").css('visibility', 'visible');
    $("#card").css('visibility', 'visible');
});

function showCard(){
    $("#info-card").fadeIn(1000);
    $("#card").fadeIn(1000);
}

function hideCard(){
    $("#info-card").fadeOut(1000)
    $("#card").fadeOut(1000)
}   
