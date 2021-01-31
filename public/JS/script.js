$('.fa-heart').click(function(){
    let i = 0;
//
    if($(".heart").find(".far").length){
        i++
        $(".heart").find(".far").addClass("fas").removeClass("far")
    }


    else if($(".heart").find(".fas").length){
        i = 0
        $(".heart").find(".fas").addClass("far").removeClass("fas")
    }
    $('.NbLikes').text('Likes : ' + i )
});


