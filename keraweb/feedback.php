<?php
include('database.php');
if (isset($_POST["submit"])) {
   $fb_name = $_POST['fb_name'];
   $fb_email = $_POST['fb_email'];
   $fb_subject = $_POST['fb_subject'];
   $fb_message = $_POST['fb_message'];

   if (empty($fb_name) OR empty($fb_email) OR empty($fb_message)) {
    echo '<script>alert("Fill All Fields!")</script>';;
   }

   $query = mysqli_query($conn, "INSERT INTO feedback (fb_name, fb_email, fb_subject, fb_message) VALUES ('$fb_name', '$fb_email', '$fb_subject', '$fb_message')");

   if($query) {
    echo '<script>alert("Feedback has been Sent")</script>';
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
                    <a href="home.php">Home</a>
                </li>
                <li>
                    <a href="events.php">Events</a>
                </li>
                <li>
                    <a href="feedback.php">Contact</a>
                </li>
                <a href="logout.php">
                <button > Logout </button>
                </a>
            </ul>
            
        </div>
    </section>

 

    <section id="contact-details" class="section-p1">
        <div class="details">
            <span>MAIN OFFICE</span>
            <h2>Visit us for further inquires about KERA</h2>
            <h3>Main Office</h3>
            <div>
                <li>
                    <i class="fal fa-map"></i>
                    <p>IBR111, Middle East College, 79 Knowledge Oasis, Rusail, Muscat, Oman</p>
                </li>
                <li>
                    <i class="far fa-envelope"></i>
                    <p>21F22253@mec.edu.com </p>
                </li>
                <li>
                    <i class="far fa-clock"></i>
                    <p>Sunday to Thursday: 11.00 AM to 4:00 PM</p>
                </li>
            </div>
        </div>

        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.02091804271!2d58.165051411130996!3d23.567692195677235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e8de2a1c1ede397%3A0x5d23dbf6d52a9f68!2sMiddle%20East%20College!5e0!3m2!1sen!2som!4v1704528854702!5m2!1sen!2som"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </section>

    <section id="form-details">
        <form method="POST">
            <span>SEND YOUR QUESTIONS</span>
            <h2>KERA would like to help you! </h2>
            <input type="text" name="fb_name" placeholder="Your Name">
            <input type="text" name="fb_email" placeholder="E-mail">
            <input type="text" name="fb_subject" placeholder="Subject">
            <textarea name="fb_message" cols="30" rows="10" placeholder="Your Message"></textarea>
            <button class="normal" type="submit" name="submit">Submit</button>
        </form>
        <div class="people">
            <div>
                <p><span>Al-Waleed Khalid </span> Senior Development Manager <br> Email: 21F22253@mec.edu.om</p>
            </div>
            <div>
                <p><span>Abian Al-Kulaibi</span>  Marketing Manager <br> Email:  20S20318@mec.edu.om</p>
            </div>
            <div>
                <p><span>Marya Al-Wahaibi</span>  Event Director <br> Email: 21S20884@mec.edu.om</p>
            </div>
            <div>
                <p><span>Hamaed Al-Subhi</span>  Sales Manager  <br> Email: 19F19315@mec.edu.om</p>
            </div>
        </div>
    </section>