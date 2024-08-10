<?php
require_once 'config/config.php';
require_once 'includes/auth.php';

redirect_if_not_logged_in();

$user_id = $_SESSION['user_id'];
$book_id = $_POST['book_id'];
$rating = $_POST['rating'];
$review = $_POST['review'];
$source = $_POST['source'];

if ($rating < 1 || $rating > 5) {
  die('Invalid rating value.');
}

$stmt = $pdo->prepare("UPDATE reviews SET rating = :rating, review = :review, updated_at = CURRENT_TIMESTAMP 
                       WHERE book_id = :book_id AND user_id = :user_id");
$stmt->execute([
  ':rating' => $rating,
  ':review' => $review,
  ':book_id' => $book_id,
  ':user_id' => $user_id
]);

// Update the book's overall rating
$stmt = $pdo->prepare("UPDATE books SET average_rating = (SELECT AVG(rating) FROM reviews WHERE book_id = :book_id_avg) WHERE id = :book_id_set");
$stmt->execute([':book_id_avg' => $book_id, ':book_id_set' => $book_id]);

if ($source == 'book_details') {
  header('Location: book_details.php?book_id=' . $book_id);
} else {
  header('Location: reviews.php');
}
exit;