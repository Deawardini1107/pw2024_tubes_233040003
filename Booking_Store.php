<?php
session_start();
require_once 'Models/Database.php';

use Models\Booking;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a new booking instance and save the data
    $booking = new Booking;
    $date_range = $_POST['start_date'];
    list($start_date, $end_date) = explode(' to ', $date_range);


    

    $current_year = date('Y');

    // Correctly parse and format the dates
    $start_date = date('Y-m-d', strtotime($current_year . '-' . $start_date));
    $end_date = date('Y-m-d', strtotime($current_year . '-' . $end_date));

   


    $booking->place_id  = $_POST['place_id'];  
    $booking->user_id   = $_SESSION['user_id'];  
    $booking->start_date = $start_date;  
    $booking->end_date = $end_date ;     
    $booking->status = 'pending';      
    $booking->save();

    header('Location: Booking.php');
}
