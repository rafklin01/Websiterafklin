<?php
// Simpan ini dalam file PHP dan jalankan sekali untuk menambah admin
include('includes/database.php');

$username = 'admin';
$password = 'admin123';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO admin (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->execute([$username, $hashed_password]);

echo "Admin default berhasil ditambahkan!";
?>
