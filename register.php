<?php
session_start();

// Include database configuration file
require_once 'config/db-config.php';

// Define variables and initialize with empty values
$firstname = $lastname = $email = $password = '';
$firstname_err = $lastname_err = $email_err = $password_err = '';

// Default user_group
$user_group = 'user';

// Processing form data when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Validate firstname
    if (empty(trim($_POST['firstname']))) {
        $firstname_err = 'Please enter your first name.';
    } else {
        $firstname = trim($_POST['firstname']);
    }

    // Validate lastname
    if (empty(trim($_POST['lastname']))) {
        $lastname_err = 'Please enter your last name.';
    } else {
        $lastname = trim($_POST['lastname']);
    }

    // Validate email
    if (empty(trim($_POST['email']))) {
        $email_err = 'Please enter your email.';
    } else {
        // Prepare a select statement
        $sql = 'SELECT id FROM users WHERE email = ?';

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param('s', $param_email);

            // Set parameters
            $param_email = trim($_POST['email']);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $email_err = 'This email is already taken.';
                } else {
                    $email = trim($_POST['email']);
                }
            } else {
                echo 'Oops! Something went wrong. Please try again later.';
            }

            // Close statement
            $stmt->close();
        }
    }

    // Validate password
    if (empty(trim($_POST['password']))) {
        $password_err = 'Please enter a password.';
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $password_err = 'Password must have at least 6 characters.';
    } else {
        $password = trim($_POST['password']);
    }

    // Check input errors before inserting in database
    if (empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($password_err)) {

        // Prepare an insert statement
        $sql = 'INSERT INTO users (firstname, lastname, email, password, `user_group`) VALUES (?, ?, ?, ?, ?)';

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param('sssss', $param_firstname, $param_lastname, $param_email, $param_password, $param_user_group);

            // Set parameters
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_user_group = $user_group;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to login page
                header('location: login.php');
            } else {
                echo 'Something went wrong. Please try again later.';
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
    <title>Register - Modern Style</title>
    <!-- Using Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Hide scrollbar but allow scrolling */
        ::-webkit-scrollbar {
            width: 0;
            height: 0;
        }

        body {
            scrollbar-width: none;
        }
    </style>
</head>

<body class="font-sans bg-gray-100">
    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center">
        <!-- Register Form -->
        <div class="bg-white p-8 rounded-md shadow-md max-w-md w-full">
            <h1 class="text-3xl font-semibold text-center mb-4 text-gray-800">Register</h1>
            <form class="space-y-4" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="firstname" class="block text-sm font-medium text-gray-700">First Name:</label>
                        <input type="text" id="firstname" name="firstname" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500" placeholder="First Name" required>
                        <span class="text-red-600"><?php echo $firstname_err; ?></span>
                    </div>
                    <div>
                        <label for="lastname" class="block text-sm font-medium text-gray-700">Last Name:</label>
                        <input type="text" id="lastname" name="lastname" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500" placeholder="Last Name" required>
                        <span class="text-red-600"><?php echo $lastname_err; ?></span>
                    </div>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" id="email" name="email" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500" placeholder="Email" required>
                    <span class="text-red-600"><?php echo $email_err; ?></span>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                    <input type="password" id="password" name="password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500" placeholder="Password" required>
                    <span class="text-red-600"><?php echo $password_err; ?></span>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="w-full bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Register</button>
                </div>
            </form>
            <p class="text-sm text-gray-600 mt-4 text-center">Already have an account? <a href="login.php" class="text-indigo-600 hover:underline">Login</a></p>
        </div>
    </div>
</body>

</html>
