<?php

session_start();
if($_SESSION['role'] != 'admin') {
    header('Location: /pw2024_tubes_233040003/index.php');
    exit;
}