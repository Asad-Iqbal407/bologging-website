<?php
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);

    $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container">
        <h1>Create New Post</h1>
        <form action="create_post.php" method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            <br>
            <label for="content">Content:</label>
            <textarea id="content" name="content" required></textarea>
            <br>
            <input type="submit" value="Create Post">
        </form>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
