<?php
// Assuming you have already established a connection to your database using PDO
require('config.php');



if (isset($_POST['region'])) {
  $selectedRegion = $_POST['region'];

  // Fetch cities in the selected region
  $citiesQuery = $pdo->prepare("SELECT code, nom FROM ville WHERE coderg = :region");
  $citiesQuery->bindParam(':region', $selectedRegion);
  $citiesQuery->execute();
  $cities = $citiesQuery->fetchAll(PDO::FETCH_ASSOC);

  // Generate HTML options for cities
  $options = '';
  foreach ($cities as $city) {
    $options .= '<option value="' . $city['code'] . '">' . $city['nom'] . '</option>';
  }

  echo '<label for="city">Select a city:</label>';
  echo '<select name="city" id="city">';
  echo '<option value="">-- Select City --</option>';
  echo $options;
  echo '</select>';
  echo "<br>";
  echo "<label>Enter the address:</label>";
  echo "<input name='adresse' type='text'>";
  echo "<input type='submit' name='a'>";
}
?>
