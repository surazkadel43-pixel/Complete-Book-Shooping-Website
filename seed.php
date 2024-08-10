<?php
require_once 'config/config.php';

// Function to generate random dates
function randomDate($start_date, $end_date)
{
  $start_timestamp = strtotime($start_date);
  $end_timestamp = strtotime($end_date);
  $random_timestamp = mt_rand($start_timestamp, $end_timestamp);
  return date('Y-m-d', $random_timestamp);
}

// Function to generate random ISBN numbers
function randomISBN()
{
  return mt_rand(1000000000000, 9999999999999);
}

// Function to hash passwords
function hashPassword($password)
{
  return password_hash($password, PASSWORD_BCRYPT);
}

// Categories array
$categories = [
  'Fiction',
  'Non-Fiction',
  'Science',
  'Math',
  'History',
  'Biography',
  'Fantasy',
  'Adventure',
  'Romance',
  'Mystery',
  'Horror',
  'Thriller',
  'Science Fiction',
  'Poetry',
  'Drama',
  'Self-Help',
  'Health',
  'Travel',
  'Children\'s',
  'Religion',
  'Spirituality',
  'Humor',
  'Business',
  'Education',
  'Cooking',
  'Art',
  'Music',
  'Sports',
  'Politics',
  'Technology'
];

// Inserting categories into the database
foreach ($categories as $category) {
  $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
  $stmt->execute([':name' => $category]);
}

// Generating random books
for ($i = 1; $i <= 30; $i++) {
  $title = 'Book Title ' . $i;
  $author = 'Author ' . $i;
  $description = 'This is a description for book ' . $i;
  $image_url = 'https://via.placeholder.com/200x300?text=Book+' . $i;
  $published_date = randomDate('2000-01-01', '2023-12-31');
  $isbn = randomISBN();

  $stmt = $pdo->prepare("INSERT INTO books (title, author, description, image_url, published_date, isbn) VALUES (:title, :author, :description, :image_url, :published_date, :isbn)");
  $stmt->execute([
    ':title' => $title,
    ':author' => $author,
    ':description' => $description,
    ':image_url' => $image_url,
    ':published_date' => $published_date,
    ':isbn' => $isbn
  ]);
}

// Fetching all book and category IDs
$book_ids = $pdo->query("SELECT id FROM books")->fetchAll(PDO::FETCH_COLUMN);
$category_ids = $pdo->query("SELECT id FROM categories")->fetchAll(PDO::FETCH_COLUMN);

// Associating books with random categories
foreach ($book_ids as $book_id) {
  // Each book will be assigned between 1 and 3 categories
  $assigned_categories = array_rand($category_ids, mt_rand(1, 3));
  if (!is_array($assigned_categories)) {
    $assigned_categories = [$assigned_categories];
  }
  foreach ($assigned_categories as $category_index) {
    $category_id = $category_ids[$category_index];
    $stmt = $pdo->prepare("INSERT INTO book_category (book_id, category_id) VALUES (:book_id, :category_id)");
    $stmt->execute([
      ':book_id' => $book_id,
      ':category_id' => $category_id
    ]);
  }
}

// Generating random users
$users = [
  ['name' => 'John Doe', 'username' => 'johndoe', 'email' => 'johndoe@example.com', 'password' => 'password123'],
  ['name' => 'Jane Smith', 'username' => 'janesmith', 'email' => 'janesmith@example.com', 'password' => 'password123'],
  ['name' => 'Alice Johnson', 'username' => 'alicejohnson', 'email' => 'alicejohnson@example.com', 'password' => 'password123'],
  ['name' => 'Bob Brown', 'username' => 'bobbrown', 'email' => 'bobbrown@example.com', 'password' => 'password123']
];

foreach ($users as $user) {
  $stmt = $pdo->prepare("INSERT INTO users (name, username, email, password) VALUES (:name, :username, :email, :password)");
  $stmt->execute([
    ':name' => $user['name'],
    ':username' => $user['username'],
    ':email' => $user['email'],
    ':password' => hashPassword($user['password'])
  ]);
}

// Fetching all user IDs
$user_ids = $pdo->query("SELECT id FROM users")->fetchAll(PDO::FETCH_COLUMN);

// Generating random reviews
foreach ($book_ids as $book_id) {
  // Each book will have between 0 and 5 reviews
  $num_reviews = mt_rand(1, 4);
  $reviewed_users = array_rand($user_ids, $num_reviews);
  if (!is_array($reviewed_users)) {
    $reviewed_users = [$reviewed_users];
  }
  foreach ($reviewed_users as $user_index) {
    $user_id = $user_ids[$user_index];
    $rating = mt_rand(1, 5);
    $review = 'This is a review for book ' . $book_id . ' by user ' . $user_id;

    $stmt = $pdo->prepare("INSERT INTO reviews (book_id, user_id, rating, review) VALUES (:book_id, :user_id, :rating, :review)");
    $stmt->execute([
      ':book_id' => $book_id,
      ':user_id' => $user_id,
      ':rating' => $rating,
      ':review' => $review
    ]);

    // Update the book's average rating
    $stmt = $pdo->prepare("UPDATE books SET average_rating = (SELECT AVG(rating) FROM reviews WHERE book_id = :book_id_avg) WHERE id = :book_id_set");
    $stmt->execute([':book_id_avg' => $book_id, ':book_id_set' => $book_id]);
  }
}

echo "Database seeded successfully!";