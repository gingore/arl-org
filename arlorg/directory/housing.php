<?php
session_start();
include('shared.inc.php');
include("dbconn.inc3.php"); 
$conn = dbConnect();

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$categories = array(
    "shelters" => "Shelters",
    "apartments" => "Apartments",
    "service providers" => "Service Providers",
    "advocacy" => "Advocacy"
);

$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

function getSubcategoryID($subcategory_name, $conn) {
    $sql = "SELECT subcategoryID FROM ResourcesSubCatg WHERE subcategoryName = '$subcategory_name'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['subcategoryID'];
    } else {
        return null;
    }
}

$sql = "SELECT r.*, s.subcategoryName FROM Resources AS r
        INNER JOIN ResourcesSubCatg AS s ON r.subcategoryID = s.subcategoryID";

if (!empty($filter)) {
    $subcategoryID = getSubcategoryID($filter, $conn);
    if ($subcategoryID !== null) {
        $sql .= " WHERE r.subcategoryID = '$subcategoryID'";
    }
}

$sql .= " AND r.CID != (SELECT CID FROM ResourcesCatg WHERE CatgName = 'Basic Needs')";

$result = mysqli_query($conn, $sql);
if (!$result) {
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
    <title>ArlOrg | Housing</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        .resource-card-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 20px;
            padding: 20px; 
        }

        .resource-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 16px;
            color: #555;
        }

        .categories {
            margin-top: 10px;
        }

        .categories span {
            margin-right: 5px;
        }

        .filter-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .filter-dropdown {
            display: inline-block;
        }

        .filter-dropdown select {
            vertical-align: middle;
        }

        .categories {
            margin-top: 10px;
        }

    </style>
</head>

<body>
    <header class="header">
        <?php echo $nav; ?>
    </header>

    <div class="container">
        <div class="hero" style="display: flex; justify-content: center; align-items: center; min-height: 10vh;">
            <div class="hero-text">
                <h1 class="title" style="margin: 0;">Housing</h1>
            </div>
        </div>

        <div class="filter-container">
            <div class="filter-dropdown">
                <form action="" method="GET" id="filterForm">
                    <label for="filter">Filter by Category:</label>
                    <select name="filter" id="filter" onchange="document.getElementById('filterForm').submit()">
                        <option value="">All</option>
                        <?php
                        foreach ($categories as $category => $displayName) {
                            echo '<option value="' . $category . '"';
                            if ($filter == $category) {
                                echo ' selected';
                            }
                            echo '>' . $displayName . '</option>';
                        }
                        ?>
                    </select>
                </form>
            </div>
        </div>

        <div class="resource-container">
            <div class="resource-card-container">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="resource-card">';
                        echo '<img src="' . $row['ImageURL'] . '" alt="' . $row['ResourceName'] . '" class="card-img-top">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $row['ResourceName'] . '</h5>';
                        echo '<p class="card-text"><strong>Address:</strong> ' . $row['Address'] . '</p>';
                        echo '<p class="card-text"><strong>Phone:</strong> ' . $row['Phone'] . '</p>';
                        echo '<br>'; 
                        echo '<a href="' . $row['ResourceLink'] . '" class="btn btn-primary">Visit Resource</a>';
                        echo '<p class="categories"><strong>Category:</strong> ' . $row['subcategoryName'] . '</p>';
                        echo '</div>'; 
                        echo '</div>'; 

                    }
                } else {
                    echo "<p>No housing resources found.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <footer class="container-fluid footer">
        <?php echo $footer; ?>
    </footer>
</body>

</html>


<?php
mysqli_free_result($result);

// Close the database connection
mysqli_close($conn);
?>
