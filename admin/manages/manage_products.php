<?php
session_start();

// Check if the user is logged in and has admin privilege
if (!isset($_SESSION['loggedin']) || $_SESSION['user_group'] !== 'admin') {
    // Redirect the user to the login page or any other page you desire
    header('Location: ../login.php');
    exit;
}

// Include database configuration file
require_once '../../config/db-config.php';

// Initialize product data variable
$products = [];

// Attempt to retrieve product data from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
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
                <h1 class="text-2xl font-semibold">Manage Products</h1>
                <div>
                    <a href="../dashboard.php" class="text-white hover:text-gray-200 mx-2">Dashboard</a>
                    <a href="setting.php" class="text-white hover:text-gray-200 mx-2">Settings</a>
                    <a href="logout.php" class="text-white hover:text-gray-200 mx-2">Logout</a>
                </div>
            </div>
        </header>
        <!-- Content -->
        <div class="container mx-auto flex-grow px-6 py-4">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">Product List</h2>
                <a href="add_product.php" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Add Product</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($products as $product) : ?>
                    <div class="bg-white rounded-md shadow-md p-4">
                        <h3 class="text-lg font-semibold"><?php echo $product['name']; ?></h3>
                        <!-- Add image -->
                        <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>" class="w-full h-auto mt-2">
                        <p class="text-gray-500 mt-2"><?php echo $product['description']; ?></p>
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-indigo-600 font-bold">$<?php echo $product['price']; ?></span>
                            <div>
                                <a href="products/edit_product.php?id=<?php echo $product['id']; ?>" class="text-indigo-600 hover:text-indigo-800"><i class="fas fa-edit"></i></a>
                                <a href="delete_product.php?id=<?php echo $product['id']; ?>" class="text-red-600 hover:text-red-800 ml-2"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- Footer -->
        <footer class="bg-gray-200 py-4 px-6">
            <p class="text-gray-600 text-center">© 2024 Manage Products. All rights reserved.</p>
        </footer>
    </div>
</body>

</html>
