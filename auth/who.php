<?php
$sql_nama_user = "SELECT Name FROM User WHERE UserID = ?";
$stmt_nama_user = $conn->prepare($sql_nama_user);
$stmt_nama_user->bind_param("i", $_SESSION['UserID']);
$stmt_nama_user->execute();
$result_nama_user = $stmt_nama_user->get_result();


if ($row_nama_user = $result_nama_user->fetch_assoc()) {
    $nama_user = $row_nama_user['Name'];
} else {
    $nama_user = "Nama Dosen Tidak Ditemukan";
}

?>