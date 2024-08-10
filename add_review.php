<?php
require_once 'config/config.php';
require_once 'includes/auth.php';

redirect_if_not_logged_in();

$user_id = $_SESSION['user_id'];
$book_id = $_POST['book_id'];
$rating = $_POST['rating'];
$review = $_POST['review'];

if ($rating < 1 || $rating > 5) {
  die('Invalid rating value.');
}

$stmt = $pdo->prepare("INSERT INTO reviews (book_id, user_id, rating, review) 
                       VALUES (:book_id, :user_id, :rating, :review)
                       ON DUPLICATE KEY UPDATE rating = VALUES(rating), review = VALUES(review), updated_at = CURRENT_TIMESTAMP");
$stmt->execute([
  ':book_id' => $book_id,
  ':user_id' => $user_id,
  ':rating' => $rating,
  ':review' => $review
]);

// Update the book's overall rating
$stmt = $pdo->prepare("UPDATE books SET average_rating = (SELECT AVG(rating) FROM reviews WHERE book_id = :book_id_avg) WHERE id = :book_id_set");
$stmt->execute([':book_id_avg' => $book_id, ':book_id_set' => $book_id]);

header('Location: book_details.php?book_id=' . $book_id);