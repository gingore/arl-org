<?php
session_start();
include('shared.inc.php');
include("dbconn.inc3.php");

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = dbConnect(); 
    $sql = "INSERT INTO Resources (ImageURL, ResourceName, ResourceLink, Address, Phone, CID, subcategoryID) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssi", $imageURL, $resourceName, $resourceLink, $address, $phone, $categoryID, $subcategoryID);
        $imageURL = $_POST['ImageURL'];
        $resourceName = $_POST['ResourceName'];
        $resourceLink = $_POST['ResourceLink'];
        $address = $_POST['Address'];
        $phone = $_POST['Phone'];
        $categoryID = $_POST['CID'];
        $subcategoryID = $_POST['subcategoryID'];

        if (mysqli_stmt_execute($stmt)) {
            $message = "Resource added successfully!";
            header("Location: success.php?action=added");
            exit();
        } else {
            $message = "Error adding resource: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        $message = "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Resource Submission</title>
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
    .submission-form {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group-button { 
        margin-bottom: 20px;
        text-align: center;
    }
        
    .form-label {
        font-weight: bold;
        margin-bottom: 5px;
    }
    .form-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
    }
    .form-select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
    }
    .form-submit {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 12px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }
    .form-submit:hover {
        background-color: #0056b3;
    }
    .form-back {
        background-color: #dc3545;
        color: #fff;
        border: none;
        padding: 12px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        text-decoration: none;
    }
    .form-back:hover {
        background-color: #c82333;
    }
</style>

</head>
<body>
    <main>
        <div class="container">
            <h2>Resource Submission</h2>
            <div class="submission-form">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="form-label" for="image_url">Image URL:</label>
                        <input class="form-input" type="text" id="image_url" name="ImageURL" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="resource_name">Resource Name:</label>
                        <input class="form-input" type="text" id="resource_name" name="ResourceName" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="resource_link">Resource Link:</label>
                        <input class="form-input" type="text" id="resource_link" name="ResourceLink" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="address">Address:</label>
                        <input class="form-input" type="text" id="address" name="Address" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone">Phone:</label>
                        <input class="form-input" type="text" id="phone" name="Phone" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="category">Category:</label>
                        <select class="form-select" id="category" name="CID" required>
                            <option value="">Select Category</option>
                            <option value="1">Basic Needs</option>
                            <option value="2">Housing</option>
                            <option value="3">Safety Needs</option>
                            <option value="4">Employment</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="subcategory">Subcategory:</label>
                        <select class="form-select" id="subcategory" name="subcategoryID" required>
                            <option value="">Select Subcategory</option>
                        </select>
                    </div>
                    <div class="form-group-button">
                        <input class="form-submit" type="submit" value="Submit">
                        <a href="admin_dashboard.php" class="form-back">Back to Dashboard</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var categorySelect = document.getElementById('category');
            var subcategorySelect = document.getElementById('subcategory');
            
            var subcategories = {
                1: [
                    { id: 1, name: 'Food Pantries' },
                    { id: 2, name: 'Clothing' },
                    { id: 3, name: 'Transportation' }
                ],
                2: [
                    { id: 4, name: 'Shelters' },
                    { id: 5, name: 'Apartments' },
                    { id: 6, name: 'Service Providers' },
                    { id: 7, name: 'Advocacy' }
                ],
                3: [
                    { id: 8, name: 'Domestic Violence Shelters' },
                    { id: 9, name: 'Financial Assistance' }
                ],
                4: [
                    { id: 10, name: 'Employment Agencies' },
                    { id: 11, name: 'Employment Search Engines' },
                    { id: 12, name: 'ESL Classes' }
                ]
            };

            function updateSubcategories() {
                var selectedCategory = categorySelect.value;
                var selectedSubcategories = subcategories[selectedCategory];

                subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';

                if (selectedSubcategories) {
                    selectedSubcategories.forEach(function(subcategory) {
                        var option = document.createElement('option');
                        option.text = subcategory.name;
                        option.value = subcategory.id; 
                        subcategorySelect.add(option);
                    });
                }
            }
            
            categorySelect.addEventListener('change', updateSubcategories);
            
            updateSubcategories();
        });
    </script>
</body>
</html>
