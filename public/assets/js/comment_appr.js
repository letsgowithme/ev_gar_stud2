$(function () {
  $("#comment_isApproved").removeClass("hidden");
  $("#comment_isProcessed").removeClass("hidden");
$("form").on("submit", function(){
$("#comment_subject").prop( "disabled", false );
  $("#comment_content").prop( "disabled", false );
  $("#comment_commentator").prop( "disabled", false );
  $("#comment_mark").prop( "disabled", false );
})
});