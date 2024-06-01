<?php 

if(!isset($_SESSION['UserID'])){
    header("Location: ../home/signin.php");
    exit();
}

if($_SESSION['Role'] !== 'Mahasiswa'){
    header("Location: ../dosen/manage.php");
    exit();
}


?>