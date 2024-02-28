$(function () {
  $("#address").addClass("hidden");
  $("#address_show_car").addClass("hidden");

  $("#btn_address").on("click", function () {
    $("#address_show_car").removeClass("hidden");
    
  });

 
$("#equip_btn").on("click", function () {
  $("#equip_btn").css("background", "#d94350");
  $("#equip_btn").css("color", "white");
  $(".equip").removeClass("hidden");
});
$("#caracter_btn").on("click", function () {
  $("#caracter_btn").css("background", "#d94350");
  $("#caracter_btn").css("color", "white");
  $(".caract").removeClass("hidden");
});
$("#opt_btn").on("click", function () {
  $("#opt_btn").css("background", "#d94350");
  $("#opt_btn").css("color", "white");
  $(".opt").removeClass("hidden");
});

$("#contact_btn").on("click", function () {
  $("#contact_btn").css("background", "#d94350");
  $("#contact_btn").css("color", "white");
  $("#contactForm").removeClass("hidden");
});
});

