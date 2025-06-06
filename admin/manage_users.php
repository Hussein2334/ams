<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

include '../db.php';
include '../functions.php';  // Your logActivity function must be here

// Log admin page access — prevent duplicate logs by checking session or use a flag if needed
$admin_id = $_SESSION['user']['id'];
$admin_name = $_SESSION['user']['username'];
$action = "Accessed Manage Users page";
$details = "Admin '{$admin_name}' (ID: {$admin_id}) accessed the Manage Users page";
logActivity($conn, $admin_id, $action, $details);

// Fetch users with their department names
$stmt = $conn->prepare("
    SELECT users.*, departments.name AS department_name 
    FROM users 
    LEFT JOIN departments ON users.department_id = departments.id 
    WHERE users.role = 'user'
    ORDER BY users.username ASC
");
$stmt->execute();
$result = $stmt->get_result();

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}
$stmt->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Users</title>
  <link rel="icon" href="../image/logo2.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body { background-color: #f4f6f9; }
    .sidebar {
      width: 220px; height: 100vh; position: fixed;
      background: #0d6efd; color: white; padding-top: 20px;
    }
    .sidebar a {
      color: white; display: block; padding: 12px 20px; text-decoration: none;
    }
    .sidebar a:hover { background: #084298; }
    .topbar {
      height: 60px; background: #ffffff; border-bottom: 1px solid #ddd;
      padding: 0 20px; margin-left: 220px; display: flex; align-items: center;
      justify-content: space-between;
    }
    .content {
      margin-left: 220px; padding: 30px; margin-top: 60px;
    }
    .avatar {
      border-radius: 50%; width: 40px; height: 40px;
      object-fit: cover; border: 2px solid #fff;
    }
    .profile-thumb {
      width: 60px; height: 60px;
      object-fit: cover; border-radius: 50%;
    }
    @media (max-width: 768px) {
      .sidebar { width: 100%; position: relative; height: auto; }
      .topbar, .content { margin-left: 0; }
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
    <a href="manage_users.php"><i class="fas fa-users me-2"></i> Manage Users</a>
    <a href="profile.php"><i class="fas fa-user-circle me-2"></i> My Profile</a>
    <a href="change_password.php" class="bg-primary"><i class="fas fa-key me-2"></i> Change Password</a>
    <a href="view_logs.php"><i class="fas fa-clipboard-list me-2"></i> Activity Logs</a>
    <a href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
  </div>

<div class="topbar">
  <div class="d-flex align-items-center gap-2">
    <img src="../image/<?= htmlspecialchars($_SESSION['user']['profile_image']) ?>" class="avatar">
    <strong><?= htmlspecialchars($_SESSION['user']['username']) ?></strong>
  </div>
  <a href="../logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
</div>

<div class="content">
  <h3 class="mb-4">Manage Users</h3>
  <table class="table table-bordered table-hover bg-white shadow-sm">
    <thead class="table-primary">
      <tr>
        <th>#</th>
        <th>Profile</th>
        <th>Username</th>
        <th>Email</th>
        <th>Course</th>
        <th>Year</th>
        <th>Level</th>
        <th>Department</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $index => $user): ?>
        <tr>
          <td><?= $index + 1 ?></td>
          <td><img src="../image/<?= htmlspecialchars($user['profile_image']) ?>" class="profile-thumb"></td>
          <td><?= htmlspecialchars($user['username']) ?></td>
          <td><?= htmlspecialchars($user['email']) ?></td>
          <td><?= htmlspecialchars($user['course']) ?></td>
          <td><?= htmlspecialchars($user['year']) ?></td>
          <td><?= htmlspecialchars($user['level']) ?></td>
          <td><?= htmlspecialchars($user['department_name']) ?></td>
          <td>
            <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
            <a href="delete_user.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
