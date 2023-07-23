<?php
    $is_invalid = false;
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
        $mysqli = require("database.php");

        $sql = sprintf("SELECT * FROM user WHERE email = '%s'", $mysqli->real_escape_string($_POST["email"]));

        $result = $mysqli->query($sql);
        $user = $result->fetch_assoc();
        if($user){
            if(password_verify($_POST["password"], $user["password"])){
                session_start();
                $_SESSION["user_id"] = $user["id"];
                header("Location: books.php");
            } else {
                die("Wrong password");
            }
        }
        $is_invalid = true;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        div {
            margin-bottom: 10px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Login</h1>
    <?php if ($is_invalid): ?>
        <p1 style="width: auto;" >invalid login</p1>
    <?php endif; ?>
    <form action="signin.php" method="POST">
        <div>
            <label for="email">Email</label>
            <input type="text" id="email" name="email">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <input type="submit" value="Login">
        </div>
    </form>
</body>
</html>
