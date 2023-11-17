<?php 
include_once("DB.php");
if(!empty($_POST["rangeKm"])){
  $selected = "";
$sql_s_s1 = "SELECT * FROM car WHERE km=:kmChoice ORDER BY km DESC";
$query_s_s1 = $dbConnect->prepare($sql_s_s1);
$query_s_s1->execute(["kmChoice" => $_POST["rangeKm"]]);

while ($row = $query_s_s1->fetch(PDO::FETCH_ASSOC)):
  $car_id = intval($row["id"]);

?>
<div class="card  mb-3 text-sm-center car_info border" style="display: block;">
					 <div class="card-body card_body">
						<div class="car__image card-image">
						<p class="card-text text-light bg-dark rounded w-25 car_price"
						 ><?= $row["price"] ?> €</p>
							<img
						 class="main_car_img mb-3"
							src="{{ vich_uploader_asset(car, 'imageFile') }}">
						</div>
						<h4 class="card-title">
						<?= $row["title"] ?></h4>
						
						<p class="card-text fw-bold  car_year">Année : <?= $row["year"] ?></p>
                        <p class="card-text fw-bold"><?= $row["fuelType"] ?></p>
                        <p class="card-text fw-bold" id="car_km" value=""><?= $row["km"] ?><span> km</span></p>
												<hr>
												<p class="card-text text-black fw-bold"><?= $row["price"] ?> €</p>
												<p><a href="{{ path('car.show', {id: car.id}) }}" style="text-decoration: none;" class="fs-5 fw-bold text-light mt-3">Details</a></p>
					</div>
				</div> 
				<br>
<?php
endwhile;
// $query_s_s1->closeCursor();
}
?>