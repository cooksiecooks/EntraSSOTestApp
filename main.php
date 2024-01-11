<?php
session_start();

// Check if the user is logged in and name is set
if (!isset($_SESSION['user_name'])) {
    header('Location: index.html');
    exit;
}

$user_name = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Main Application</title>
</head>
<body>
    <h1>Login Successful</h1>
    <h2>Welcome, <?php echo htmlspecialchars($user_name); ?>!</h2>
    <a href="logout.php">Logout</a>
</body>
</html>