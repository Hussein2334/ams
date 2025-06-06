<?php
session_start();
include '../db.php';
include '../functions.php'; // logActivity() assumed here

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

$userId = $_SESSION['user']['id'];
$username = $_SESSION['user']['username'];

if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    $fileType = mime_content_type($_FILES['profile_image']['tmp_name']);

    // Optional: Max file size 2MB
    $maxFileSize = 2 * 1024 * 1024;
    if ($_FILES['profile_image']['size'] > $maxFileSize) {
        die("File too large. Maximum size is 2MB.");
    }

    if (!in_array($fileType, $allowedTypes)) {
        die("Invalid file type. Only JPG and PNG are allowed.");
    }

    $ext = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
    
    // Generate a safe random file name
    try {
        $randomString = bin2hex(random_bytes(5));
    } catch (Exception $e) {
        // fallback
        $randomString = bin2hex(openssl_random_pseudo_bytes(5));
    }
    
    $newFileName = time() . '_' . $randomString . '.' . $ext;
    $uploadDir = "../image/";
    $uploadFilePath = $uploadDir . $newFileName;

    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadFilePath)) {
        // Delete old image if exists and not default
        $oldImage = $_SESSION['user']['profile_image'] ?? '';
        if (!empty($oldImage) && $oldImage !== 'default.png' && file_exists($uploadDir . $oldImage)) {
            unlink($uploadDir . $oldImage);
        }

        // Update database
        $stmt = $conn->prepare("UPDATE users SET profile_image = ? WHERE id = ?");
        $stmt->bind_param('si', $newFileName, $userId);
        $stmt->execute();
        $stmt->close();

        // Update session
        $_SESSION['user']['profile_image'] = $newFileName;

        // Log activity
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