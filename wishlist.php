<?php
require_once 'config/config.php';
require_once 'includes/auth.php';

redirect_if_not_logged_in();

$user_id = $_SESSION['user_id'];

// Fetch wishlist books
$wishlist_query = "SELECT b.* FROM books b
                   JOIN wishlist w ON b.id = w.book_id
                   WHERE w.user_id = :user_id
                   ORDER BY b.created_at DESC";
$wishlist_stmt = $pdo->prepare($wishlist_query);
$wishlist_stmt->execute([':user_id' => $user_id]);
$wishlist_books = $wishlist_stmt->fetchAll(PDO::FETCH_ASSOC);

// Function to generate star ratings
function generateStars($rating)
{
  $fullStars = floor($rating);
  $halfStar = $rating - $fullStars >= 0.5;
  $emptyStars = 5 - $fullStars - $halfStar;

  $stars = str_repeat('<i class="fa fa-star"></i>', $fullStars);
  if ($halfStar) {
    $stars .= '<i class="fa fa-star-half-alt"></i>';
  }
  $stars .= str_repeat('<i class="fa fa-star-o"></i>', $emptyStars);

  return $stars;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wishlist</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/styles.css" />
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script>
    $(document).ready(function () {
      $('.wishlist-icon').click(function () {
        var bookId = $(this).data('book-id');
        var action = $(this).hasClass('in-wishlist') ? 'remove' : 'add';
        var button = $(this);

        $.ajax({
          url: 'toggle.php',
          type: 'POST',
          data: {
            book_id: bookId,
            action: action
          },
          success: function (response) {
            if (response.status === 'success') {
              button.toggleClass('in-wishlist');
              if (action === 'add') {
                button.html('<i class="fa fa-heart"></i> Remove from Wishlist');
              } else {
                button.html('<i class="fa fa-heart"></i> Add to Wishlist');
              }
            }
          }
        });
      });
    });
  </script>
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
      <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
    </ol>
  </nav>

  <!-- Main Content -->
  <div class="container mt-5">
    <h1 class="text-center mb-4">My Wishlist</h1>
    <div class="row">
      <?php if (count($wishlist_books) > 0): ?>
        <?php foreach ($wishlist_books as $book): ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
              <a href="book_details.php?book_id=<?php echo $book['id']; ?>" class="text-decoration-none">
                <img class="card-img-top" src="<?php echo htmlspecialchars($book['image_url']); ?>"
                  alt="<?php echo htmlspecialchars($book['title']); ?>">
              </a>
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?php echo htmlspecialchars($book['title']); ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($book['author']); ?></h6>
                <p class="card-text"><?php echo htmlspecialchars($book['description']); ?></p>
                <div class="mt-auto d-flex justify-content-between align-items-center">
                  <div class="rating">
                    <?php echo generateStars($book['average_rating']); ?>
                  </div>
                  <button class="btn btn-primary wishlist-icon in-wishlist" data-book-id="<?php echo $book['id']; ?>">
                    <i class="fa fa-heart"></i> Remove from Wishlist
                  </button>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="alert alert-info" role="alert">
          Your wishlist is empty.
        </div>
      <?php endif; ?>
    </div>
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