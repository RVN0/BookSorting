<?php 
require_once 'main/models.php'; 
require_once 'main/handleForms.php'; 

$getProjectByID = getBooksByID($pdo, $_GET['id']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Edit the Book</h1>
    <form action="main/handleForms.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" method="POST">
    <p>
        <label for="authorId">Author ID</label> 
        <input type="number" name="author_id" id="authorId" 
               value="<?php echo htmlspecialchars($getProjectByID['author_id'] ?? ''); ?>" required>
    </p>
    <p>
        <label for="bookTitle">Book Title</label> 
        <input type="text" name="bookTitle" id="bookTitle" 
               value="<?php echo htmlspecialchars($getProjectByID['bookTitle'] ?? ''); ?>" required>
    </p>
    <p>
        <label for="bookGenre">Genre</label> 
        <input type="text" name="bookGenre" id="bookGenre" 
               value="<?php echo htmlspecialchars($getProjectByID['bookGenre'] ?? ''); ?>" required>
    </p>
    <p>
        <label for="isFinished">Is Finished</label> 
        <input type="checkbox" name="isFinished" value="1" 
               <?php echo isset($getProjectByID['isFinished']) && $getProjectByID['isFinished'] ? 'checked' : ''; ?>>
    </p>
    <p>
        <button type="submit" name="editBookBtn">Save Changes</button>
    </p>
</form>

</body>
</html>
