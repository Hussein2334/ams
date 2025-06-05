<?php
session_start();
include '../db.php';
include '../functions.php'; // Make sure this includes the logActivity function

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

$userId = $_SESSION['user']['id'];
$username = $_SESSION['user']['username'];

// Check if file uploaded without errors
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    $fileType = mime_content_type($_FILES['profile_image']['tmp_name']);

    if (!in_array($fileType, $allowedTypes)) {
        die("Invalid file type. Only JPG and PNG are allowed.");
    }

    $ext = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
    $newFileName = time() . '_' . bin2hex(random_bytes(5)) . '.' . $ext;
    $uploadDir = "../image/";
    $uploadFilePath = $uploadDir . $newFileName;

    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadFilePath)) {
        // Optional: Delete old image if it's not default and exists
        $oldImage = $_SESSION['user']['profile_image'] ?? '';
        if (!empty($oldImage) && $oldImage !== 'default.png' && file_exists($uploadDir . $oldImage)) {
            unlink($uploadDir . $oldImage);
        }

        // Update in database
        $stmt = $conn->prepare("UPDATE users SET profile_image = ? WHERE id = ?");
        $stmt->bind_param('si', $newFileName, $userId);
        $stmt->execute();
        $stmt->close();

        // Update session
        $_SESSION['user']['profile_image'] = $newFileName;

        // Log the activity
        $action = "Updated Profile Picture";
        $details = "User '{$username}' (ID: {$userId}) updated their profile picture to '{$newFileName}'";
        logActivity($conn, $userId, $action, $details);

        header("Location: profile.php?success=1");
        exit;
    } else {
        die("Failed to move uploaded file.");
    }
} else {
    die("No file uploaded or upload error.");
}
?>
