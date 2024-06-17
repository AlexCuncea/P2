<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$xml = new DOMDocument();
$xml->load('appointments.xml');
$appointments = $xml->getElementsByTagName('appointment');
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
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?php echo $appointment->getElementsByTagName('user')->item(0)->nodeValue; ?></td>
                        <td><?php echo $appointment->getElementsByTagName('date')->item(0)->nodeValue; ?></td>
                        <td><?php echo $appointment->getElementsByTagName('time')->item(0)->nodeValue; ?></td>
                        <td><?php echo $appointment->getElementsByTagName('description')->item(0)->nodeValue; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
