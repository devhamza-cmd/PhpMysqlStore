<?php
require('config.php');
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    // Database connection using PDO


    // Prepare and execute the query to insert the image
    $stmt = $pdo->prepare('INSERT INTO images (image_data) VALUES (?)');
    $stmt->bindValue(1, file_get_contents($_FILES['image']['tmp_name']), PDO::PARAM_LOB);
    $stmt->execute();
}

// Database connection using PDO


// Retrieve all images from the database
$stmt = $pdo->query('SELECT image_data FROM images');
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Image Gallery</title>
</head>
<body>
    <h1>Image Gallery</h1>

    <?php foreach ($images as $image) : ?>
        <img src="data:image/jpeg;base64,<?= base64_encode($image['image_data']) ?>" alt="Uploaded Image"><br><br>
    <?php endforeach; ?>
    
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*">
        <input type="submit" value="Upload">
    </form>
</body>
</html>
