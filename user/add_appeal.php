<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}

include '../db.php';
include '../functions.php';

// Log visit to Add Appeal page
logActivity($conn, $_SESSION['user']['id'], 'Access Add Appeal Page', 'User opened the add appeal form');

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user']['id'];
    $subject = trim($_POST['subject']);
    $messageText = trim($_POST['message']);

    $attachment = null;
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
        $uploadDir = "../uploads/";
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = time() . '_' . basename($_FILES['attachment']['name']);
        $uploadFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $uploadFile)) {
            $attachment = $fileName;
        }
    }

    $stmt = $conn->prepare("INSERT INTO appeals (user_id, subject, message, attachment) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $subject, $messageText, $attachment);

    if ($stmt->execute()) {
        $message = "<div class='alert alert-success'>Appeal submitted successfully!</div>";
        logActivity($conn, $user_id, 'Submit Appeal', "Appeal titled '$subject' submitted.");
    } else {
        $message = "<div class='alert alert-danger'>Failed to submit appeal.</div>";
        logActivity($conn, $user_id, 'Submit Appeal Failed', "Failed to submit appeal titled '$subject'.");
    }
}

$profileImage = !empty($_SESSION['user']['profile_image']) ? $_SESSION['user']['profile_image'] : 'default.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard - Add Appeal</title>
  <link rel="icon" href="../image/logo2.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body { background-color: #f4f6f9; }
    .sidebar {
      width: 220px;
      position: fixed;
      height: 100%;
      background: #0d6efd;
      color: white;
      padding-top: 20px;
    }
    .sidebar a {
      color: white;
      display: block;
      padding: 12px 20px;
      text-decoration: none;
    }
    .sidebar a:hover { background: #084298; }
    .topbar {
      height: 60px;
      background: #ffffff;
      border-bottom: 1px solid #ddd;
      padding: 0 20px;
      margin-left: 220px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .dashboard-content {
      margin-left: 220px;
      padding: 30px;
      margin-top: 60px;
    }
    .avatar {
      border-radius: 50%;
      width: 60px;
      height: 60px;
      object-fit: cover;
      border: 2px solid #fff;
    }
    @media (max-width: 768px) {
      .sidebar {
        position: relative;
        width: 100%;
        height: auto;
      }
      .topbar, .dashboard-content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <h4 class="text-center mb-4"><i class="fas fa-user"></i> User Panel</h4>
  <a href="dashboard.php"><i class="fas fa-home me-2"></i> Dashboard</a>
  <a href="add_appeal.php"><i class="fas fa-plus-circle me-2"></i> Add Appeal</a>
  <a href="view_appeals.php"><i class="fas fa-folder-open me-2"></i> View Appeals</a>
  <a href="profile.php"><i class="fas fa-user-circle me-2"></i> My Profile</a>
  <a href="change_password.php"><i class="fas fa-key me-2"></i> Change Password</a>
  <a href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
</div>

<!-- Topbar -->
<div class="topbar">
  <div class="d-flex align-items-center gap-2">
    <img src="../image/<?= htmlspecialchars($profileImage) ?>" class="avatar">
    <strong><?= htmlspecialchars($_SESSION['user']['username']) ?></strong>
  </div>
  <a href="../logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
</div>

<!-- Content -->
<div class="dashboard-content">
  <h3>Add New Appeal</h3>
  <?= $message ?>
  <form method="POST" enctype="multipart/form-data" class="mt-4">
    <div class="mb-3">
      <label for="subject" class="form-label">Appeal Subject</label>
      <input type="text" name="subject" id="subject" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="message" class="form-label">Appeal Message</label>
      <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
    </div>
    <div class="mb-3">
      <label for="attachment" class="form-label">Attach Document (optional)</label>
      <input type="file" name="attachment" id="attachment" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Submit Appeal</button>
    <a href="dashboard.php" class="btn btn-secondary">Back</a>
  </form>
</div>

</body>
</html>
