<?php require_once 'main/models.php'; ?>
<?php require_once 'main/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="delete.css">
</head>
<body>
	<h1>Are you sure you want to delete this user?</h1>
	<?php $getauthorByID = getauthorByID($pdo, $_GET['id']); ?>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>FirstName: <?php echo $getauthorByID['firstName']; ?></h2>
		<h2>LastName: <?php echo $getauthorByID['lastName']; ?></h2>
		<h2>Date Added: <?php echo $getauthorByID['DateAdded']; ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="main/handleForms.php?id=<?php echo $_GET['id']; ?>" method="POST">
				<input type="submit" name="deleteauthorBtn" value="Delete">
			</form>			
		</div>	

	</div>
</body>
</html>