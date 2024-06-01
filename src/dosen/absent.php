<?php
session_start();

include '../../database/config.php';
include '../../auth/aksesdosen.php'; 
include '../../auth/who.php';

$message = "";


if (!isset($_GET['KelasID']) || empty($_GET['KelasID'])) {
    echo "KelasID tidak ditemukan.";
    exit();
}

$kelasID = $_GET['KelasID'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'buka_absen') {
        $sql = "UPDATE Kelas SET AbsensiTerbuka = 1 WHERE KelasID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $kelasID);
        $stmt->execute();
        $stmt->close();
        $message = "Akses absen dibuka.";
    } elseif ($_POST['action'] == 'tutup_absen') {
        $sql = "UPDATE Kelas SET AbsensiTerbuka = 0 WHERE KelasID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $kelasID);
        $stmt->execute();
        $stmt->close();
        $message = "Akses absen ditutup.";
    }
}


$sql = "SELECT AbsensiTerbuka FROM Kelas WHERE KelasID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $kelasID);
$stmt->execute();
$stmt->bind_result($absensiTerbuka);
$stmt->fetch();
$stmt->close();


$sql = "SELECT a.AbsensiID, u.Name AS MahasiswaName, a.WaktuAbsensi FROM Absensi a JOIN User u ON a.MahasiswaID = u.UserID WHERE a.KelasID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $kelasID);
$stmt->execute();
$result = $stmt->get_result();

$absensiList = [];
while ($row = $result->fetch_assoc()) {
    $absensiList[] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Absensi Kelas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff; /* Warna putih */
            color: #000000; /* Warna teks hitam */
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            color: #6436f1; /* Warna ungu */
        }

        a {
            color: #6436f1; /* Warna ungu */
            text-decoration: none;
            padding: 10px;
            background-color: #f0f0f0; /* Warna abu-abu muda */
            border-radius: 5px;
        }

        p {
            color: #000000; /* Warna teks hitam */
        }

        button {
            padding: 10px;
            background-color: #6436f1; /* Warna ungu */
            color: #ffffff; /* Warna teks putih */
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .tutup-button {
            background-color: #ff6347; /* Warna merah */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #000000; /* Warna garis hitam */
        }

        th {
            background-color: #6436f1; /* Warna ungu */
            color: #ffffff; /* Warna teks putih */
        }

        tr:nth-child(even) {
            background-color: #f0f0f0; /* Warna abu-abu muda */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Absensi Kelas</h1>
        <a href="manage.php">Kembali</a>
        <p><?php echo $message; ?></p>
        <form method="POST">
            <?php if ($absensiTerbuka): ?>
                <button type="submit" name="action" value="tutup_absen" class="tutup-button">Tutup Akses Absen</button>
            <?php else: ?>
                <button type="submit" name="action" value="buka_absen">Buka Akses Absen</button>
            <?php endif; ?>
        </form>

        <h2>Daftar Absensi</h2>
        <table>
            <thead>
                <tr>
                    <th>Mahasiswa</th>
                    <th>Waktu Absensi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($absensiList as $absensi): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($absensi['MahasiswaName']); ?></td>
                        <td><?php echo htmlspecialchars($absensi['WaktuAbsensi']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
