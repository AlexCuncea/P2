<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$currentUserEmail = $_SESSION['email'];

$xml = new DOMDocument();
$xml->load('appointments.xml');
$appointments = $xml->getElementsByTagName('appointment');

$imagesXml = new DOMDocument();
$imagesXml->load('images.xml');
$images = $imagesXml->getElementsByTagName('image');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imagePath = 'uploads/' . $imageName;

    move_uploaded_file($imageTmpName, $imagePath);

    $newImage = $imagesXml->createElement('image');
    $newImage->appendChild($imagesXml->createElement('name', $imageName));
    $newImage->appendChild($imagesXml->createElement('path', $imagePath));
    $newImage->appendChild($imagesXml->createElement('user', $currentUserEmail));

    $imagesXml->getElementsByTagName('images')->item(0)->appendChild($newImage);
    $imagesXml->save('images.xml');

    header('Location: view_appointment.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Appointments</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>My Appointments</h2>
        <a href="add_appointment.php" class="btn btn-primary mb-3">Add Appointment</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                    <?php if ($appointment->getElementsByTagName('user')->item(0)->nodeValue === $currentUserEmail): ?>
                        <tr>
                            <td><?php echo $appointment->getElementsByTagName('user')->item(0)->nodeValue; ?></td>
                            <td><?php echo $appointment->getElementsByTagName('date')->item(0)->nodeValue; ?></td>
                            <td><?php echo $appointment->getElementsByTagName('time')->item(0)->nodeValue; ?></td>
                            <td><?php echo $appointment->getElementsByTagName('description')->item(0)->nodeValue; ?></td>
                            <td>
                                <a href="edit_appointment.php?index=<?php echo $appointment->getNodePath(); ?>" class="btn btn-secondary btn-sm">Edit</a>
                                <a href="delete_appointment.php?index=<?php echo $appointment->getNodePath(); ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h2>Upload Image</h2>
        <form method="post" action="view_appointment.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
        <h2>Uploaded Images</h2>
        <div class="row">
            <?php foreach ($images as $image): ?>
                <?php if ($image->getElementsByTagName('user')->item(0)->nodeValue === $currentUserEmail): ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="<?php echo $image->getElementsByTagName('path')->item(0)->nodeValue; ?>" class="card-img-top" alt="<?php echo $image->getElementsByTagName('name')->item(0)->nodeValue; ?>">
                            <div class="card-body">
                                <p class="card-text"><?php echo $image->getElementsByTagName('name')->item(0)->nodeValue; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
