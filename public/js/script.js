	const rangeKm = document.getElementById("rangeKm");
	const rangePrice = document.getElementById("rangePrice");
	const rangeYear = document.getElementById("rangeYear");

	rangeKm.value = rangeKm.max;
	rangeKmMin.value = rangeKm.min;

	rangePrice.value = rangePrice.max;
	rangePriceMin.value = rangePrice.min;

	rangeYear.value = rangeYear.max;
	rangeYearMin.value = rangeYear.min;

$(function () {
		$(".car_info").addClass("visible"); 
		
  var rangeKmMin = $("#rangeKm").attr('min');
	var rangeKmMax = $("#rangeKm").attr('max');
	$("#rangeKmVal").text(rangeKmMin + " km" +  " - " + rangeKmMax + "km");

  var rangePriceMin = $("#rangePrice").attr('min');
	var rangePriceMax = $("#rangePrice").attr('max');
	$("#rangePriceVal").text(rangePriceMin + "€" +  " - " + rangePriceMax + "€");

  var rangeYearMin = $("#rangeYear").attr('min');
	var rangeYearMax = $("#rangeYear").attr('max');
	$("#rangeYearVal").text(rangeYearMin +  " - " + rangeYearMax);

 function kmChoice(){
		var rangeKm = parseInt($("#rangeKm").val());
		$("#rangeKmVal").text(rangeKmMin + " km" +  " - " + rangeKm + "km");
		var car_info = $(".car_info");
	  $(".car_km").each(function(){
				var car_km = parseInt($(this).text());
				if(car_km <= rangeKm){ 
						//si oui, on choisi le prix
			priceChoice();
			yearChoice();
				}else if(car_km > rangeKm){	
					$(this).parent().css("display", "none");
							$("#rangeKm").on("input", function(){
								$(".car_km").css("display", "block");
								$(".car_info").css("display", "block");
									priceChoice();
									yearChoice();
							});
				}else{ alert("Pas de voiture avec ces paramètres");	}
				}); 
 }
	 
function priceChoice(){
$("#rangePrice").on("input", function(){
						var rangePrice = parseInt($("#rangePrice").val());
							$("#rangePriceVal").text(rangePriceMin + "€" +  " - " + rangePrice + "€");
						var car_info = $(".car_info");
						$(".car_price").each(function(){
						var car_price = parseInt($(this).text());
								if(car_price <= rangePrice){ 
								}else if(car_price > rangePrice){
									$(this).parent().css("display", "none");
										$("#rangePrice").on("input", function(){
											$(".car_price").css("display", "block");
											$(".car_info").css("display", "block");
												priceChoice();
												yearChoice();
													});
								}else{
									console.log("Pas de proposition avec ce prix");
							}
				}); 
 });
}

function yearChoice(){
$("#rangeYear").on("input", function(){
						var rangeYear = parseInt($("#rangeYear").val());
						$("#rangeYearVal").text(rangeYearMin +  " - " + rangeYear);
						var car_info = $(".car_info");
						$(".car_year").each(function(){
						var car_year = parseInt($(this).text());
								if(car_year <= rangeYear){ 
								}else if(car_year > rangeYear){
								$(this).parent().css("display", "none");
										$("#rangeYear").on("input", function(){
											$(".car_year").css("display", "block");
									  	$(".car_info").css("display", "block"); 
									yearChoice();
										});
								
								}else{
									console.log("Pas de propositions");
							}
				}); 
 });
}

$("#rangeKm").on("change", kmChoice);
$("#rangePrice").on("change", priceChoice);
$("#rangeYear").on("change", yearChoice);

$(".btn_reload").on("click", function(){
location.reload(true);
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

