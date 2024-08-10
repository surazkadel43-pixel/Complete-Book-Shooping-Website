<?php
require_once 'config/config.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';

redirect_if_logged_in();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = sanitize_input($_POST['email']);
  $password = sanitize_input($_POST['password']);
  $errors = [];

  if (empty($email) || empty($password)) {
    $errors[] = "Both fields are required.";
  } else {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      header("Location: index.php");
      exit();
    } else {
      $errors[] = "Invalid email or password.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="text-center">
          <img src="images/logo.png" alt="Logo" class="img-fluid" style="max-width: 100%; height: auto;">
        </div>
        <h2 class="text-center">Login</h2>
        <?php if (!empty($errors)): ?>
          <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
              <p><?php echo $error; ?></p>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
        <form action="login.php" method="POST">
          <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
          </div>
          <div class="form-group mb-4">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <div class="mt-3 text-center">
          <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>