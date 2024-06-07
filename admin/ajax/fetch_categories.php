<?php
require_once '../../lib/checkAdmin.php';
require_once '../../Models/Database.php';
use Models\Category;

$categories = Category::all();

echo json_encode($categories);
?>
