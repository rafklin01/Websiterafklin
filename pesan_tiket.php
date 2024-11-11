<?php
include('includes/database.php');

if (isset($_GET['id'])) {
    $konser_id = $_GET['id'];

    $query = "SELECT * FROM konser WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$konser_id]);
    $konser = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "ID konser tidak ada!";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $jumlah_tiket = $_POST['jumlah_tiket'];

    $insert_query = "INSERT INTO pesanan (konser_id, nama, email, jumlah_tiket) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->execute([$konser_id, $nama, $email, $jumlah_tiket]);

    echo "<script>alert('Pemesanan berhasil!'); window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Tiket</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Pesan Tiket untuk <?= $konser['nama_konser'] ?></h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="jumlah_tiket">Jumlah Tiket</label>
                <input type="number" class="form-control" id="jumlah_tiket" name="jumlah_tiket" required>
            </div>
            <button type="submit" class="btn btn-primary">Pesan</button>
        </form>
        <a href="index.php" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</body>
</html>
