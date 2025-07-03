<?php
	session_start();
	include ('shared.inc.php');
	include("dbconn.inc3.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">

  <title> Arlorg Homepage </title>
</head>
<body>

<header class="header fixed-top">
<?php echo $nav; ?>
<div class="fas fa-bars"></div>
</header>


<section id="home" class="home container-fluid">
    <div class="row hero text-center" id="welcome">
        <h1 class="text1">Welcome to Arlorg :3</h1>
    </div>
</section>


<!-- home section ends -->

<footer>
    <?php echo $footer; ?>
</footer>

<!-- jquery file link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- magnific popup link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<!-- main/custom javascript file link  -->
<script src="js/main.js"></script>

</body>
</html>
