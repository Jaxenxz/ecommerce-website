<?php
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include database configuration file
require_once "../config/db-config.php";

// Define variables and initialize with session values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate new password
    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Please enter the new password.";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "Password must have at least 6 characters.";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm the password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before updating the database
    if (empty($new_password_err) && empty($confirm_password_err)) {
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("si", $param_password, $param_id);

            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit;
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <!-- Using Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans bg-gray-100">
    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center">
        <!-- Settings Form -->
        <div class="bg-white p-8 rounded-md shadow-md max-w-md w-full">
            <h1 class="text-3xl font-semibold text-center mb-4 text-gray-800">Change Password</h1>
            <form class="space-y-4" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div>
                    <label for="new_password" class="block text-sm font-medium text-gray-700">New Password:</label>
                    <input type="password" id="new_password" name="new_password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500" placeholder="New Password" required>
                    <span class="text-red-600"><?php echo $new_password_err; ?></span>
                </div>
                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500" placeholder="Confirm Password" required>
                    <span class="text-red-600"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="w-full bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
