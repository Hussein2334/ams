<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

include '../db.php';
include '../functions.php'; // for logActivity()

$userId = $_SESSION['user']['id'];

// Handle POST actions: approve, reject, delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['appeal_id'])) {
    $appealId = intval($_POST['appeal_id']);
    $action = $_POST['action'];

    // Fetch appeal info for logging and deletion
    $stmt = $conn->prepare("SELECT subject, user_id, attachment FROM appeals WHERE id = ?");
    $stmt->bind_param("i", $appealId);
    $stmt->execute();
    $result = $stmt->get_result();
    $appeal = $result->fetch_assoc();
    $stmt->close();

    if ($appeal) {
        if ($action === 'approve' || $action === 'reject') {
            $status = ($action === 'approve') ? 'Approved' : 'Rejected';
            $stmt = $conn->prepare("UPDATE appeals SET status = ? WHERE id = ?");
            $stmt->bind_param("si", $status, $appealId);
            $stmt->execute();
            $stmt->close();

            logActivity($conn, $userId, ucfirst($action) . " Appeal", "Appeal ID: $appealId, Subject: '{$appeal['subject']}' set to $status");
        } elseif ($action === 'delete') {
            if ($appeal['attachment'] && file_exists('../uploads/' . $appeal['attachment'])) {
                unlink('../uploads/' . $appeal['attachment']);
            }
            $stmt = $conn->prepare("DELETE FROM appeals WHERE id = ?");
            $stmt->bind_param("i", $appealId);
            $stmt->execute();
            $stmt->close();

            logActivity($conn, $userId, "Deleted Appeal", "Appeal ID: $appealId, Subject: '{$appeal['subject']}' deleted");
        }
    }
    header("Location: manage_appeals.php");
    exit;
}

// Fetch all appeals
$query = "SELECT a.*, u.username, u.email FROM appeals a JOIN users u ON a.user_id = u.id ORDER BY a.created_at DESC";
$result = $conn->query($query);

function statusBadge($status) {
    switch ($status) {
        case 'Approved': return '<span class="badge bg-success">Approved</span>';
        case 'Rejected': return '<span class="badge bg-danger">Rejected</span>';
        default: return '<span class="badge bg-warning text-dark">Pending</span>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Manage Appeals - Admin - IAA Appeal System</title>
    <link rel="icon" href="../image/logo2.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            height: 100vh; position: fixed; background: #0d6efd; color: #fff;
            width: 220px; padding-top: 30px;
        }
        .sidebar a {
            color: #fff; display: block; padding: 12px 20px; text-decoration: none;
        }
        .sidebar a:hover { background-color: #084298; }
        .dashboard-content {
            margin-left: 220px; padding: 30px; max-width: 1200px;
        }
        .profile-box {
            position: fixed; right: 30px; top: 30px;
            background: white; padding: 15px; border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: flex; align-items: center; gap: 15px;
        }
        .profile-box img {
            width: 50px; height: 50px; border-radius: 50%;
            object-fit: cover; border: 2px solid #0d6efd;
        }
        @media (max-width: 768px) {
            .sidebar { position: relative; width: 100%; height: auto; }
            .dashboard-content { margin-left: 0; }
            .profile-box {
                position: relative; margin-bottom: 20px; justify-content: center;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4 class="text-center mb-4"><i class="fas fa-gavel"></i> Admin Panel</h4>
    <a href="dashboard.php"><i class="fas fa-home me-2"></i> Dashboard</a>
    <a href="manage_appeals.php" class="bg-primary"><i class="fas fa-folder-open me-2"></i> Manage Appeals</a>
    <a href="add_user.php"><i class="fas fa-user-plus me-2"></i> Add User</a>
    <a href="manage_users.php"><i class="fas fa-users me-2"></i> Manage Users</a>
    <a href="profile.php"><i class="fas fa-user-circle me-2"></i> My Profile</a>
    <a href="change_password.php"><i class="fas fa-key me-2"></i> Change Password</a>
    <a href="view_logs.php"><i class="fas fa-clipboard-list me-2"></i> Activity Logs</a>
    <a href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
</div>

<div class="dashboard-content">
    <h2 class="mb-4">Manage Appeals</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle bg-white">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Attachment</th>
                    <th>Status</th>
                    <th>Submitted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td>
                        <strong><?= htmlspecialchars($row['username']) ?></strong><br />
                        <small><?= htmlspecialchars($row['email']) ?></small>
                    </td>
                    <td><?= htmlspecialchars($row['subject']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                    <td>
                        <?php if ($row['attachment'] && file_exists('../uploads/' . $row['attachment'])): ?>
                            <a href="../uploads/<?= htmlspecialchars($row['attachment']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-file-download"></i> View
                            </a>
                        <?php else: ?>
                            <span class="text-muted">No Attachment</span>
                        <?php endif; ?>
                    </td>
                    <td><?= statusBadge($row['status']) ?></td>
                    <td><?= date('Y-m-d H:i', strtotime($row['created_at'])) ?></td>
                    <td>
                        <form method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                            <input type="hidden" name="appeal_id" value="<?= $row['id'] ?>" />
                            <?php if ($row['status'] === 'Pending'): ?>
                                <button type="submit" name="action" value="approve" class="btn btn-success btn-sm mb-1">Approve</button>
                                <button type="submit" name="action" value="reject" class="btn btn-warning btn-sm mb-1">Reject</button>
                            <?php endif; ?>
                            <button type="submit" name="action" value="delete" class="btn btn-danger btn-sm mb-1">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Profile -->
<div class="profile-box">
    <img src="../image/<?= htmlspecialchars($_SESSION['user']['profile_image'] ?? 'default.png') ?>" alt="Profile Image" />
    <div>
        <strong><?= htmlspecialchars($_SESSION['user']['username']) ?></strong><br />
        <a href="../logout.php" class="btn btn-sm btn-outline-danger mt-1">Logout</a>
    </div>
</div>

</body>
</html>
