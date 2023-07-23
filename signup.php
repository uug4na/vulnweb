<?php
    if(empty($_POST["name"])){
        die("Name is required");
    }
    if( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        die("Enter right E-mail");
    }
    if(strlen($_POST["password"]) < 8){
        die("Password length should be at least 6 characters");
    }

    $_passHash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    require("database.php");

    $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
    $stmt = $mysqli->stmt_init();

    if( ! $stmt->prepare($sql)){
        die("SQL ERROR: " . $mysqli->errno);
    }

    if ($stmt->bind_param("sss", $_POST["name"], $_POST["email"], $_passHash))
    try {
        if ($stmt->execute()) {
            header("Location: books.php");
            exit;
        } else {
            echo "Some error occurred during execution.";
        }
    } catch (mysqli_sql_exception $e) {
        echo "Email already taken";
    }
?>