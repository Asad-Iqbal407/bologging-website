<?php
include_once 'auth.php';
?>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="create_post.php">Create Post</a></li>
            <?php if (isLoggedIn()): ?>
                <li><a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
