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

// Fetch appeals
$appeals = [];
$stmt = $conn->prepare("SELECT * FROM appeals WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $appeals[] = $row;
}

logActivity($conn, $userId, "View Appeals", "Visited appeals table");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Appeals - Dashboard</title>
  <link rel="icon" href="../image/logo2.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
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

<!-- Content Area -->
<div class="dashboard-content">
  <div class="card shadow-sm">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0"><i class="fas fa-table"></i> My Appeals</h4>
      <a href="add_appeal.php" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Add Appeal</a>
    </div>
    <div class="card-body">
      <table id="appealsTable" class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Attachment</th>
            <th>Submitted At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($appeals as $index => $appeal): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><?= htmlspecialchars($appeal['subject']) ?></td>
              <td><?= htmlspecialchars($appeal['message']) ?></td>
              <td>
                <?php if (!empty($appeal['attachment'])): ?>
                  <a href="../uploads/<?= htmlspecialchars($appeal['attachment']) ?>" target="_blank" class="btn btn-sm btn-info">
                    <i class="fas fa-file-alt"></i> View
                  </a>
                <?php else: ?>
                  <span class="text-muted">None</span>
                <?php endif; ?>
              </td>
              <td><?= date('d M Y, H:i A', strtotime($appeal['created_at'])) ?></td>
              <td>
                <a href="edit_apeal.php?id=<?= $appeal['id'] ?>" class="btn btn-sm btn-warning">
                  <i class="fas fa-edit"></i> Edit
                </a>
                <a href="delete_appeal.php?id=<?= $appeal['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this appeal?')">
                  <i class="fas fa-trash"></i> Delete
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready(function () {
    $('#appealsTable').DataTable();
  });
</script>

</body>
</html>
