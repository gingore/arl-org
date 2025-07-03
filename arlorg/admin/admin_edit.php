<?php
session_start();
include('shared.inc.php');
include("dbconn.inc3.php");

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

$conn = dbConnect(); 
$sql = "SELECT * FROM Resources";
$result = mysqli_query($conn, $sql); /

if (!$result) {
    die("Error: " . mysqli_error($conn)); 
}

mysqli_close($conn);
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Edit Resources</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
            text-align: center;
        }
        .resource-item {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }
        .resource-item h3 {
            margin-top: 0;
        }
        .resource-item p {
            margin: 10px 0;
        }
        .resource-item a {
            text-decoration: none;
            color: #007bff;
        }
        .resource-item a:hover {
            text-decoration: underline;
        }
        .edit-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        .edit-button:hover {
            background-color: #0056b3;
        }
        .button-container {
            text-align: center; 
            margin-top: 20px; 
            margin-bottom: 20px;
        }
        button, a.button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }
        button:hover, a.button:hover {
            background-color: #c82333;
        }
    </style>
    <script>
        function redirectToEdit(RID) {
            window.location.href = 'submissionForm_edit.php?rid=' + RID;
        }
    </script>


</head>
<body>
    <div class="container">
        <h2>Edit Resources</h2>
        <div class="button-container">
            <a href="admin_dashboard.php" class="button">Go to Dashboard</a>
        </div>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='resource-item'>";
                echo "<h3>" . htmlspecialchars($row['ResourceName']) . "</h3>";
                echo "<p><strong>Address:</strong> " . htmlspecialchars($row['Address']) . "</p>";
                echo "<p><strong>Phone:</strong> " . htmlspecialchars($row['Phone']) . "</p>";
                echo "<p><strong>Resource Link:</strong> <a href='" . htmlspecialchars($row['ResourceLink']) . "' target='_blank'>" . htmlspecialchars($row['ResourceLink']) . "</a></p>";
                echo "<input type='button' class='edit-button' value='Edit' onclick='redirectToEdit(" . $row['RID'] . ")'>";
                echo "</div>";
            }
        } else {
            echo "<p>No resources found.</p>";
        }
        ?>
    </div>
</body>
</html>
