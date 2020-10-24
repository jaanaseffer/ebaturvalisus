<?php
$conn = new mysqli("localhost", "muusikapood", "muusikapood", "veebiturvalisus");

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$username = $_POST['user'];
$password = $_POST['pass'];

// To prevent SQL injection
$username = addslashes($username);
$password = addslashes($password);

$sql = " SELECT * FROM users where username = '$username' AND password = '$password'";
echo $sql . '<br>';

$result = $conn->query($sql);
if ($result->num_rows > 0) {

while ($row = $result->fetch_assoc()) {
$output = "Logged in as: id: " . $row["user_id"] . " / Name: " . $row["username"] . " / Password: " . $row["password"] . "<br>";
}
} else {
$output = "Username or password is invalid!";
}
?>

<h1>Login</h1>
<form action="" method="POST">
    <label for="user">Username:</label><input type="text" name="user" id="user"><br>
    <label for="pass">Password:</label><input type="text" name="pass" id="pass"><br>
    <input type="submit" value="Login">
    <div style="margin-top: 20px;"><?php echo $output ?></div>
</form>