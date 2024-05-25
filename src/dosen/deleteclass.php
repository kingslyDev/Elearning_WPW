<?php
session_start();

require_once '../../database/config.php';
include '../../auth/aturanlogin.php';
include '../../auth/aksesdosen.php';



if (isset($_GET['KelasID'])) {
    $kelasID = intval($_GET['KelasID']);
    
    $sql = "DELETE FROM Kelas WHERE KelasID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $kelasID);

    if ($stmt->execute()) {
        header("Location: manage.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID Kelas tidak ditemukan.";
}

$conn->close();
?>
