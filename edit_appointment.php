<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$index = $_GET['index'];

$xml = new DOMDocument();
$xml->load('appointments.xml');
$xpath = new DOMXPath($xml);
$appointment = $xpath->query($index)->item(0);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appointment->getElementsByTagName('date')->item(0)->nodeValue = $_POST['date'];
    $appointment->getElementsByTagName('time')->item(0)->nodeValue = $_POST['time'];
    $appointment->getElementsByTagName('description')->item(0)->nodeValue = $_POST['description'];
    $xml->save('appointments.xml');

    header('Location: view_appointment.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Appointment</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Edit Appointment</h2>
        <form method="post" action="edit_appointment.php?index=<?php echo urlencode($index); ?>">
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date" value="<?php echo $appointment->getElementsByTagName('date')->item(0)->nodeValue; ?>" required>
            </div>
            <div class="form-group">
                <label for="time">Time:</label>
                <input type="time" class="form-control" id="time" name="time" value="<?php echo $appointment->getElementsByTagName('time')->item(0)->nodeValue; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required><?php echo $appointment->getElementsByTagName('description')->item(0)->nodeValue; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.amazonaws.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
