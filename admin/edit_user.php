<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

include '../db.php';
include '../functions.php';  // Include the logging functions

if (!isset($_GET['id'])) {
    echo "<script>alert('No user selected.'); window.location.href='dashboard.php';</script>";
    exit;
}

$user_id = $_GET['id'];

// Fetch departments
$departments = [];
$dept_stmt = $conn->prepare("SELECT id, name FROM departments");
$dept_stmt->execute();
$dept_result = $dept_stmt->get_result();
while ($row = $dept_result->fetch_assoc()) {
    $departments[] = $row;
}
$dept_stmt->close();

// Fetch user details
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo "<script>alert('User not found.'); window.location.href='dashboard.php';</script>";
    exit;
}
$user = $result->fetch_assoc();
$stmt->close();

// Update user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $department_id = $_POST['department'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    $level = $_POST['level'];

    $image = $_FILES['profile_image'];
    $imageName = $user['profile_image']; // Keep current if no new image uploaded

    if ($image['error'] === 0 && $image['size'] > 0) {
        $targetDir = "../image/";
        $imageName = time() . '_' . basename($image['name']);
        if (!move_uploaded_file($image['tmp_name'], $targetDir . $imageName)) {
            echo "<script>alert('Failed to upload profile image.');</script>";
        }
    }

    $update = $conn->prepare("UPDATE users SET username=?, email=?, department_id=?, course=?, year=?, level=?, profile_image=? WHERE id=?");
    $update->bind_param("ssissssi", $username, $email, $department_id, $course, $year, $level, $imageName, $user_id);

    if ($update->execute()) {
        // Log the activity with action and details
        $admin_id = $_SESSION['user']['id'];
        $admin_name = $_SESSION['user']['username'];
        $action = "Updated User";
        $details = "Admin '{$admin_name}' (ID: {$admin_id}) updated user '{$username}' (ID: {$user_id}) with email '{$email}', department_id {$department_id}, course '{$course}', year {$year}, level '{$level}', profile image '{$imageName}'";
        logActivity($conn, $admin_id, $action, $details);

        echo "<script>alert('User updated successfully'); window.location.href='manage_users.php';</script>";
    } else {
        echo "<script>alert('Failed to update user.');</script>";
    }
}

$profileImage = !empty($_SESSION['user']['profile_image']) ? $_SESSION['user']['profile_image'] : 'default.png';
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User - Admin Dashboard</title>
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
      }
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

<!-- Edit Form in Dashboard Layout -->
<div class="dashboard-content">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h4>Edit User</h4>
    </div>
    <div class="card-body">
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label>Username</label>
          <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>
        <div class="mb-3">
          <label>Course</label>
          <input type="text" name="course" class="form-control" value="<?= htmlspecialchars($user['course']) ?>" required>
        </div>
        <div class="mb-3">
          <label>Year</label>
          <select name="year" class="form-select" required>
            <?php for ($i = 1; $i <= 4; $i++): ?>
              <option value="<?= $i ?>" <?= $user['year'] == $i ? 'selected' : '' ?>><?= $i ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <div class="mb-3">
          <label>Level</label>
          <select name="level" class="form-select" required>
            <?php
              $levels = ['Certificate', 'Diploma', 'Degree', 'Master', 'SPA', 'SPB', 'Other'];
              foreach ($levels as $level) {
                echo "<option value=\"$level\" " . ($user['level'] === $level ? 'selected' : '') . ">$level</option>";
              }
            ?>
          </select>
        </div>
        <div class="mb-3">
          <label>Department</label>
          <select name="department" class="form-select" required>
            <?php foreach ($departments as $dept): ?>
              <option value="<?= $dept['id'] ?>" <?= $user['department_id'] == $dept['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($dept['name']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-3">
          <label>Profile Image</label><br>
          <img src="../image/<?= htmlspecialchars($user['profile_image']) ?>" width="80" height="80" style="border-radius: 50%; object-fit: cover;">
          <input type="file" name="profile_image" class="form-control mt-2" accept="image/*">
        </div>
        <div class="d-flex justify-content-between">
          <a href="manage_users.php.php" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-success">Update User</button>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
