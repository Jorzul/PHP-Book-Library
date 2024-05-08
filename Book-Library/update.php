<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "books_db";

	// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['update'])) {
        $book_id = $_POST['book_id'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $pages = $_POST['pages'];
        $genre = $_POST['genre'];

        $sql = "UPDATE book SET Title=?, Author=?, Pages=?, Genre=? WHERE id='$book_id'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssis", $title, $author, $pages, $genre);

        if ($stmt->execute()) {
            ?>
                <h4 class="text-center"> <?php echo "New record created succesfully!" ?> </h4>;
            <?php
        }
        else {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    }

    if (isset($_GET['id'])) {
        $book_id = $_GET['id'];

        $sql = "SELECT * FROM book WHERE id='$book_id'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $title = $row['Title'];
                $author = $row['Author'];
                $pages = $row['Pages'];
                $genre = $row['Genre'];
                $book_id = $row['id'];
            }
        ?>
        <head>
            <link rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        </head>
        
        <h2 class="text-center"> Update Book </h2>
        <form action="" method="POST" class="text-center">
                Title:<br>
                <input type="text" name="title" value="<?php echo $title; ?>">
                <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
                <br>

                Author:<br>
                <input type="text" name="author" value="<?php echo $author; ?>">
                <br>

                Number of pages:<br>
                <input type="text" name="pages" value="<?php echo $pages; ?>">
                <br>

                Genre:<br>
                <input type="text" name="genre" value="<?php echo $genre; ?>">
                <br><br>

                <input type="submit" name="update" value="update">
        </form>
        <p class="text-center" style="margin-top: 10px;">
            <a class="btn btn-default" href="filter_ajax.html"> Back </a>
        </p>
    </body>
    </html>

    <?php
        } else {
            // If the 'id' value is not valid, then we redirect the user back to view.php
            echo "No id";
        }
    }
    ?>