<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'lost_and_found');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle image upload
    $image = $_FILES['image']['name'];
    $target = 'uploads/' . basename($image);

    // Insert item into the database
    $stmt = $conn->prepare("INSERT INTO items (item_name, description, location, date, image, status, contact_info) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "sssssss",
        $_POST['item_name'],
        $_POST['description'],
        $_POST['location'],
        $_POST['date'],
        $image,
        $_POST['status'],
        $_POST['contact_info']
    );

    if ($stmt->execute()) {
        // Upload image file
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo "Image uploaded successfully";
        } else {
            echo "Failed to upload image";
        }
        header('Location: index.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Item</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Report Lost or Found Item</h1>
    <form action="add_item.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="item_name">Item Name</label>
            <input type="text" class="form-control" id="item_name" name="item_name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="lost">Lost</option>
                <option value="found">Found</option>
            </select>
        </div>
        <div class="form-group">
            <label for="contact_info">Contact Info</label>
            <input type="text" class="form-control" id="contact_info" name="contact_info" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
