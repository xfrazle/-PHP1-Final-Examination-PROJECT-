<?php
session_start();
include("./connection.php");
include("./functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    //posted
    $user_name = $_POST['user_name'];
    $password = $_POST['user_name'];

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name)){
        // read to db
        $user_id = random_num(20);
        $query = "select * from users where user_name = '$user_name' limit 1";

        $result = mysqli_query($con, $query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);

                if($user_data['password'] === $password){

                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;
                }
            }
        }
        
        echo "incorrect username or password";
    } else {
        echo "Please enter valid information";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Universal Game Planner</title>
</head>
<body>
    <a href="">Login</a>

    <br>
    <h1>Login Page</h1>

    <div id=login>
        <form action="" method="post">
            <input type="text" name="user_name">
            <input type="password" name="password">

            <input type="submit" value="Login">

            <a href="./signup.php">Signup</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>