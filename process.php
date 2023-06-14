<?php

require('config.php');

if (isset($_POST['region'])) {

  $selectedRegion = $_POST['region'];

  $citiesQuery = $pdo->prepare("SELECT code, nom FROM ville WHERE coderg = :region");
  $citiesQuery->bindParam(':region', $selectedRegion);
  $citiesQuery->execute();
  $cities = $citiesQuery->fetchAll(PDO::FETCH_ASSOC);

  $options = '';
  foreach ($cities as $city) {
    $options .= '<option value="' . $city['code'] . '">' . $city['nom'] . '</option>';
  }

  echo '<label for="city">Select a city:</label>';
  echo '<select name="city" id="city">';
  echo '<option value="">-- Select City --</option>';
  echo $options;
  echo '</select>';
  echo "<label for='address'>Adresse:</label>";
  echo "<input type='text' name='address' id='address' required>";
  echo "<div class='d-flex'><input class='mt-2 me-2 p-2 more' type='submit' name='ajouteradrs' value='ajouter'><input name='annuleradrs' class='mt-2 p-2 more' type='reset' value='annuer'>
  </div>";

}
?>
