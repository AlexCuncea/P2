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

$appointment->parentNode->removeChild($appointment);
$xml->save('appointments.xml');

header('Location: view_appointment.php');
exit();
?>
