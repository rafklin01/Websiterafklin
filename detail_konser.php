<!-- detail_konser.php -->
<?php
include('includes/database.php');

$id = $_GET['id'];  // Mendapatkan ID konser yang dipilih
$query = "SELECT * FROM konser WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$konser = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Konser</title>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Rock+Salt&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #111;
            color: #fff;
            font-family: 'Rock Salt', cursive;
        }

        .container {
            margin-top: 50px;
        }

        h1 {
            font-family: 'Anton', sans-serif;
            color: #ff3b3f;
            font-size: 3rem;
            text-align: center;
        }

        .btn-primary {
            background-color: #ff3b3f;
            border: none;
            color: white;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #e03032;
        }

        .card-body {
            background-color: #222;
            padding: 30px;
        }

        .card-img-top {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }

        .card-title {
            font-family: 'Anton', sans-serif;
            color: #ff3b3f;
            font-size: 2rem;
        }

        .card-text {
            font-size: 1.1rem;
            color: #bbb;
        }

        .konser-date {
            font-size: 1.2rem;
            color: #aaa;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Rock Konser</a>
    </nav>

    <div class="container">
        <div class="card">
            <img src="images/<?= $konser['gambar_konser'] ?>" class="card-img-top" alt="<?= $konser['nama_konser'] ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $konser['nama_konser'] ?></h5>
                <p class="konser-date"><?= date("d F Y", strtotime($konser['tanggal_konser'])) ?> | <?= $konser['lokasi'] ?></p>
                <p class="card-text"><?= $konser['deskripsi'] ?></p>
                
                <!-- Tombol Pesan Tiket -->
                <a href="pesan_tiket.php?id=<?= $konser['id'] ?>" class="btn btn-primary">Pesan Tiket</a>
                
                <!-- Tombol Kembali -->
                <a href="index.php" class="btn btn-secondary mt-3">Kembali ke Daftar Konser</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
