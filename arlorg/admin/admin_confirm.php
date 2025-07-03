<?php
session_start();
include('shared.inc.php');
include("dbconn.inc3.php");

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

$message = ""; 

if (!isset($_GET['resource_id']) || !isset($_GET['action'])) {
    header("Location: admin_dashboard.php");
    exit();
}

$resource_id = $_GET['resource_id'];
$action = $_GET['action'];

$conn = dbConnect(); 
$sql = "SELECT * FROM Resources WHERE RID = $resource_id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: admin_dashboard.php");
    exit();
}

$row = mysqli_fetch_assoc($result);

if ($action === 'delete') {
    $confirm_message = "Delete this resource?";
    $confirm_action = "Delete";
    $delete_sql = "DELETE FROM Resources WHERE RID = $resource_id";
} elseif ($action === 'modify') {
    $confirm_message = "Confirm Modification";
    $confirm_action = "Modify";
} else {
    header("Location: admin_dashboard.php");
    exit();
}

$_SESSION['previous_page'] = $_SERVER['REQUEST_URI'];

if (isset($_POST['confirm'])) {
    if (mysqli_query($conn, $delete_sql)) {
        $message = "Resource $confirm_action successfully";
        header("Location: success.php?action=deleted");
        exit();
    } else {
        $message = "Error $confirm_action resource: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Confirm <?php echo $confirm_message; ?></title>
        
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
            color: #333;
        }
        
        .success-message {
            background-color: #28a745;
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .success-message p {
            margin: 0;
        }
        button, a.button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            margin-right: 10px;
        }
        button:hover, a.button:hover {
            background-color: #0056b3;
        }
        .button-cancel {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            margin-right: 10px;
        }
        .button-cancel:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><?php echo $confirm_message; ?></h2>
        <div class="resource-details">
            <p><strong>Resource Name:</strong> <?php echo htmlspecialchars($row['ResourceName']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($row['Address']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($row['Phone']); ?></p>
            <p><strong>Resource Link:</strong> <a href="<?php echo htmlspecialchars($row['ResourceLink']); ?>" target="_blank"><?php echo htmlspecialchars($row['ResourceLink']); ?></a></p>
        </div>
        <p><?php echo $message; ?></p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?resource_id=" . $resource_id . "&action=" . $action; ?>" method="post">
            <button type="submit" name="confirm">Confirm</button>
            <a href="admin_dashboard.php" class="button-cancel">Cancel</a>
        </form>
    </div>
</body>
</html>
