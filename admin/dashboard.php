<?php
session_start();

// Check if the user is logged in and has admin privilege
if (!isset($_SESSION['loggedin']) || $_SESSION['user_group'] !== 'admin') {
    // Redirect the user to the login page or any other page you desire
    header('Location: login.php');
    exit;
}

// Include database configuration file
require_once '../config/db-config.php';

// Initialize total users and total products variables
$total_users = 0;
$total_products = 0;

// Attempt to retrieve total users count from the database
$sql_users = "SELECT COUNT(*) AS total_users FROM users";
$result_users = $conn->query($sql_users);

if ($result_users && $result_users->num_rows > 0) {
    $row_users = $result_users->fetch_assoc();
    $total_users = $row_users['total_users'];
}

// Attempt to retrieve total products count from the database
$sql_products = "SELECT COUNT(*) AS total_products FROM products";
$result_products = $conn->query($sql_products);

if ($result_products && $result_products->num_rows > 0) {
    $row_products = $result_products->fetch_assoc();
    $total_products = $row_products['total_products'];
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Using Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-indigo-600 text-white py-4 px-6">
            <div class="container mx-auto flex items-center justify-between">
                <h1 class="text-2xl font-semibold">Dashboard</h1>
                <div>
                    <a href="dashboard.php" class="text-white hover:text-gray-200 mx-2">Home</a>
                    <a href="manages/manage_products.php" class="text-white hover:text-gray-200 mx-2">Manage Products</a> <!-- เพิ่มลิงก์ไปยังหน้าจัดการสินค้า -->
                    <a href="users.php" class="text-white hover:text-gray-200 mx-2">Manage Users</a> <!-- เพิ่มลิงก์ไปยังหน้าจัดการผู้ใช้ -->
                    <a href="setting.php" class="text-white hover:text-gray-200 mx-2">Settings</a>
                    <a href="logout.php" class="text-white hover:text-gray-200 mx-2">Logout</a>
                </div>
            </div>
        </header>
        <!-- Content -->
        <div class="container mx-auto flex-grow px-6 py-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Card 1 -->
                <div class="bg-white rounded-md shadow-md p-4">
                    <h2 class="text-lg font-semibold">Total Users</h2>
                    <div class="flex items-center mt-4">
                        <span class="text-3xl font-bold"><?php echo $total_users; ?></span>
                        <span class="ml-2 text-gray-500">users</span>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="bg-white rounded-md shadow-md p-4">
                    <h2 class="text-lg font-semibold">Total Products</h2>
                    <div class="flex items-center mt-4">
                        <span class="text-3xl font-bold"><?php echo $total_products; ?></span>
                        <span class="ml-2 text-gray-500">products</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer class="bg-gray-200 py-4 px-6">
            <p class="text-gray-600 text-center">© 2024 Dashboard. All rights reserved.</p>
        </footer>
    </div>
</body>

</html>
