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

    if (isset($_POST["submit"])) {
        $title = $_POST["title"];
        $author = $_POST["author"];
        $pages = $_POST["pages"];
        $genre = $_POST["genre"];

        $sql = "INSERT INTO book(Title, Author, Pages, Genre) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssis", $title, $author, $pages, $genre);

        if ($stmt->execute()) {
            ?>
            <h4 class="text-center"> <?php echo "New record created succesfully!" ?> </h4>;
            <?php 
            //header('Location: filter_ajax.html');

        }
        else {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript">
            function validateForm() {
                var a = document.forms["Form"]["title"].value;
                var b = document.forms["Form"]["author"].value;
                var c = document.forms["Form"]["pages"].value;
                var d = document.forms["Form"]["genre"].value;
                if ((a == null || a == "") || (b == null || b == "") || (c == null || c == "") || (d == null || d == "")) {
                    alert("Please Fill In All Required Fields");
                    return false;
                    }
                }
        </script>
        <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    </head>

    <body>
        <h2 class="text-center"> Create Book </h2>

        <form action="" method="post" class="text-center" name="Form" onsubmit="return validateForm()">
                Title:<br>
                <input type="text" name="title">
                <br>

                Author:<br>
                <input type="text" name="author">
                <br>

                Number of pages:<br>
                <input type="number" name="pages">
                <br>

                Genre:<br>
                <input type="text" name="genre">
                <br><br>

                <input type="submit" name="submit">
        </form>
        <p class="text-center" style="margin-top: 10px;">
            <a class="btn btn-default" href="filter_ajax.html"> Back </a>
        </p>
    </body>
</html>