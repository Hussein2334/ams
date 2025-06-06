<?php
session_start();
include '../db.php';
include '../functions.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

$userId = $_SESSION['user']['id'];
$appealId = intval($_GET['id'] ?? 0);

// Delete only if the appeal belongs to this user
$stmt = $conn->prepare("DELETE FROM appeals WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $appealId, $userId);
$stmt->execute();

logActivity($conn, $userId, 'Delete Appeal', "User deleted appeal ID $appealId");

header("Location: view_appeals.php");
exit;
?>
