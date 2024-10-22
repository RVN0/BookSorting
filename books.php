<?php
require_once 'main/dbConfig.php';
require_once 'main/models.php';

$author_id = '';

$books = getbooksByauthor($pdo, null); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="delete.css">
</head>
<body>
<h1>Books</h1>
    
    <a href="index.php" class="back-button">Back to Authors</a>

    <form action="main/handleForms.php" method="POST">   
        <label for="authorId">Author ID:</label>
        <input type="number" name="author_id" value="<?= htmlspecialchars($author_id ?? '') ?>" required min="1">

        <label for="bookTitle">Book Title:</label>
        <input type="text" name="bookTitle" required>

        <label for="BookGenre">Book Genre:</label>
        <input type="text" name="BookGenre" required>

        <label for="isFinished">Is Finished:</label>
        <input type="checkbox" name="isFinished" value="1"> 

        <button type="submit" name="insertBookBtn">Insert Book</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Author ID</th>
                <th>Title</th>
                <th>Genre</th>
                <th>Status</th>
                <th>Date Added</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= htmlspecialchars($book['author_id']) ?></td>
                    <td><?= htmlspecialchars($book['bookTitle']) ?></td>
                    <td><?= htmlspecialchars($book['bookGenre']) ?></td>
                    <td><?= $book['isFinished'] ? 'Finished' : 'In Progress' ?></td>
                    <td><?= htmlspecialchars($book['DateAdded']) ?></td>
                    <td>
                        <a href="editinv.php?id=<?= $book['id'] ?>" class="button">Edit</a>
                        <a href="deleteinv.php?id=<?= $book['id'] ?>" class="button" onclick="return confirm('Are you sure you want to delete this book?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
