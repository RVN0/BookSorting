<?php 
require_once 'main/handleForms.php'; 
require_once 'main/models.php'; 

$getAuthorByID = getauthorByID($pdo, $_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Author</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Edit the Author</h1>
    <form action="main/handleForms.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" method="POST">
        <p>
            <label for="firstName">First Name</label> 
            <input type="text" name="firstName" id="firstName" value="<?php echo htmlspecialchars($getAuthorByID['firstName']); ?>" required>
        </p>
        <p>
            <label for="lastName">Last Name</label> 
            <input type="text" name="lastName" id="lastName" value="<?php echo htmlspecialchars($getAuthorByID['lastName']); ?>" required>
        </p>
        <p>
            <button type="submit" name="editauthorBtn">Save Changes</button>
        </p>
    </form>
</body>
</html>
