<?php
require_once '../../lib/checkAdmin.php';
require_once '../../Models/Database.php';

use Models\Place;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $place = Place::find($_POST['id']);
    $place->name = $_POST['name'];
    $place->description = $_POST['description'];
    $place->city = $_POST['city'];
    $place->category_id = $_POST['category_id'];

    // Handle file upload with a unique name
    if (!empty($_FILES['photos']['name'])) {
        $target_dir = "../../uploads/";
        $unique_name = uniqid() . '_' . basename($_FILES["photos"]["name"]);
        $target_file = $target_dir . $unique_name;
        if (move_uploaded_file($_FILES["photos"]["tmp_name"], $target_file)) {
            $place->photos = 'uploads/'.$unique_name;
        }
    }

    $place->save();
    echo json_encode(['status' => 'success']);
}