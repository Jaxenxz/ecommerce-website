<?php
session_start();

// Check if the user is logged in and has admin privilege
if (!isset($_SESSION['loggedin']) || $_SESSION['user_group'] !== 'admin') {
    // Redirect the user to the login page or any other page you desire
    header('Location: ../../login.php');
    exit;
}

// Include database configuration file
require_once '../../../config/db-config.php';

// Check if product ID is set
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: manage_products.php');
    exit;
}

// Initialize product data variable
$product = [];

// Attempt to retrieve product data from the database
$sql = "SELECT * FROM products WHERE id = ?";
if ($stmt = $conn->prepare($sql)) {
    // Bind the product ID as parameter
    $stmt->bind_param("i", $_GET['id']);

    // Execute the prepared statement
    $stmt->execute();

    // Store the result
    $result = $stmt->get_result();

    // Check if product exists
    if ($result->num_rows == 1) {
        // Fetch product data
        $product = $result->fetch_assoc();
    } else {
        // Redirect if product does not exist
        header('Location: ../manage_products.php');
        exit;
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
                <h1 class="text-2xl font-semibold">Edit Product</h1>
                <div>
                    <a href="dashboard.php" class="text-white hover:text-gray-200 mx-2">Dashboard</a>
                    <a href="setting.php" class="text-white hover:text-gray-200 mx-2">Settings</a>
                    <a href="logout.php" class="text-white hover:text-gray-200 mx-2">Logout</a>
                </div>
            </div>
        </header>
        <!-- Content -->
        <div class="container mx-auto flex-grow px-6 py-4">
            <div class="bg-white p-6 rounded-md shadow-md">
                <h2 class="text-xl font-semibold mb-4">Edit Product</h2>
                <form action="update_product.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500" value="<?php echo $product['name']; ?>" required>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500" required><?php echo $product['description']; ?></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                        <input type="number" name="price" id="price" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500" value="<?php echo $product['price']; ?>" required>
                    </div>
                    <!-- Display current image -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Current Image</label>
                        <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>" class="mt-1 w-32 h-32 object-cover border border-gray-300">
                    </div>
                    <!-- Input for new image (optional) using URL -->
                    <div class="mb-4">
                        <label for="new_image_url" class="block text-sm font-medium text-gray-700">New Image URL (Optional)</label>
                        <input type="url" name="new_image_url" id="new_image_url" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Footer -->
        <footer class="bg-gray-200 py-4 px-6">
            <p class="text-gray-600 text-center">© 2024 Edit Product. All rights reserved.</p>
        </footer>
    </div>
</body>

</html>
