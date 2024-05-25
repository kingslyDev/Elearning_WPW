<?php

session_start();


session_unset();


session_destroy();


header("Location: ../src/home/signin.php");
exit();
?>
