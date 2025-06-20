<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

include '../db.php';
include '../functions.php'; // contains logActivity()

// Log dashboard visit
logActivity($conn, $_SESSION['user']['id'], 'Access Dashboard', 'Admin accessed the dashboard page');

// Fetch total users
$stmt = $conn->prepare("SELECT COUNT(*) AS total_users FROM users");
$stmt->execute();
$result = $stmt->get_result();
$totalUsers = $result->fetch_assoc()['total_users'];

// Fetch total logs
$stmt = $conn->prepare("SELECT COUNT(*) AS total_logs FROM activity_logs");
$stmt->execute();
$result = $stmt->get_result();
$totalLogs = $result->fetch_assoc()['total_logs'];

// Fetch appeal statistics
$totalAppeals = $conn->query("SELECT COUNT(*) AS count FROM appeals")->fetch_assoc()['count'];
$approvedAppeals = $conn->query("SELECT COUNT(*) AS count FROM appeals WHERE status = 'approved'")->fetch_assoc()['count'];
$rejectedAppeals = $conn->query("SELECT COUNT(*) AS count FROM appeals WHERE status = 'rejected'")->fetch_assoc()['count'];
$pendingAppeals = $conn->query("SELECT COUNT(*) AS count FROM appeals WHERE status = 'pending'")->fetch_assoc()['count'];

$profileImage = !empty($_SESSION['user']['profile_image']) ? $_SESSION['user']['profile_image'] : 'default.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard - Appeal System</title>
  <link rel="icon" href="../image/logo2.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    .stat-card {
      border-radius: 12px;
      padding: 20px;
      color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
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

<!-- Dashboard Content -->
<div class="dashboard-content">
  <div class="row g-4">
    <!-- Total Users -->
    <div class="col-md-3">
      <div class="stat-card" style="background: #6610f2;">
        <div>
          <h5>Total Users</h5>
          <h3><?= $totalUsers ?></h3>
          <span>Registered Accounts</span>
        </div>
        <i class="fas fa-users fa-2x"></i>
      </div>
    </div>
    <!-- Activity Logs -->
    <div class="col-md-3">
      <div class="stat-card" style="background: #0d6efd;">
        <div>
          <h5>Total Logs</h5>
          <h3><?= $totalLogs ?></h3>
          <span>Activities Recorded</span>
        </div>
        <i class="fas fa-eye fa-2x"></i>
      </div>
    </div>
    <!-- Appeals Approved -->
    <div class="col-md-3">
      <div class="stat-card" style="background: #198754;">
        <div>
          <h5>Appeals Approved</h5>
          <h3><?= $approvedAppeals ?></h3>
          <span>Confirmed</span>
        </div>
        <i class="fas fa-check-circle fa-2x"></i>
      </div>
    </div>
    <!-- Appeals Pending -->
    <div class="col-md-3">
      <div class="stat-card" style="background: #dc3545;">
        <div>
          <h5>Appeals Pending</h5>
          <h3><?= $pendingAppeals ?></h3>
          <span>Awaiting Review</span>
        </div>
        <i class="fas fa-clock fa-2x"></i>
      </div>
    </div>
  </div>

  <!-- Chart and Profile -->
  <div class="row mt-5 g-4">
    <div class="col-md-4">
      <div class="card p-3 text-center">
        <img src="../image/<?= htmlspecialchars($profileImage) ?>" class="avatar mx-auto mb-2" />
        <h5><?= htmlspecialchars($_SESSION['user']['username']) ?></h5>
        <p class="text-muted">System Administrator</p>
      </div>
    </div>

    <div class="col-md-8">
      <div class="card p-3">
        <h5>Appeal Statistics</h5>
        <canvas id="appealChart" height="150"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Chart Script -->
<script>
const ctx = document.getElementById('appealChart').getContext('2d');
new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Pending', 'Approved', 'Rejected'],
    datasets: [{
      label: 'Appeals',
      data: [<?= $pendingAppeals ?>, <?= $approvedAppeals ?>, <?= $rejectedAppeals ?>],
      backgroundColor: ['#ffc107', '#198754', '#dc3545']
    }]
  },
  options: {
    responsive: true,
    plugins: { legend: { display: false } }
  }
});
</script>

</body>
</html>
