<?php
session_start();

require_once '../database.config.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember_me = isset($_POST['remember-me']) ? true : false;

    if (empty($email) || empty($password)) {
        $message = "Please enter both email and password.";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT User_ID, User_Address, User_Password FROM users WHERE User_Address = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if (password_verify($password, $user['User_Password'])) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['id'] = $user['User_ID'];
                    $_SESSION['email'] = $user['User_Address'];

                    if ($remember_me) {
                        setcookie("user_email", $user['email'], time() + (86400 * 30), "/", "", false, true);
                    }

                    header("Location: ../src/App.php");
                    exit();
                } else {
                    $message = "Invalid email or password.";
                }
            } else {
                $message = "Invalid email or password.";
            }
        } catch (PDOException $e) {
            $message = "Database error: " . $e->getMessage();
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
