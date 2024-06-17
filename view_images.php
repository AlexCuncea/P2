<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$xml = new DOMDocument();
$xml->load('images.xml');
$images = $xml->getElementsByTagName('image');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Images</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Uploaded Images</h2>
        <div class="row">
            <?php foreach ($images as $image): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?php echo $image->getElementsByTagName('path')->item(0)->nodeValue; ?>" class="card-img-top" alt="<?php echo $image->getElementsByTagName('name')->item(0)->nodeValue; ?>">
                        <div class="card-body">
                            <p class="card-text"><?php echo $image->getElementsByTagName('name')->item(0)->nodeValue; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
