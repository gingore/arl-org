<?php
session_start();
include('shared.inc.php');
include("dbconn.inc3.php");
$conn = dbConnect();

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$sqlCategories = "SELECT * FROM ResourcesCatg";
$resultCategories = mysqli_query($conn, $sqlCategories);
if (!$resultCategories) {
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">

  <title>Arlorg Resource Directory</title>
</head>
<body>
    <header class="header">
        <?php echo $nav; ?>
    </header>

    <div class="container">
        <div class="hero" style="display: flex; justify-content: center; align-items: center; min-height: 10vh;">
            <h1 class="title" style="margin: 0;">Resource Directory</h1>
        </div>

        <div class="category-container">
            <?php
            $categoryLinks = [
                'Basic Needs' => 'directory/basics.php',
                'Housing' => 'directory/housing.php',
                'Safety Needs' => 'directory/safety.php',
                'Employment and Workforce' => 'directory/employment.php'
            ];

            while ($row = mysqli_fetch_assoc($resultCategories)) {
                $category = $row['CatgName'];
                $imageURL = $row['ImageURL'];
                $categoryLink = isset($categoryLinks[$category]) ?
                    $categoryLinks[$category] : '#';

                echo '<div class="category-card" style="background-image: url(' . $imageURL . ');" onclick="location.href=\'' . $categoryLink . '\'">';
                echo '<div class="overlay">';
                echo '<a href="' . $categoryLink . '">' . $category . '</a>';
                echo '<p>' . $row['Subcatg'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
            mysqli_free_result($resultCategories);
            ?>
        </div>
    </div>

    <footer class="container-fluid footer">
        <?php echo $footer; ?>
    </footer>
</body>
</html>

<?php
mysqli_close($conn);
?>
