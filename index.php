<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'lost_and_found');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch lost and found items
$sql = "SELECT * FROM items ORDER BY date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lost and Found</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Lost and Found Items</h1>
    <a href="add_item.php" class="btn btn-primary mb-3">Report Lost/Found Item</a>
    <div class="row">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <?php if ($row['image']) { ?>
                        <img src="uploads/<?php echo $row['image']; ?>" class="card-img-top" alt="Item Image">
                    <?php } else { ?>
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Placeholder Image">
                    <?php } ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['item_name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                        <p class="card-text"><small class="text-muted">Location: <?php echo htmlspecialchars($row['location']); ?></small></p>
                        <p class="card-text"><small class="text-muted">Date: <?php echo htmlspecialchars($row['date']); ?></small></p>
                        <p class="card-text"><small class="text-muted">Status: <?php echo htmlspecialchars($row['status']); ?></small></p>
                        <p class="card-text"><small class="text-muted">Contact: <?php echo htmlspecialchars($row['contact_info']); ?></small></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</body>
</html>

<?php $conn->close(); ?>
