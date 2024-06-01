<?php

include '../../database/config.php';

if (!isset($_SESSION['UserID'])) {
    echo "UserID tidak ditemukan dalam sesi.";
    exit();
}

$sql_nama_user = "SELECT Name FROM User WHERE UserID = ?";
$stmt_nama_user = $conn->prepare($sql_nama_user);
$stmt_nama_user->bind_param("i", $_SESSION['UserID']);
$stmt_nama_user->execute();
$result_nama_user = $stmt_nama_user->get_result();

if ($result_nama_user->num_rows > 0) {
    $row_nama_user = $result_nama_user->fetch_assoc();
    $nama_user = $row_nama_user['Name'];
} else {
    $nama_user = "Nama User Tidak Ditemukan";
}

?>
