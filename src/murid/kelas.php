<?php

if(isset($_SESSION['UserID'])) {
    if($_SESSION['Role'] ==  "Mahasiswa"){
      header("Location: ../murid/kelas.php");
      exit();
    }
    else{
      header("Location: ../dosen/manage.php");
    }
  }
?>

<h1>halo</h1>