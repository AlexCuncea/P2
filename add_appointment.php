<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_SESSION['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $description = $_POST['description'];

    $xml = new DOMDocument();
    $xml->load('appointments.xml');

    $newAppointment = $xml->createElement('appointment');
    $newAppointment->appendChild($xml->createElement('user', $user));
    $newAppointment->appendChild($xml->createElement('date', $date));
    $newAppointment->appendChild($xml->createElement('time', $time));
    $newAppointment->appendChild($xml->createElement('description', $description));

    $xml->getElementsByTagName('appointments')->item(0)->appendChild($newAppointment);
    $xml->save('appointments.xml');

    header('Location: my_appointments.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Appointment</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Add Appointment</h2>
        <form method="post" action="add_appointment.php">
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">Time:</label>
                <input type="time" class="form-control" id="time" name="time" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Appointment</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
