<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}

include '../db.php';
include '../functions.php'; // Include the logging functions

$userId = $_SESSION['user']['id'];

// Fetch current user data
$stmt = $conn->prepare("SELECT username, email, address, phone, gender, profile_image, department_id FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Fetch all departments
$departments = [];
$deptStmt = $conn->query("SELECT id, name FROM departments");
while ($row = $deptStmt->fetch_assoc()) {
    $departments[] = $row;
}
$deptStmt->close();

// Initialize message variables
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $gender = $_POST['gender'];
    $department_id = intval($_POST['department_id']);

    // Validate required fields
    if (empty($username) || empty($email) || empty($address) || empty($phone) || empty($gender) || $department_id === 0) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Handle image upload
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['profile_image']['tmp_name'];
            $fileName = $_FILES['profile_image']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($fileExtension, $allowedExts)) {
                $newFileName = $userId . '_' . time() . '.' . $fileExtension;
                $uploadFileDir = '../image/';
                $destPath = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    // Delete old image if exists and not default
                    if (!empty($user['profile_image']) && $user['profile_image'] !== 'default.png' && file_exists($uploadFileDir . $user['profile_image'])) {
                        unlink($uploadFileDir . $user['profile_image']);
                    }
                    $stmt = $conn->prepare("UPDATE users SET profile_image = ? WHERE id = ?");
                    $stmt->bind_param("si", $newFileName, $userId);
                    $stmt->execute();
                    $stmt->close();

                    $_SESSION['user']['profile_image'] = $newFileName;
                    $user['profile_image'] = $newFileName;
                } else {
                    $error = "There was an error moving the uploaded file.";
                }
            } else {
                $error = "Upload failed. Allowed file types: " . implode(", ", $allowedExts);
            }
        }

        if (empty($error)) {
            $stmt = $conn->prepare("UPDATE users SET username=?, email=?, address=?, phone=?, gender=?, department_id=? WHERE id=?");
            $stmt->bind_param("ssssssi", $username, $email, $address, $phone, $gender, $department_id, $userId);

            if ($stmt->execute()) {
                $stmt->close();

                // Update session variables
                $_SESSION['user']['username'] = $username;
                $_SESSION['user']['email'] = $email;
                $_SESSION['user']['address'] = $address;
                $_SESSION['user']['phone'] = $phone;
                $_SESSION['user']['gender'] = $gender;
                $_SESSION['user']['department_id'] = $department_id;

                // Log the profile update activity
                $action = "Updated Profile";
                $details = "User '{$username}' (ID: {$userId}) updated their profile details: email='{$email}', address='{$address}', phone='{$phone}', gender='{$gender}', department_id={$department_id}, profile_image='{$user['profile_image']}'";
                logActivity($conn, $userId, $action, $details);

                $success = "Profile updated successfully!";
                $user = [
                    'username' => $username,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone,
                    'gender' => $gender,
                    'profile_image' => $_SESSION['user']['profile_image'] ?? 'default.png',
                    'department_id' => $department_id
                ];
            } else {
                $error = "Error updating profile.";
            }
        }
    }
}

$profileImage = !empty($user['profile_image']) ? $user['profile_image'] : 'default.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Profile - Admin - IAA Appeal System</title>
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
      margin-left: 220px; padding: 30px; max-width: 800px;
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
    .profile-image-preview {
      width: 120px; height: 120px; border-radius: 50%;
      object-fit: cover; border: 3px solid #0d6efd; margin-bottom: 15px;
    }
  </style>
</head>
<body>

 <!-- Sidebar -->

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

<div class="dashboard-content">
  <h2>Edit Profile</h2>

  <?php if ($success): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
  <?php endif; ?>
  <?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form action="profile.php" method="POST" enctype="multipart/form-data" novalidate>
    <div class="mb-3 text-center">
      <img src="../image/<?= htmlspecialchars($profileImage) ?>" alt="Profile Image" class="profile-image-preview" id="imagePreview" />
      <input type="file" name="profile_image" id="profileImageInput" accept="image/*" class="form-control mt-2" />
    </div>

    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required />
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required />
    </div>

    <div class="mb-3">
      <label for="address" class="form-label">Address</label>
      <input type="text" name="address" id="address" class="form-control" value="<?= htmlspecialchars($user['address']) ?>" required />
    </div>

    <div class="mb-3">
      <label for="phone" class="form-label">Phone</label>
      <input type="text" name="phone" id="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>" required />
    </div>

    <div class="mb-3">
      <label for="department_id" class="form-label">Department</label>
      <select name="department_id" id="department_id" class="form-select" required>
        <option value="">-- Select Department --</option>
        <?php foreach ($departments as $dept): ?>
          <option value="<?= $dept['id'] ?>" <?= ($user['department_id'] == $dept['id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($dept['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Gender</label><br />
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="male" value="Male" <?= ($user['gender'] === 'Male') ? 'checked' : '' ?> required />
        <label class="form-check-label" for="male">Male</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?= ($user['gender'] === 'Female') ? 'checked' : '' ?> required />
        <label class="form-check-label" for="female">Female</label>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Update Profile</button>
  </form>
</div>

<div class="profile-box">
  <img src="../image/<?= htmlspecialchars($profileImage) ?>" alt="Profile Image" />
  <div>
    <strong><?= htmlspecialchars($user['username']) ?></strong><br />
    <a href="../logout.php" class="btn btn-sm btn-outline-danger mt-1">Logout</a>
  </div>
</div>

<script>
  document.getElementById('profileImageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(evt) {
        document.getElementById('imagePreview').src = evt.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
</script>

</body>
</html>
