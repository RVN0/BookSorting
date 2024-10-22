<?php 
require_once 'main/dbConfig.php'; 
require_once 'main/models.php'; 

// Fetch authors and their books
$authorsWithBooks = getAuthorsWithBooks($pdo); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authors and Books</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Authors and Their Books</h1>

    <table>
        <thead>
            <tr>
                <th>Author ID</th>
                <th>Author Name</th>
                <th>Books</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($authorsWithBooks as $author): ?>
                <tr>
                    <td><?= htmlspecialchars($author['id']) ?></td>
                    <td><?= htmlspecialchars($author['firstName'] . ' ' . $author['lastName']) ?></td>
                    <td>
                        <?php 
                        // Join the book titles for this author
                        $books = array_filter($author['books'], function($book) {
                            return !empty($book['bookTitle']);
                        });
                        $bookTitles = array_map(function($book) {
                            return htmlspecialchars($book['bookTitle']);
                        }, $books);
                        echo implode(', ', $bookTitles); 
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php">Back to Home</a>
</body>
</html>
