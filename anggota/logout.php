<?php
session_start();

unset($_SESSION['member']);
unset($_SESSION['webanggota']);

session_destroy();//session di hancurkan

header("location:../index.php"); //
?>