<?php
require_once 'config/config.php';
require_once 'includes/auth.php';

redirect_if_not_logged_in();

$book_id = $_GET['book_id'];
$user_id = $_SESSION['user_id'];

// Fetch book details
$stmt = $pdo->prepare("SELECT * FROM books WHERE id = :book_id");
$stmt->execute([':book_id' => $book_id]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch reviews
$stmt = $pdo->prepare("SELECT r.*, u.username FROM reviews r JOIN users u ON r.user_id = u.id WHERE r.book_id = :book_id");
$stmt->execute([':book_id' => $book_id]);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch user's review
$stmt = $pdo->prepare("SELECT * FROM reviews WHERE book_id = :book_id AND user_id = :user_id");
$stmt->execute([
  ':book_id' => $book_id,
  ':user_id' => $user_id
]);
$user_review = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Details</title>
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
      <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($book['title']); ?></li>
    </ol>
  </nav>

  <!-- Main Content -->
  <div class="container mt-5">
    <h1 class="text-center mb-4"><?php echo htmlspecialchars($book['title']); ?></h1>
    <div class="row">
      <div class="col-md-4">
        <img src="<?php echo htmlspecialchars($book['image_url']); ?>"
          alt="<?php echo htmlspecialchars($book['title']); ?>" class="img-fluid">
      </div>
      <div class="col-md-8">
        <h4>Author: <?php echo htmlspecialchars($book['author']); ?></h4>
        <h5>ISBN: <?php echo htmlspecialchars($book['isbn']); ?></h5>
        <h5>Published Date: <?php echo htmlspecialchars($book['published_date']); ?></h5>
        <p><?php echo nl2br(htmlspecialchars($book['description'])); ?></p>
        <h5>Average Rating: <?php echo number_format($book['average_rating'], 2); ?> / 5</h5>
      </div>
    </div>

    <hr>

    <h3 class="mt-5">Reviews</h3>
    <?php if (count($reviews) > 0): ?>
      <?php foreach ($reviews as $review): ?>
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($review['username']); ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo $review['rating']; ?> / 5</h6>
            <p class="card-text"><?php echo nl2br(htmlspecialchars($review['review'])); ?></p>
            <?php if ($review['user_id'] == $user_id): ?>
              <div class="text-end">
                <a href="edit_review.php?book_id=<?php echo $book_id; ?>&source=book_details"
                  class="btn btn-warning btn-sm">Edit</a>
                <form action="delete_review.php" method="POST" class="d-inline">
                  <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
                  <input type="hidden" name="source" value="book_details">
                  <button type="submit" class="btn btn-sm btn-danger"
                    onclick="return confirm('Are you sure you want to delete this review?');"><i class="fa fa-trash"></i>
                    Delete</button>
                </form>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="alert alert-info" role="alert">
        There are no reviews for this book yet. Be the first to review!
      </div>
    <?php endif; ?>

    <?php if (!$user_review): ?>
      <hr>

      <h3 class="mt-5">Add Your Review</h3>
      <form action="add_review.php" method="POST">
        <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
        <div class="mb-3">
          <label for="rating" class="form-label">Rating</label>
          <select class="form-select" id="rating" name="rating" required>
            <option value="">Select Rating</option>
            <?php for ($i = 1; $i <= 5; $i++): ?>
              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="review" class="form-label">Review</label>
          <textarea class="form-control" id="review" name="review" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Review</button>
      </form>
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