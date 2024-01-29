$(function () {

  $(".show_content_btn").on("click", function () {
    $(".contact_content").removeClass("hidden");
  
  });
 
  $(".close").on("click", function () {
    $(".contact_content").addClass("hidden");
  });
});