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
				<li <?php echo $page_title=="Cart" ? "class='active'" : ""; ?> >
					<a href="cart.php">
						<?php
						// count products in cart
						$cart_item->cust_id=1; 
						$cart_count=$cart_item->count();
						?>
						Cart <span class="badge" id="comparison-count"><?php echo $cart_count; ?></span>
					</a>
				</li>
            </ul>
            
        </div>
    </section>
</head>
</body>
</html>



