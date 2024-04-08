<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopee Thailand - สินค้า</title>
    <!-- ใช้ CDN ของ Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- ใช้ CDN ของ Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* ซ่อน scrollbar แต่ยังสามารถเลื่อนได้ */
        ::-webkit-scrollbar {
            width: 0;
            height: 0;
        }

        body {
            scrollbar-width: none;
        }
        /* เพิ่ม @media queries เพื่อทำให้เว็บไซต์ responsive */
        @media (min-width: 640px) {
            /* ปรับขนาดตัวอักษรสำหรับหน้าจอขนาดเล็ก */
            .text-sm {
                font-size: 0.875rem; /* 14px */
            }
        }

        @media (min-width: 768px) {
            /* ปรับขนาดตัวอักษรสำหรับหน้าจอขนาดกลาง */
            .text-base {
                font-size: 1rem; /* 16px */
            }

            /* ปรับขนาดของ Navbar */
            .py-4 {
                padding-top: 1rem;
                padding-bottom: 1rem;
            }

            /* ปรับขนาดของ Footer */
            .py-8 {
                padding-top: 2rem;
                padding-bottom: 2rem;
            }
        }

        @media (min-width: 1024px) {
            /* ปรับขนาดรูปภาพสำหรับหน้าจอขนาดใหญ่ */
            .h-48 {
                height: 12rem; /* 192px */
            }

            /* ปรับขนาดของ Navbar */
            .container {
                max-width: 1024px;
            }

            /* ปรับขนาดของ Footer */
            .container {
                max-width: 1024px;
            }
        }

        @media (min-width: 1280px) {
            /* ปรับขนาดของ Navbar */
            .container {
                max-width: 1280px;
            }

            /* ปรับขนาดของ Footer */
            .container {
                max-width: 1280px;
            }
        }

    </style>
</head>
<body class="bg-gray-100 font-sans">
    <!-- เมนู Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- โลโก้ Shopee -->
                <div class="flex items-center">
                    <span class="text-lg ml-2 font-semibold">Shopee</span>
                </div>
                <!-- เมนู Navbar ทางขวา -->
                <div class="flex items-center">
                    <a href="index.php" class="text-gray-600 hover:text-gray-800 px-4">หน้าแรก</a>
                    <a href="product.php" class="text-gray-600 hover:text-gray-800 px-4">สินค้า</a>
                    <a href="#" class="text-gray-600 hover:text-gray-800 px-4">โปรโมชั่น</a>
                    <a href="#" class="text-gray-600 hover:text-gray-800 px-4">ช่วยเหลือ</a>
                    <!-- ตรวจสอบสถานะการเข้าสู่ระบบ -->
                    <?php
                    session_start();
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                        // ถ้าเข้าสู่ระบบแล้ว แสดงปุ่ม Logout
                        echo '<a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded-md flex items-center justify-center"><i class="fas fa-sign-out-alt mr-2"></i>ออกจากระบบ</a>';
                    } else {
                        // ถ้ายังไม่ได้เข้าสู่ระบบ แสดงปุ่ม Login
                        echo '<a href="login.php" class="bg-blue-500 text-white px-4 py-2 rounded-md flex items-center justify-center"><i class="fas fa-sign-in-alt mr-2"></i>เข้าสู่ระบบ</a>';
                        // เด้งไปหน้า login.php หากยังไม่ได้เข้าสู่ระบบ
                        header("Location: login.php");
                        exit(); // หยุดการทำงานของสคริปต์ทันทีหลังจาก Redirect
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- เนื้อหาหลัก -->
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-4">สินค้าทั้งหมด</h1>
            <!-- เลือกรายการสินค้ายอดนิยม -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-2">
                <?php
                // เชื่อมต่อกับฐานข้อมูล
                include 'config/db-config.php';

                // ดึงข้อมูลสินค้า
                $sql = "SELECT id, name, description, price, image_url FROM products";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // วนลูปเพื่อแสดงผลสินค้า
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='bg-white p-2 shadow-md rounded-md'>";
                        echo "<img src='" . $row["image_url"] . "' alt='" . $row["name"] . "' class='w-full h-48 object-cover mb-2'>";
                        echo "<h2 class='text-lg font-semibold mb-1'>" . $row["name"] . "</h2>";
                        echo "<p class='text-gray-600 text-sm'>" . $row["description"] . "</p>";
                        echo "<div class='mt-2 flex items-center justify-between'>";
                        echo "<span class='text-base font-bold text-orange-500'>฿" . $row["price"] . "</span>";
                        echo "<button class='bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 text-sm border-none'>ใส่ตะกร้า</button>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- โลโก้ Shopee -->
                <div class="col-span-1 md:col-span-1">
                    <span class="h-8">Shopee Logo</span>
                    <p class="text-sm mt-4">Shopee คือเว็บไซต์ช้อปปิ้งออนไลน์ที่ใหญ่ที่สุดในเอเชียที่ให้บริการในภูมิภาคอาเซียน</p>
                </div>
                <!-- เมนู Footer -->
                <div class="col-span-1 md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <h3 class="text-lg font-semibold mb-2">เกี่ยวกับเรา</h3>
                            <ul>
                                <li><a href="#" class="text-gray-400 hover:text-white">ข้อมูลของเรา</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-white">การติดต่อ</a></li>
                            </ul>
                        </div>
                        <!-- เพิ่มเมนูอื่น ๆ ตามต้องการ -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
