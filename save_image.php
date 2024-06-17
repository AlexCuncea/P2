<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imagePath = 'uploads/' . $imageName;

    move_uploaded_file($imageTmpName, $imagePath);

    $xml = new DOMDocument();
    $xml->load('images.xml');

    $newImage = $xml->createElement('image');
    $newImage->appendChild($xml->createElement('name', $imageName));
    $newImage->appendChild($xml->createElement('path', $imagePath));

    $xml->getElementsByTagName('images')->item(0)->appendChild($newImage);
    $xml->save('images.xml');

    echo "Image uploaded successfully.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Image</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Upload Image</h2>
        <form method="post" action="save_image.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
