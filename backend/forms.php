<?php
session_start();
require_once 'config/database.config.php';
require_once 'models/User.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember_me = isset($_POST['remember-me']);

    if (empty($email) || empty($password)) {
        $message = "Please enter both email and password.";
    } else {
        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['User_Password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $user['User_ID'];
            $_SESSION['email'] = $user['User_Address'];
            $_SESSION['name'] = $user['User_Name'];
            if ($user['Position'] == 'Admin' || $user['Position'] == 'Creator'){
                header("Location: ../src/app.php");
                exit();
            }
            if ($remember_me) {
                setcookie("user_email", $user['User_Address'], time() + (86400 * 30), "/", "", false, true);
            }
            header("Location: ../src/frontdesk/fd_dashboard.php");
            exit();
        } else {
            $message = "Invalid email or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Status</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Monda:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Monda', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-md text-center">
        <?php if (!empty($message)): ?>
            <p class="text-red-500 font-bold mb-4"><?php echo $message; ?></p>
            <a href="../index.php" class="text-blue-600 hover:underline">Go back to login</a>
        <?php else: ?>
            <p class="text-green-600 font-bold mb-4">Processing login...</p>
            <!-- This part will usually not be seen if redirection is successful -->
        <?php endif; ?>
    </div>
</body>
</html>
