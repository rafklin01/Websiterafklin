<?php
include('includes/database.php');

$query = "SELECT * FROM konser ORDER BY tanggal_konser ASC";
$stmt = $conn->prepare($query);
$stmt->execute();
$konser_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Konser Rock</title>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Rock+Salt&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #111;
            color: #fff;
            font-family: 'Rock Salt', cursive;
        }

        h1 {
            font-family: 'Anton', sans-serif;
            color: #ff3b3f;
            font-size: 3rem;
            text-transform: uppercase;
            text-align: center;
            margin-top: 50px;
        }

        .navbar {
            background-color: #333;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
            font-weight: bold;
        }

        .navbar-nav .nav-link:hover {
            color: #ff3b3f !important;
        }

        .card {
            background-color: #222;
            border: none;
            border-radius: 8px;
            transition: transform 0.3s ease-in-out;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6);
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.8);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-family: 'Anton', sans-serif;
            font-size: 1.5rem;
            color: #ff3b3f;
            text-transform: uppercase;
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

        .konser-date {
            font-size: 1rem;
            color: #bbb;
        }

        .container {
            margin-top: 30px;
        }

        .row {
            display: flex;
            justify-content: space-around;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Rock Konser</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="login.php">Admin</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>Daftar Konser Rock yang Akan Datang</h1>

        <div class="row">
            <?php foreach ($konser_list as $konser): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="images/<?= $konser['gambar_konser'] ?>" class="card-img-top" alt="<?= $konser['nama_konser'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $konser['nama_konser'] ?></h5>
                            <p class="konser-date"><?= date("d F Y", strtotime($konser['tanggal_konser'])) ?> | <?= $konser['lokasi'] ?></p>
                            <p class="card-text"><?= substr($konser['deskripsi'], 0, 100) ?>...</p>
                            <a href="detail_konser.php?id=<?= $konser['id'] ?>" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
