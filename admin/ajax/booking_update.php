<?php
require_once '../../lib/checkAdmin.php';
require_once '../../Models/Database.php';

use Models\Booking;

// Handle status update request
if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $booking = Booking::find($id);
    if ($booking) {
        $booking->status = $status;
        $booking->save();
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit;
}