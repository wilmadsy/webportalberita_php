<?php
session_start();

unset($_SESSION['owner']);
unset($_SESSION['webberita']);

session_destroy();//session di hancurkan

header("location:index.php"); //
?>