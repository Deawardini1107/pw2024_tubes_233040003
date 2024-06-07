<?php
require_once '../../lib/checkAdmin.php';
require_once '../../Models/Database.php';
use Models\Place;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $place = Place::find($_POST['id']);
    $place->delete();
    echo json_encode(['status' => 'success']);
}
?>
