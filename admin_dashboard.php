<?php
session_start();
include('includes/database.php');

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$query = "SELECT pesanan.id, konser.nama_konser, pesanan.nama, pesanan.email, pesanan.jumlah_tiket 
          FROM pesanan
          JOIN konser ON pesanan.konser_id = konser.id
          ORDER BY pesanan.id DESC";
$stmt = $conn->prepare($query);
$stmt->execute();
$pesanan_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Rock Konser</title>
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
            text-align: center;
        }

        .container {
            margin-top: 50px;
        }

        .table {
            background-color: #222;
            border-radius: 8px;
            border: 2px solid #ff3b3f;
        }

        .table th, .table td {
            color: #ddd;
        }

        .table th {
            background-color: #ff3b3f;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #444;
        }

        .btn-custom {
            background-color: #ff3b3f;
            color: white;
            font-weight: bold;
        }

        .btn-custom:hover {
            background-color: #e03032;
        }

        .navbar {
            background-color: #000;
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: #ff3b3f;
        }

        .navbar-nav .nav-link:hover {
            color: #fff;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Rock Konser</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="container">
        <h1>Dashboard Admin</h1>
        <a href="logout.php" class="btn btn-danger float-right mb-3">Logout</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Konser</th>
                    <th>Nama Pemesan</th>
                    <th>Email</th>
                    <th>Jumlah Tiket</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pesanan_list as $pesanan): ?>
                    <tr>
                        <td><?= $pesanan['id'] ?></td>
                        <td><?= $pesanan['nama_konser'] ?></td>
                        <td><?= $pesanan['nama'] ?></td>
                        <td><?= $pesanan['email'] ?></td>
                        <td><?= $pesanan['jumlah_tiket'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- JavaScript untuk Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
