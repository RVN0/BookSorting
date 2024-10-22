<?php

function insertauthor($pdo, $firstName, $lastName, $DateAdded) {

	$sql = "INSERT INTO author (firstName, lastName, 
		DateAdded) VALUES(?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$firstName, $lastName, $DateAdded]);

	if ($executeQuery) {
		return true;
	}
}

function updateauthor($pdo, $firstName, $lastName, $id) {

	$sql = "UPDATE author
				SET firstName = ?,
					lastName = ?,
					DateAdded = CURRENT_TIMESTAMP
				WHERE id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$firstName, $lastName, $id]);
	
	if ($executeQuery) {
		return true;
	}

}

function deleteauthor($pdo, $id) {
    $deleteauthor = "DELETE FROM author WHERE id = ?";
    $deleteStmt = $pdo->prepare($deleteauthor);
    $executeDeleteQuery = $deleteStmt->execute([$id]);

    return $executeDeleteQuery;
}


function getAllauthor($pdo) {
	$sql = "SELECT * FROM author";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getauthorByID($pdo, $id) {
	$sql = "SELECT * FROM author WHERE id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function getbooksByauthor($pdo, $author_id = null) {
    $sql = "SELECT * FROM books";
    $params = [];
    
    if ($author_id !== null) {
        $sql .= " WHERE author_id = ?";
        $params[] = $author_id;
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insertbook($pdo, $author_id, $bookTitle, $bookGenre, $dateAdded, $isFinished) {
    $sql = "INSERT INTO books (author_id, bookTitle, bookGenre, isFinished, DateAdded) VALUES (?, ?, ?, ?, NOW())";
	
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$author_id, $bookTitle, $bookGenre, $isFinished]);
}



function getBooksByID($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
}

function updatebook($pdo, $author_id, $bookTitle, $bookGenre, $isFinished, $id) {
    $sql = "UPDATE books
            SET author_id = ?,
                bookTitle = ?,
                bookGenre = ?,
                isFinished = ?
            WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$author_id, $bookTitle, $bookGenre, $isFinished, $id]);
}


function deletebook($pdo, $id) {
	$sql = "DELETE FROM books WHERE id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$id]);
	if ($executeQuery) {
		return true;
	}
}

function getAuthorsWithBooks($pdo) {
    $sql = "
        SELECT a.id, a.firstName, a.lastName, b.bookTitle
        FROM author a
        LEFT JOIN books b ON a.id = b.author_id
        ORDER BY a.id
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $authors = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $authors[$row['id']]['id'] = $row['id'];
        $authors[$row['id']]['firstName'] = $row['firstName'];
        $authors[$row['id']]['lastName'] = $row['lastName'];
        $authors[$row['id']]['books'][] = [
            'bookTitle' => $row['bookTitle']
        ];
    }

    return array_values($authors);
}

?>