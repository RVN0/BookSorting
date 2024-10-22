<?php

require_once 'dbConfig.php'; 
require_once 'models.php';

if (isset($_POST['insertauthorBtn'])) {

	$query = insertauthor($pdo, $_POST['firstName'], $_POST['lastName'], 
		$_POST['DateAdded']);

	if ($query) {
		header("Location: ../authors.php");
	}
	else {
		echo "Insertion failed";
	}

}

if (isset($_POST['editauthorBtn'])) {
    $id = $_GET['id'] ?? null;

    if ($id) {
        if (updateauthor($pdo, $_POST['firstName'], $_POST['lastName'], $id)) {
            header("Location: ../authors.php");
            exit();
        } else {
            echo "Edit failed";
        }
    } else {
        echo "Error: No author ID specified.";
    }
}

if (isset($_POST['deleteauthorBtn'])) {
	$query = deleteauthor($pdo, $_GET['id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Deletion failed";
	}
}

if (isset($_POST['insertBookBtn'])) {
   
    $author_id = $_POST['author_id'];
    $bookTitle = $_POST['bookTitle'];
    $bookGenre = $_POST['BookGenre']; 
    $isFinished = isset($_POST['isFinished']) ? 1 : 0;

    
    $query = insertbook($pdo, $author_id, $bookTitle, $bookGenre, null, $isFinished); 

    if ($query) {
        header("Location: ../books.php?id=" . $_POST['id']);
        exit;
    } else {
        echo "Insertion failed";
    }
}

if (isset($_POST['editBookBtn'])) {
    $author_id = $_POST['author_id'];
    $bookTitle = $_POST['bookTitle'];
    $bookGenre = $_POST['bookGenre'];
    $isFinished = isset($_POST['isFinished']) ? 1 : 0;

    $query = updatebook($pdo, $author_id, $bookTitle, $bookGenre, $isFinished, $_GET['id']);

    if ($query) {
        header("Location: ../books.php?id=" . $_GET['id']);
        exit;
    } else {
        echo "Update failed";
    }
}



if (isset($_POST['deleteBookBtn'])) {
	$query = deletebook($pdo, $_GET['id']);

	if ($query) {
		header("Location: ../books.php");
	}
	else {
		echo "Deletion failed";
	}
}



?>