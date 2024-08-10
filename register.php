<?php
require_once 'config/config.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';

redirect_if_logged_in();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = sanitize_input($_POST['name']);
  $username = sanitize_input($_POST['username']);
  $email = sanitize_input($_POST['email']);
  $password = sanitize_input($_POST['password']);
  $confirm_password = sanitize_input($_POST['confirm_password']);
  $errors = [];

  if (empty($name) || empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
    $errors[] = "All fields are required.";
  } elseif ($password !== $confirm_password) {
    $errors[] = "Passwords do not match.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
  } else {
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
    $stmt->execute([$email, $username]);
    if ($stmt->fetch()) {
      $errors[] = "Email or Username is already taken.";
    } else {
      $hashed_password = password_hash($password, PASSWORD_BCRYPT);
      $stmt = $pdo->prepare("INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)");
      if ($stmt->execute([$name, $username, $email, $hashed_password])) {
        header("Location: login.php");
        exit();
      } else {
        $errors[] = "An error occurred during registration.";
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
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="text-center mb-4">
          <img src="images/logo.png" alt="Logo" class="img-fluid" style="max-width: 100%; height: auto;">
        </div>
        <h2 class="text-center">Register</h2>
        <?php if (!empty($errors)): ?>
          <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
              <p><?php echo $error; ?></p>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
        <form action="register.php" method="POST">
          <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
          </div>
          <div class="form-group mb-3">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" required>
          </div>
          <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
          </div>
          <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
          </div>
          <div class="form-group mb-4">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
        <div class="mt-3 text-center">
          <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>