<?php
include '../includes/db.php';
include '../includes/auth.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isLoggedIn()) {
    $post_id = intval($_POST['post_id']);
    $user_id = $_SESSION['user_id'];
    $comment = htmlspecialchars($_POST['comment']);

    $sql = "INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $post_id, $user_id, $comment);
    $stmt->execute();
    
    header('Location: ../post.php?id=' . $post_id);
}
?>
