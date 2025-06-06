<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

include '../db.php';
include '../functions.php'; // Assume it has logActivity()

$profileImage = !empty($_SESSION['user']['profile_image']) ? $_SESSION['user']['profile_image'] : 'default.png';

$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validate form inputs
    if (empty($current_password)) {
        $errors[] = "Please enter your current password.";
    }
    if (empty($new_password)) {
        $errors[] = "Please enter a new password.";
    } elseif (strlen($new_password) < 6) {
        $errors[] = "New password must be at least 6 characters.";
    }
    if ($new_password !== $confirm_password) {
        $errors[] = "New password and confirm password do not match.";
    }

    if (empty($errors)) {
        // Fetch current password hash from DB
        $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->bind_param("i", $_SESSION['user']['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (!$user || !password_verify($current_password, $user['password'])) {
            $errors[] = "Current password is incorrect.";
        } else {
            // Hash new password and update
            $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $updateStmt->bind_param("si", $new_password_hash, $_SESSION['user']['id']);
            if ($updateStmt->execute()) {
                $success = "Password changed successfully.";
                // Log password change activity
                logActivity($conn, $_SESSION['user']['id'], 'Password Changed', 'User changed their password');
            } else {
                $errors[] = "Failed to update password. Please try again.";
            }
            $updateStmt->close();
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Change Password - Admin Dashboard</title>
  <link rel="icon" href="../image/logo2.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
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
      max-width: 600px;
    }
    .avatar {
      border-radius: 50%;
      width: 80px;
      height: 80px;
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
        max-width: 100%;
        padding: 15px;
      }
    }
     .password-toggle {
      cursor: pointer;
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #6c757d;
    } 
    .position-relative {
      position: relative;
    }
  </style>
</head>
<body>

<!-- Sidebar -->
  <div class="sidebar">
    <h4 class="text-center mb-4"><i class="fas fa-gavel"></i> Admin Panel</h4>
    <a href="dashboard.php"><i class="fas fa-home me-2"></i> Dashboard</a>
    <a href="manage_appeals.php"><i class="fas fa-folder-open me-2"></i> Manage Appeals</a>
    <a href="add_user.php"><i class="fas fa-user-plus me-2"></i> Add User</a>
    <a href="manage_user.php"><i class="fas fa-users me-2"></i> Manage Users</a>
    <a href="profile.php"><i class="fas fa-user-circle me-2"></i> My Profile</a>
    <a href="change_password.php" class="bg-primary"><i class="fas fa-key me-2"></i> Change Password</a>
    <a href="view_logs.php"><i class="fas fa-clipboard-list me-2"></i> Activity Logs</a>
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

<!-- Change Password Content -->
<div class="dashboard-content">
  <h3 class="mb-4">Change Password</h3>

  <?php if ($success): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
  <?php endif; ?>

  <?php if ($errors): ?>
    <div class="alert alert-danger">
      <ul class="mb-0">
        <?php foreach ($errors as $error): ?>
          <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <form method="post" novalidate>
    <div class="mb-3 position-relative">
      <label for="current_password" class="form-label">Current Password</label>
      <input type="password" name="current_password" id="current_password" class="form-control" required />
      <i class="fas fa-eye password-toggle" onclick="togglePassword('current_password', this)"></i>
    </div>

    <div class="mb-3 position-relative">
      <label for="new_password" class="form-label">New Password</label>
      <input type="password" name="new_password" id="new_password" class="form-control" minlength="6" required />
      <i class="fas fa-eye password-toggle" onclick="togglePassword('new_password', this)"></i>
    </div>

    <div class="mb-3 position-relative">
      <label for="confirm_password" class="form-label">Confirm New Password</label>
      <input type="password" name="confirm_password" id="confirm_password" class="form-control" minlength="6" required />
      <i class="fas fa-eye password-toggle" onclick="togglePassword('confirm_password', this)"></i>
    </div>

    <button type="submit" class="btn btn-primary w-100">Change Password</button>
  </form>
</div>

<script>
function togglePassword(fieldId, icon) {
  const input = document.getElementById(fieldId);
  if (input.type === "password") {
    input.type = "text";
    icon.classList.remove('fa-eye');
    icon.classList.add('fa-eye-slash');
  } else {
    input.type = "password";
    icon.classList.remove('fa-eye-slash');
    icon.classList.add('fa-eye');
  }
}
</script>

</body>
</html>
