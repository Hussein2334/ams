<?php
session_start();
include 'db.php';           // Database connection
include 'functions.php';    // Include the logActivity function

$loginFeedback = '';

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            // Store user info in session
            $_SESSION['user'] = [
                'id' => $row['id'],
                'username' => $row['username'],
                'email' => $row['email'],
                'role' => $row['role'],
                'profile_image' => $row['profile_image'] ?? 'default.png'
            ];

            // Log successful login
            logActivity($conn, $row['id'], 'Login', $row['role'] === 'admin' ? 'Admin logged in' : 'User logged in');

            if ($row['role'] === 'admin') {
                $loginFeedback = "Swal.fire('Login Success!', 'Welcome Admin', 'success').then(() => {
                    window.location.href = 'admin/dashboard.php';
                });";
            } else {
                $loginFeedback = "Swal.fire('Login Success!', 'Welcome User', 'success').then(() => {
                    window.location.href = 'user/dashboard.php';
                });";
            }
        } else {
            // Log incorrect password attempt
            logActivity($conn, $row['id'], 'Failed Login', 'Incorrect password');

            $loginFeedback = "Swal.fire('Login Failed!', 'Incorrect password.', 'error');";
        }
    } else {
        // Log attempt with unknown email, pass NULL user_id to avoid FK error
        logActivity($conn, null, 'Failed Login', 'User not found: ' . $email);

        $loginFeedback = "Swal.fire('Login Failed!', 'User not found.', 'error');";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login - Appeal System</title>
  <link rel="icon" href="image/logo2.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-primary">
  <div class="card p-4" style="width: 350px;">
    <div class="text-center mb-3">
      <img src="image/logo2.png" alt="Logo" width="80" />
      <h3 class="mt-2">Login</h3>
    </div>
    <form method="POST" action="">
      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required />
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required />
      </div>
      <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    <?= $loginFeedback ?>
  </script>
</body>
</html>
