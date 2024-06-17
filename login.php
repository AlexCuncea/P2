<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $xml = new DOMDocument();
    $xml->load('users.xml');

    $users = $xml->getElementsByTagName('user');
    foreach ($users as $user) {
        $xmlEmail = $user->getElementsByTagName('email')->item(0)->nodeValue;
        $xmlPassword = $user->getElementsByTagName('password')->item(0)->nodeValue;
        if ($xmlEmail == $email && password_verify($password, $xmlPassword)) {
            $_SESSION['email'] = $email;
            header('Location: index.php');
            exit();
        }
    }
    echo "Invalid email or password.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.amazonaws.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
