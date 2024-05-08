<?php
    include "config.php";

    if (isset($_GET['id'])) {
        $book_id = $_GET['id'];
    }

    $sql = "DELETE FROM book WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);

    if ($stmt->execute()) {
        header('Location: filter_ajax.html');
    }
    else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
?>