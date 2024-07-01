<?php
include_once 'includes/db.php';
include_once 'includes/auth.php';

$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Blog</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include_once 'includes/header.php'; ?>

    <div class="container">
        <h1>AI Blog</h1>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="post">
                <h2><a href="post.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h2>
                <p><?php echo substr($row['content'], 0, 200); ?>...</p>
            </div>
        <?php endwhile; ?>
    </div>

    <?php include_once 'includes/footer.php'; ?>
</body>
</html>

<?php
// Close the connection after all operations
$conn->close();
?>
