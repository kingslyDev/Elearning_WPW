<?php
if (!isset($_SESSION['UserID'])) {
    header("Location: signin.php");
    exit();
}


if ($_SESSION['Role'] !== 'Dosen') {
    echo "Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. 403";
    exit();
}

?>