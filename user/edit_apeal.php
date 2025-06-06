<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}

include '../db.php';
include '../functions.php';

$userId = $_SESSION['user']['id'];
$profileImage = !empty($_SESSION['user']['profile_image']) ? $_SESSION['user']['profile_image'] : 'default.png';
$appealId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch existing appeal
$stmt = $conn->prepare("SELECT * FROM appeals WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $appealId, $userId);
$stmt->execute();
$result = $stmt->get_result();
$appeal = $result->fetch_assoc();

if (!$appeal) {
    echo "Appeal not found or unauthorized.";
    exit;
}

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    $attachment = $appeal['attachment'];

    // Handle new file upload
    if (!empty($_FILES['attachment']['name'])) {
        $fileName = basename($_FILES['attachment']['name']);
        $fileTmp = $_FILES['attachment']['tmp_name'];
        $targetPath = "../uploads/" . $fileName;

        if (move_uploaded_file($fileTmp, $targetPath)) {
            $attachment = $fileName;
        } else {
            $error = "Failed to upload new file.";
        }
    }

    if (empty($subject) || empty($message)) {
        $error = "Please fill in all required fields.";
    }

    if (!$error) {
        $stmt = $conn->prepare("UPDATE appeals SET subject = ?, message = ?, attachment = ? WHERE id = ? AND user_id = ?");
        $stmt->bind_param("sssii", $subject, $message, $attachment, $appealId, $userId);
        if ($stmt->execute()) {
            logActivity($conn, $userId, 'Edit Appeal', "Edited appeal ID $appealId");
            $success = "Appeal updated successfully!";
            // Refresh appeal data
            $appeal['subject'] = $subject;
            $appeal['message'] = $message;
            $appeal['attachment'] = $attachment;
        } else {
            $error = "Failed to update appeal.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Appeal - Dashboard</title>
  <link rel="icon" href="../image/logo2.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f6f9;
    }
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
    .sidebar a:hover {
      background: #084298;
    }
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
      border: 3px solid #fff;
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
    <img src="../image/<?= htmlspecialchars($profileImage) ?>" class="avatar" />
    <strong><?= htmlspecialchars($_SESSION['user']['username']) ?></strong>
  </div>
  <a href="../logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
</div>

<!-- Dashboard Content -->
<div class="dashboard-content">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h4><i class="fas fa-edit"></i> Edit Appeal</h4>
    </div>
    <div class="card-body">
      <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
      <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
      <?php endif; ?>

      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label">Subject</label>
          <input type="text" name="subject" class="form-control" value="<?= htmlspecialchars($appeal['subject']) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Message</label>
          <textarea name="message" class="form-control" rows="5" required><?= htmlspecialchars($appeal['message']) ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Attachment</label><br>
          <?php if ($appeal['attachment']): ?>
            <a href="../uploads/<?= htmlspecialchars($appeal['attachment']) ?>" target="_blank" class="btn btn-sm btn-secondary mb-2">
              View Current File
            </a><br>
          <?php endif; ?>
          <input type="file" name="attachment" class="form-control">
          <small class="text-muted">Leave blank to keep existing file.</small>
        </div>

        <div class="d-flex justify-content-between">
          <a href="view_appeals.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
          <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update Appeal</button>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
