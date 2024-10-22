<?php require_once 'main/dbConfig.php'; ?>
<?php require_once 'main/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Book Confirmation</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="delete.css">
</head>
<body>
	<?php 
	// Check if 'id' is set in the query parameters
	if (isset($_GET['id'])) {
	    // Sanitize the input
	    $bookId = intval($_GET['id']); // Ensure it's an integer
	    $getBookByID = getBooksByID($pdo, $bookId);
	} else {
	    // Handle the error case where no ID is provided
	    echo "No book ID specified.";
	    exit;
	}
	?>
	<h1>Are you sure you want to delete this book?</h1>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>Author ID: <?php echo htmlspecialchars($getBookByID['author_id']); ?></h2>
		<h2>Book Title: <?php echo htmlspecialchars($getBookByID['bookTitle']); ?></h2>
		<h2>Genre: <?php echo htmlspecialchars($getBookByID['bookGenre']); ?></h2>
		<h2>Status: <?php echo htmlspecialchars($getBookByID['isFinished'] ? 'Finished' : 'In Progress'); ?></h2>
		<h2>Date Added: <?php echo htmlspecialchars($getBookByID['DateAdded']); ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="main/handleForms.php?id=<?php echo $bookId; ?>" method="POST">
				<input type="submit" name="deleteBookBtn" value="Delete">
			</form>			
		</div>	
	</div>
</body>
</html>
