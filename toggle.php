<?php
require_once 'config/config.php';
require_once 'includes/auth.php';

redirect_if_not_logged_in();

header('Content-Type: application/json');

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $book_id = isset($_POST['book_id']) ? (int) $_POST['book_id'] : 0;
  $action = isset($_POST['action']) ? $_POST['action'] : '';

  if ($book_id <= 0 || !in_array($action, ['add', 'remove'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
    exit();
  }

  if ($action === 'add') {
    $stmt = $pdo->prepare("INSERT INTO wishlist (user_id, book_id) VALUES (:user_id, :book_id)");
    if ($stmt->execute([':user_id' => $user_id, ':book_id' => $book_id])) {
      echo json_encode(['status' => 'success', 'message' => 'Book added to wishlist']);
    } else {
      echo json_encode(['status' => 'error', 'message' => 'Failed to add book to wishlist']);
    }
  } elseif ($action === 'remove') {
    $stmt = $pdo->prepare("DELETE FROM wishlist WHERE user_id = :user_id AND book_id = :book_id");
    if ($stmt->execute([':user_id' => $user_id, ':book_id' => $book_id])) {
      echo json_encode(['status' => 'success', 'message' => 'Book removed from wishlist']);
    } else {
      echo json_encode(['status' => 'error', 'message' => 'Failed to remove book from wishlist']);
    }
  }
} else {
  echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}