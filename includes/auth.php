<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function login($username, $password, $conn) {
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return true;
        }
    }
    return false;
}

function register($username, $password, $conn) {
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $passwordHash);
    return $stmt->execute();
}

function logout() {
    session_unset();
    session_destroy();
}
?>
