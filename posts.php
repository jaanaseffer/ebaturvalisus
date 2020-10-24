<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forum - XSS</title>
</head>
<body>
<h1>XSS</h1>
<form method="post">
    Author: <input type="text" name="author">
    <br>
    Content: <input type="text" name="content">
    <br>
    <button type="submit">Add post</button>

    <h2>Posts</h2>
</form>
</body>
</html>

<?php
$conn = new mysqli("localhost", "muusikapood", "muusikapood", "veebiturvalisus");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$author = $_POST['author'];
$content = $_POST['content'];

$sqlPosts = " SELECT * FROM posts ";
$sqlSubmit = "INSERT INTO posts (author, content) VALUES('".$author."', '".$content."');";

// Submit a post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postAdded = $conn->query($sqlSubmit);
    if (!$postAdded) {
        echo "Failed to add a post!";
    }

}

// Display all posts
$getPosts = $conn->query($sqlPosts);

if ($getPosts->num_rows > 0) {
    // output data of each row
    while($row = $getPosts->fetch_assoc()) {
        echo "
        <div style='margin-top: 30px; border:1px solid black';>
         Author: ".htmlentities($row['author'])."<br>
         Content: ".htmlentities($row['content'])."
        </div>";
    }
} else {
    echo "Couldn't find any posts!";
}

?>

<?php