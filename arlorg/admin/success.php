<!DOCTYPE HTML>
<html>
<head>
    <title>Success</title>
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
            text-align: center;
        }
        .success-message {
            background-color: #28a745;
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
        .success-message p {
            margin: 0;
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
            margin-right: 10px;
        }
        button:hover, a.button:hover {
            background-color: #bd2130;
        }
        .dashboard-button {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-message">
            <p>The resource has been <?php echo isset($_GET['action']) ? $_GET['action'] : ''; ?> successfully!</p>
        </div>
        <div class="dashboard-button">
            <a href="admin_dashboard.php" class="button">Go to Dashboard</a>
        </div>
    </div>
</body>
</html>
