<?php
if (!isset($_SESSION['UserID'])) {
    header("Location: ../home/signin.php");
    exit();
}


if ($_SESSION['Role'] !== 'Dosen') {
    header("Location: ../murid/kelas.php");
    exit();
}





?>