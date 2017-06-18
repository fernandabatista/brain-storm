$(function(){
  $("a.vote_up").click(function(){

   //get the id
   the_id = $(this).attr('id');

   //$(".btns#s"+the_id).hide();
   //the main ajax request
    $.ajax({
     type: "POST",
     data: "action=vote_up&id="+$(this).attr("id"),
     url: "votos.php",
     success: function(msg)
     {
        $(".btns#s"+the_id).html(msg);
     }
    });
   });

   $("a.vote_down").click(function(){

    //get the id
    the_id = $(this).attr('id');

    //$(".btns#s"+the_id).hide();
    //the main ajax request
     $.ajax({
      type: "POST",
      data: "action=vote_down&id="+$(this).attr("id"),
      url: "votos.php",
      success: function(msg)
      {
         $(".btns#s"+the_id).html("<h1>aa"+msg+"</h1>");
      }
     });
    });
});
