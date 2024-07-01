<?php
include 'includes/db.php';
include 'includes/auth.php';

$id = $_GET['id'];
$sql = "SELECT * FROM posts WHERE id=$id";
$result = $conn->query($sql);
$post = $result->fetch_assoc();

$sql = "SELECT comments.comment, users.username, comments.created_at FROM comments JOIN users ON comments.user_id = users.id WHERE post_id=$id ORDER BY comments.created_at DESC";
$comments = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $post['title']; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container">
        <h1><?php echo $post['title']; ?></h1>
        <p><?php echo $post['content']; ?></p>

        <h2>Comments</h2>
        <?php while($comment = $comments->fetch_assoc()): ?>
            <div class="comment">
                <p><strong><?php echo $comment['username']; ?></strong> (<?php echo $comment['created_at']; ?>)</p>
                <p><?php echo $comment['comment']; ?></p>
            </div>
        <?php endwhile; ?>

        <?php if (isLoggedIn()): ?>
            <form action="comments/add_comment.php" method="post">
                <input type="hidden" name="post_id" value="<?php echo $id; ?>">
                <textarea name="comment" required></textarea>
                <br>
                <input type="submit" value="Add Comment">
            </form>
        <?php else: ?>
            <p><a href="login.php">Login</a> to add a comment.</p>
        <?php endif; ?>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
