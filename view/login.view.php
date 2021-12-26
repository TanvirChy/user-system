<!-- <link rel="stylesheet" href="styles.css"> -->
<?php
require_once './partials/header.php';
require_once '../model/database.php';

$db = new DatabaseConnection();
// $Dbconnection = $db->connection();
if (isset($_POST) && !empty($_POST['name']) && !empty($_POST['email'])  && !empty($_POST['password'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // $sql = $Dbconnection->prepare("SELECT * FROM users where name = :name");
    // $sql->execute([':name' => $name]);
    // $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    $results = $db->fetchSingleItem('users', $name, $email);
    var_dump($results);
    $passwordFromDatabase = $results[0]["password"];
    var_dump($passwordFromDatabase);

    if($password === $passwordFromDatabase){
        $_SESSION['users']= $results;
        header("Location: wellcome.view.php");
    }
}

?>

<div class="loginForm">
    <h2>Hello allian please , please Login first to browse this plateform.
    </h2>

    <form method="POST" class="loginForm">
        <label class="inputLabel" for="name">User Name :</label>
        <input class="inputField" type="text" name="name">
        <label class="inputLabel" for="email">Email :</label>
        <input class="inputField" type="text" name="email">
        <label class="inputLabel" for="password">Password :</label>
        <input class="inputField" type="password" name="password">
        <button class='button' type="submit">LOGIN</button>
    </form>
</div>
</body>

</html>