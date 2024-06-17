<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Appointments</title>
</head>
<body>
    <?php
    $xml = new DOMDocument();
    $xml->load('appointments.xml');
    echo $xml->saveXML();
    ?>
</body>
</html>
