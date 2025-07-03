<?php
$header = '';

$nav = 
'<a href="#" class="logo"><img src="img/image.png" alt="arlorg logo"></a>

<nav>
  <ul>
    <li><a href="/arlorg/index.php">Home</a></li>
    <li><a href="/arlorg/about.php">About Us</a></li>
    <li><a href="/arlorg/resourceDirectory.php">Resource Directory</a></li>
    <li><a href="/arlorg/contact.php">Contact Us</a></li>
  </ul>
</nav>';

$footer = 
'<section class="container-fluid footer" id="footer">
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3">
            <h3><img src="img/image.png" alt="arlorg logo" style="height: 150px;"></h3>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3">
            <h3>Contact Us</h3>
                <div class="list">
                    <p><b>Society of St. Vincent De Paul</b><br>
                    JC Main Road, Near Silnile tower<br>
                    Pin-21542 Arlington, TX.</p>
		        <p><i class="icon-phone"></i> (123) 456-789 - 1255-12584 <br>
		        <i class="icon-envelope-alt"></i> arlorg811@gmail.com</p>
                </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3">
          <h3>Quick Links</h3>
          <div class="list">
            <a href="#">Home</a>
            <a href="/arlorg/about.php">About Us</a>
            <a href="/arlorg/resourceDirectory.php">Resource Directory</a>
            <a href="/arlorg/contact.php">Contact Us</a>
            <a href="/arlorg/admin/admin_login.php">Login</a>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3">
        	<div class="widget">
        		<h3 class="widgetheading">Sign-Up For Our Newsletter!</h3>';
                    if (!isset($_SESSION['registered'])) {
                        $footer .= '<form method="post" action="newslettersignup.php">
                        <p><label for="fname">First Name: </label></p>
                        <input type="text" id="fname" name="fname"><br><br>
                        <p><label for="email">Email: </label></p>
                        <input type="email" id="email" name="email"><br>
                        <input class="newsletter-form-submit" type="submit" name="submit" value="Submit">
                                    </form>';
                            } else {
                                $footer .= '<h4>Thanks for subscribing!</h4>';
                            }
                    $footer .= '
                </div>
            </div>
        </div>
    </div>
    
<p class="credit">This website is a project for COMM 2195 at The University of Texas at Arlington. This is not an official website. </p>

</section>';
?>