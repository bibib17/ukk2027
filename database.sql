-- ==========================================================
-- DATABASE: taking_order_cafe
-- Aplikasi: Taking Order Cafe - UKK Asisten Pengembang Web
-- ==========================================================

CREATE DATABASE IF NOT EXISTS `taking_order_cafe` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `taking_order_cafe`;

-- ----------------------------------------------------------
-- 1. Tabel users
-- ----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('admin', 'customer') NOT NULL DEFAULT 'customer',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------------------------------------
-- 2. Tabel menus
-- ----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `menus` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `category` VARCHAR(50) NOT NULL, -- Makanan, Minuman, Snack
    `description` TEXT,
    `price` DECIMAL(10, 2) NOT NULL,
    `image` VARCHAR(255) DEFAULT 'default-menu.png',
    `status` ENUM('available', 'unavailable') NOT NULL DEFAULT 'available',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------------------------------------
-- 3. Tabel orders
-- ----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orders` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_code` VARCHAR(50) NOT NULL UNIQUE,
    `user_id` INT NOT NULL,
    `total` DECIMAL(12, 2) NOT NULL DEFAULT 0.00,
    `status` ENUM('Menunggu', 'Diproses', 'Selesai', 'Dibatalkan') NOT NULL DEFAULT 'Menunggu',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------------------------------------
-- 4. Tabel order_details
-- ----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `order_details` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT NOT NULL,
    `menu_id` INT NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `quantity` INT NOT NULL DEFAULT 1,
    `subtotal` DECIMAL(12, 2) NOT NULL,
    CONSTRAINT `fk_order_details_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_order_details_menu` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------------------------------------
-- Data Awal (Seed Data)
-- Password default untuk 'admin' dan 'customer' adalah 'password'
-- Hash: $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
-- ----------------------------------------------------------
INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Administrator Cafe', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NOW()),
(2, 'Andi Pratama', 'customer', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NOW()),
(3, 'Budi Santoso', 'budi', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NOW())
ON DUPLICATE KEY UPDATE `id`=`id`;

INSERT INTO `menus` (`id`, `name`, `category`, `description`, `price`, `image`, `status`, `created_at`) VALUES
(1, 'Nasi Goreng Spesial', 'Makanan', 'Nasi goreng dengan bumbu rempah khas, telur mata sapi, ayam suwir, dan kerupuk.', 22000.00, 'nasi-goreng.png', 'available', NOW()),
(2, 'Mie Goreng Jawa', 'Makanan', 'Mie goreng gurih manis dengan bakso, sosis, sawi segar, dan taburan bawang goreng.', 18000.00, 'mie-goreng.png', 'available', NOW()),
(3, 'Ayam Geprek Sambal Bawang', 'Makanan', 'Ayam krispi gurih dengan sambal bawang pedas nampol disajikan dengan nasi hangat.', 20000.00, 'ayam-geprek.png', 'available', NOW()),
(4, 'Kentang Goreng Crispy', 'Snack', 'French fries renyah keemasan dengan taburan bumbu keju dan saus cocolan.', 15000.00, 'kentang-goreng.png', 'available', NOW()),
(5, 'Roti Bakar Cokelat Keju', 'Snack', 'Roti bakar empuk isi limpahan cokelat manis dan parutan keju gurih.', 16000.00, 'roti-bakar.png', 'available', NOW()),
(6, 'Es Kopi Susu Gula Aren', 'Minuman', 'Espresso arabika blend dipadu susu segar dan sirup gula aren pilihan.', 18000.00, 'kopi-susu.png', 'available', NOW()),
(7, 'Matcha Latte Ice', 'Minuman', 'Teh hijau Jepang murni berpadu dengan susu creamy dan es batu menyegarkan.', 20000.00, 'matcha-latte.png', 'available', NOW()),
(8, 'Es Teh Manis Jasmine', 'Minuman', 'Teh melati wangi segar disajikan dingin manis alami.', 6000.00, 'es-teh.png', 'available', NOW())
ON DUPLICATE KEY UPDATE `id`=`id`;

-- Contoh Pesanan Awal untuk Demonstrasi
INSERT INTO `orders` (`id`, `order_code`, `user_id`, `total`, `status`, `created_at`) VALUES
(1, 'ORD-20260917-0001', 2, 40000.00, 'Selesai', NOW() - INTERVAL 1 DAY),
(2, 'ORD-20260917-0002', 2, 38000.00, 'Diproses', NOW() - INTERVAL 2 HOUR),
(3, 'ORD-20260917-0003', 3, 26000.00, 'Menunggu', NOW() - INTERVAL 10 MINUTE)
ON DUPLICATE KEY UPDATE `id`=`id`;

INSERT INTO `order_details` (`id`, `order_id`, `menu_id`, `price`, `quantity`, `subtotal`) VALUES
(1, 1, 1, 22000.00, 1, 22000.00),
(2, 1, 6, 18000.00, 1, 18000.00),
(3, 2, 3, 20000.00, 1, 20000.00),
(4, 2, 6, 18000.00, 1, 18000.00),
(5, 3, 7, 20000.00, 1, 20000.00),
(6, 3, 8, 6000.00, 1, 6000.00)
ON DUPLICATE KEY UPDATE `id`=`id`;
