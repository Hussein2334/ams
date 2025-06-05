<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

include '../db.php';
include '../functions.php';  // <-- Include your logging functions

// Fetch departments
$departments = [];
$dept_stmt = $conn->prepare("SELECT id, name FROM departments");
$dept_stmt->execute();
$dept_result = $dept_stmt->get_result();
while ($row = $dept_result->fetch_assoc()) {
    $departments[] = $row;
}

// Fetch courses for Arusha campus
$courses = [];
$course_stmt = $conn->prepare("SELECT id, name FROM courses WHERE campus = 'Arusha'");
$course_stmt->execute();
$course_result = $course_stmt->get_result();
while ($row = $course_result->fetch_assoc()) {
    $courses[] = $row;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $department_id = $_POST['department'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    $level = $_POST['level'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $image = $_FILES['profile_image'];
    $imageName = 'default.png';

    if ($image['error'] === 0 && $image['size'] > 0) {
        $targetDir = "../image/";
        $imageName = time() . '_' . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $targetDir . $imageName);
    }

    $stmt = $conn->prepare("INSERT INTO users (username, email, department_id, course, year, level, password, role, profile_image) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, 'user', ?)");
    $stmt->bind_param("ssisssss", $username, $email, $department_id, $course, $year, $level, $password, $imageName);

    if ($stmt->execute()) {
        // Log activity - current admin user ID, action, and details
        logActivity($conn, $_SESSION['user']['id'], 'Add User', "Added user: $username, email: $email");

        echo "<script>alert('User added successfully'); window.location.href='manage_users.php';</script>";
    } else {
        echo "<script>alert('Error: could not add user');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add User - Admin Dashboard</title>
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
    @media (max-width: 768px) {
      .sidebar { width: 100%; position: relative; height: auto; }
      .topbar, .content { margin-left: 0; }
    }
  </style>
</head>
<body>
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

<div class="topbar">
  <div class="d-flex align-items-center gap-2">
    <img src="../image/<?= htmlspecialchars($_SESSION['user']['profile_image']) ?>" class="avatar">
    <strong><?= htmlspecialchars($_SESSION['user']['username']) ?></strong>
  </div>
  <a href="../logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
</div>

<div class="content">
  <h3 class="mb-4">Add New User</h3>
  <form method="POST" enctype="multipart/form-data" class="p-4 bg-white shadow rounded">
    <div class="row mb-3">
      <div class="col-md-6">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label>Course of Study</label>
        <select name="course" class="form-select" required>
          <option value="">Select Course</option>
          <?php foreach ($courses as $course): ?>
            <option value="<?= htmlspecialchars($course['name']) ?>">
              <?= htmlspecialchars($course['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4">
        <label>Year of Study</label>
        <select name="year" class="form-select" required>
          <option value="">Select</option>
          <option>1</option><option>2</option><option>3</option><option>4</option>
        </select>
      </div>
      <div class="col-md-4">
        <label>Level</label>
        <select name="level" class="form-select" required>
          <option value="">Select</option>
          <option>Certificate</option><option>Diploma</option><option>Degree</option>
          <option>Master</option><option>SPA</option><option>SPB</option><option>Other</option>
        </select>
      </div>
      <div class="col-md-4">
        <label>Department</label>
        <select name="department" class="form-select" required>
          <option value="">Select Department</option>
          <?php foreach ($departments as $dept): ?>
            <option value="<?= $dept['id'] ?>"><?= htmlspecialchars($dept['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="mb-3">
      <label>Profile Image</label>
      <input type="file" name="profile_image" accept="image/*" class="form-control">
    </div>
    <div class="text-end">
      <button class="btn btn-primary" type="submit">Add User</button>
      <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
    </div>
  </form>
</div>
</body>
</html>
