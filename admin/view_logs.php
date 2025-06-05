<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
include '../db.php';

$result = $conn->query("SELECT activity_logs.*, users.username FROM activity_logs JOIN users ON activity_logs.user_id = users.id ORDER BY timestamp DESC");
$profileImage = !empty($_SESSION['user']['profile_image']) ? $_SESSION['user']['profile_image'] : 'default.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Activity Logs - Admin Dashboard</title>
  <link rel="icon" href="../image/logo2.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
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
      .sidebar { position: relative; width: 100%; height: auto; }
      .topbar, .dashboard-content { margin-left: 0; }
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

<!-- Dashboard Content -->
<div class="dashboard-content">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">System Activity Logs</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="logsTable" class="table table-bordered table-striped">
          <thead class="table-dark">
            <tr>
              <th>User</th>
              <th>Action</th>
              <th>Details</th>
              <th>Timestamp</th>
            </tr>
          </thead>
          <tbody>
          <?php while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['username']) ?></td>
              <td><?= htmlspecialchars($row['action']) ?></td>
              <td><?= htmlspecialchars($row['details']) ?></td>
              <td><?= $row['timestamp'] ?></td>
            </tr>
          <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready(function() {
    $('#logsTable').DataTable();
  });
</script>

</body>
</html>
