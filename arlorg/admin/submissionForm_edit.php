<?php
session_start();
include('shared.inc.php');
include("dbconn.inc3.php"); 

if(isset($_GET['rid']) && is_numeric($_GET['rid'])) {
    $rid = $_GET['rid'];
    
    $conn = dbConnect(); 
    $sql = "SELECT * FROM Resources WHERE RID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $rid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    
    if($row) {
        $imageURL = $row['ImageURL'];
        $resourceName = $row['ResourceName'];
        $resourceLink = $row['ResourceLink'];
        $address = $row['Address'];
        $phone = $row['Phone'];
        $categoryID = $row['CID'];
        $subcategoryID = $row['subcategoryID'];
        
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        header("Location: admin_dashboard.php");
        exit();
    }
} else {
    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Resource Submission - Edit</title>
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
            <h2>Edit Resource</h2>
            <div class="submission-form">
            <form action="success.php?action=modified" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="edit_id" value="<?php echo $rid; ?>">
                    <input type="hidden" name="action" value="modified">
                    
                    <div class="form-group">
                        <label class="form-label" for="image_url">Image URL:</label>
                        <input class="form-input" type="text" id="image_url" name="ImageURL" value="<?php echo htmlspecialchars($imageURL); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="resource_name">Resource Name:</label>
                        <input class="form-input" type="text" id="resource_name" name="ResourceName" value="<?php echo htmlspecialchars($resourceName); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="resource_link">Resource Link:</label>
                        <input class="form-input" type="text" id="resource_link" name="ResourceLink" value="<?php echo htmlspecialchars($resourceLink); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="address">Address:</label>
                        <input class="form-input" type="text" id="address" name="Address" value="<?php echo htmlspecialchars($address); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone">Phone:</label>
                        <input class="form-input" type="text" id="phone" name="Phone" value="<?php echo htmlspecialchars($phone); ?>" required>
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
