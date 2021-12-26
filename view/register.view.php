<?php
require_once './partials/header.php';
require_once '../model/database.php';
$db = new DatabaseConnection();

$dbConnection = $db->connection();

if (isset($_POST) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $user_id = uniqid();
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = $dbConnection->prepare("INSERT INTO users(user_id, name, email, password)
                                VALUES (:user_id, :name, :email, :password);");

        $value = [
            'user_id' => $user_id,
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];
        $result = $sql->execute($value);
        if ($result) {
            header("Location: login.view.php");
        }
    } else {
        echo 'hi';
    }
}

?>

<h1 class="registerText">Hello allian please , please Registration first for member our family.
</h1>
<form method="POST" class="registerForm">
    <label class="inputLabel" for="name">User Name :</label>
    <input class="inputField" type="text" name="name">
    <label class="inputLabel" for="email">Email :</label>
    <input class="inputField" type="text" name="email">
    <label class="inputLabel" for="password">Password :</label>
    <input class="inputField" type="password" name="password">
    <button class='button' type="submit">Registration</button>
</form>
</body>

</html>