<?php
if(isset($_SESSION['UserID'])) {
    if($_SESSION['Role'] ==  "Dosen"){
      header("Location: ../dosen/manage.php");
      exit();
    }
    else{
      header("Location: ../murid/kelas.php");
    }
  }
?>