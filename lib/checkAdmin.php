<?php

session_start();
if($_SESSION['role'] != 'admin') {
    header('Location: /paradise/index.php');
    exit;
}