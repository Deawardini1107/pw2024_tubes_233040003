<?php
require_once '../../lib/checkAdmin.php';
require_once '../../Models/Database.php';
use Models\Category;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $place = Category::find($_POST['id']);
    $place->name = $_POST['name'];
    $place->description = $_POST['description'];
    $place->save();
    echo json_encode(['status' => 'success']);
}
?>
