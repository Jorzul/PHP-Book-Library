<?php
    include "config.php";

    $genre = $_GET['Genre'];

    if ($genre != null) {

        $sql = "SELECT * FROM book WHERE Genre='$genre'";
        $result = $conn->query($sql);
    }
    else {
        $sql = "SELECT * FROM book";
        $result = $conn->query($sql);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> View Books </title>
        <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <style>
            .btn-success {
                margin: 2vh;
                width: 50px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <a class="btn btn-success" href="create.php"> Add </a>
        </div>
        <div class="container">
            <h2>Books</h2>

            <table class="table">
                <head>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Pages</th>
                        <th>Genre</th>
                        <th>Update</th>
                    </tr>
                    <tbody>
                        <?php
                            if($result->num_rows>0) {
                                while($row = $result->fetch_assoc()) {
                        ?>

                        <tr>
                            <td><?php echo $row['id']; ?> </td>
                            <td><?php echo $row['Title']; ?> </td>
                            <td><?php echo $row['Author']; ?> </td>
                            <td><?php echo $row['Pages']; ?> </td>
                            <td><?php echo $row['Genre']; ?> </td>
                            <td><a class="btn btn-info" href="update.php?id=<?php echo $row['id']; ?>"> Edit </a> &nbsp;
                            <a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');"> Delete </a> </td>
                        </tr>
                        
                        <?php   }
                            }
                        ?>
                    </tbody>
                </head>
            </table>
        </div>
    </body>
</html>