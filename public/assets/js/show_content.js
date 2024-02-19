$(function () {

  $(".show_content_btn").on("click", function () {
    if($(".contact_content").hasClass("hidden")) {
    $(".contact_content").removeClass("hidden");
    }else{
      $(".contact_content").addClass("hidden");
    }
  });
 
});