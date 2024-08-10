<?php
require_once 'config/config.php';
require_once 'includes/auth.php';

redirect_if_not_logged_in();

$user_id = $_SESSION['user_id'];

// Fetch the user's reviews
$stmt = $pdo->prepare("SELECT r.*, b.title, b.image_url FROM reviews r JOIN books b ON r.book_id = b.id WHERE r.user_id = :user_id ORDER BY r.updated_at DESC");
$stmt->execute([':user_id' => $user_id]);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Reviews</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
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
      <li class="breadcrumb-item active" aria-current="page">My Reviews</li>
    </ol>
  </nav>

  <!-- Main Content -->
  <div class="container mt-5">
    <h1 class="text-center mb-4">My Reviews</h1>

    <?php if (count($reviews) > 0): ?>
      <div class="list-group">
        <?php foreach ($reviews as $review): ?>
          <div class="list-group-item list-group-item-action mb-3">
            <div class="row">
              <div class="col-md-2">
                <img src="<?php echo htmlspecialchars($review['image_url']); ?>"
                  alt="<?php echo htmlspecialchars($review['title']); ?>" class="img-fluid">
              </div>
              <div class="col-md-10">
                <h5><?php echo htmlspecialchars($review['title']); ?></h5>
                <p class="text-muted">Rating: <?php echo $review['rating']; ?> / 5</p>
                <p><?php echo htmlspecialchars($review['review']); ?></p>
                <div class="d-flex justify-content-end">
                  <a href="edit_review.php?book_id=<?php echo $review['book_id']; ?>&source=reviews"
                    class="btn btn-sm btn-primary me-2"><i class="fa fa-edit"></i> Edit</a>
                  <form action="delete_review.php" method="POST" class="d-inline">
                    <input type="hidden" name="book_id" value="<?php echo $review['book_id']; ?>">
                    <input type="hidden" name="source" value="reviews">
                    <button type="submit" class="btn btn-sm btn-danger"
                      onclick="return confirm('Are you sure you want to delete this review?');"><i class="fa fa-trash"></i>
                      Delete</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="alert alert-info" role="alert">
        You have not reviewed any books yet.
      </div>
    <?php endif; ?>
  </div>

  <!-- Footer -->
  <footer class="bg-light text-center text-lg-start mt-5">
    <div class="container p-3">
      <div class="row">
        <div class="col-md-6 mb-3 mb-md-0">
          <img src="images/logo.png" alt="Logo" class="img-fluid" style="max-height: 50px;">
          <span class="ms-2">&copy; 2024 Book Review Hub</span>
        </div>
        <div class="col-md-6 text-md-end">
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>