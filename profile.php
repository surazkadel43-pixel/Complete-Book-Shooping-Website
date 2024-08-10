<?php
require_once 'config/config.php';
require_once 'includes/auth.php';

redirect_if_not_logged_in();

$user_id = $_SESSION['user_id'];
$error_message = '';
$success_message = '';

// Fetch user data
$stmt = $pdo->prepare("SELECT name, username, email FROM users WHERE id = :user_id");
$stmt->execute([':user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name']);
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $current_password = $_POST['current_password'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  // Input validation
  if (empty($name) || empty($username) || empty($email) || empty($current_password)) {
    $error_message = 'Please fill in all required fields.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_message = 'Invalid email format.';
  } elseif (!empty($new_password) && $new_password !== $confirm_password) {
    $error_message = 'New password and confirm password do not match.';
  } else {
    // Verify current password
    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = :user_id");
    $stmt->execute([':user_id' => $user_id]);
    $hashed_password = $stmt->fetchColumn();

    if (!password_verify($current_password, $hashed_password)) {
      $error_message = 'Current password is incorrect.';
    } else {
      // Update user details
      $update_fields = [
        'name' => $name,
        'username' => $username,
        'email' => $email
      ];

      if (!empty($new_password)) {
        $update_fields['password'] = password_hash($new_password, PASSWORD_DEFAULT);
      }

      $placeholders = array_map(fn($key) => "$key = :$key", array_keys($update_fields));
      $sql = "UPDATE users SET " . implode(', ', $placeholders) . " WHERE id = :user_id";
      $update_fields['user_id'] = $user_id;

      try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($update_fields);
        $success_message = 'Profile updated successfully.';
      } catch (PDOException $e) {
        if ($e->getCode() === '23000') {
          $error_message = 'Username or email already exists.';
        } else {
          $error_message = 'An error occurred while updating your profile.';
        }
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
  <!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="images/logo.png" alt="Logo" class="img-fluid" style="max-height: 50px;">
        Book Review Hub
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="profile.php"><i class="fa fa-user-circle"></i> Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reviews.php"><i class="fa fa-comments"></i> Reviews</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="wishlist.php"><i class="fa fa-heart"></i> Wishlist</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php"><i class="fa fa-sign-out-alt"></i> Sign Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Breadcrumbs -->
  <nav aria-label="breadcrumb" class="bg-light py-3">
    <ol class="breadcrumb container">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Profile</li>
    </ol>
  </nav>

  <!-- Main Content -->
  <div class="container mt-5">
    <h1 class="text-center mb-4">User Profile</h1>
    <?php if (!empty($error_message)): ?>
      <div class="alert alert-danger" role="alert">
        <?php echo htmlspecialchars($error_message); ?>
      </div>
    <?php elseif (!empty($success_message)): ?>
      <div class="alert alert-success" role="alert">
        <?php echo htmlspecialchars($success_message); ?>
      </div>
    <?php endif; ?>
    <form method="POST" action="profile.php" class="needs-validation" novalidate>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name"
            value="<?php echo htmlspecialchars($user['name']); ?>" required>
          <div class="invalid-feedback">Please enter your name.</div>
        </div>
        <div class="col-md-6">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username"
            value="<?php echo htmlspecialchars($user['username']); ?>" required>
          <div class="invalid-feedback">Please enter your username.</div>
        </div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email"
          value="<?php echo htmlspecialchars($user['email']); ?>" required>
        <div class="invalid-feedback">Please enter a valid email address.</div>
      </div>
      <div class="mb-3">
        <label for="current_password" class="form-label">Current Password</label>
        <input type="password" class="form-control" id="current_password" name="current_password" required>
        <div class="invalid-feedback">Please enter your current password.</div>
      </div>
      <div class="mb-3">
        <label for="new_password" class="form-label">New Password</label>
        <input type="password" class="form-control" id="new_password" name="new_password">
        <div class="invalid-feedback">Please enter your new password.</div>
      </div>
      <div class="mb-3">
        <label for="confirm_password" class="form-label">Confirm New Password</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
        <div class="invalid-feedback">Please confirm your new password.</div>
      </div>
      <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
  </div>

  <!-- Footer -->
  <footer class="bg-light text-center text-lg-start mt-5">
    <div class="text-center p-3">
      &copy; 2024 Book Review Hub
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script>
    (function () {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
    })()
  </script>
</body>

</html>