<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

include '../db.php';
include '../functions.php'; // logActivity must be defined here

if (!isset($_GET['id'])) {
    echo "<script>alert('No user selected for deletion.'); window.location.href='manage_users.php';</script>";
    exit;
}

$user_id = intval($_GET['id']);

// Prevent admin from deleting themselves
if ($user_id === $_SESSION['user']['id']) {
    echo "<script>alert('You cannot delete your own account.'); window.location.href='manage_users.php';</script>";
    exit;
}

// Fetch user to delete (to log details and delete image)
$stmt = $conn->prepare("SELECT username, profile_image FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('User not found.'); window.location.href='manage_users.php';</script>";
    exit;
}

$user = $result->fetch_assoc();
$usernameToDelete = $user['username'];
$profileImage = $user['profile_image'];
$stmt->close();

// Delete user from database
$deleteStmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$deleteStmt->bind_param("i", $user_id);
if ($deleteStmt->execute()) {
    // Delete profile image if not default
    if (!empty($profileImage) && $profileImage !== 'default.png' && file_exists("../image/" . $profileImage)) {
        unlink("../image/" . $profileImage);
    }

    // Log activity
    $admin_id = $_SESSION['user']['id'];
    $admin_name = $_SESSION['user']['username'];
    $action = "Deleted User";
    $details = "Admin '{$admin_name}' (ID: {$admin_id}) deleted user '{$usernameToDelete}' (ID: {$user_id})";
    logActivity($conn, $admin_id, $action, $details);

    echo "<script>alert('User deleted successfully.'); window.location.href='manage_users.php';</script>";
} else {
    echo "<script>alert('Failed to delete user.'); window.location.href='manage_users.php';</script>";
}
?>
