<?php
include('database.php');
if (isset($_POST["submit"])) {
   $event_name = $_POST['event_name'];
   $event_price = $_POST['event_price'];
   $event_desc = $_POST['event_desc'];

   if (empty($event_name) OR empty($event_price) OR empty($event_desc)) {
    echo '<script>alert("Fill All Fields!")</script>';;
   }

   $query = mysqli_query($conn, "INSERT INTO event_approval (event_name, event_price, event_desc) VALUES ('$event_name', '$event_price', '$event_desc')");

   if($query) {
    echo '<script>alert("Event Registered Successfully!")</script>';
   } else{
    echo '<script>alert("Error Occurred!")</script>';
   }  


}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title> KERA Tickets </title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link rel="stylesheet" href="style.css">
    </head>
  <body>
    
  <section id="header">
        <a href="#"> <img src="img/logomain.png" class="logo" alt=""> </a>

        <div>
            <ul id="navbar">
                <li>
                    <a href="company_dashboard.php">Dashboard</a>
                </li>
                <li>
                    <a href="event_reg.php">Event Registration</a>
                </li>
                <a href="logout_comp.php">
                <button > Logout </button>
                </a>
            </ul>
            
        </div>
    </section>

    <section id="form-details">
        <form method="POST">
            <span>DISPLAY YOUR EVENT ON KERA</span>
            <h2>SUBMIT EVENT DETAILS</h2>
            <input type="text" name="event_name" placeholder="Event Name">
            <input type="text" name="event_price" placeholder="Event Price">
            <textarea name="event_desc" cols="30" rows="10" placeholder="Event Description"></textarea>
            <button class="normal" type="submit" name="submit">Submit</button>
        </form>
        
    </section>