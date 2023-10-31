<?php
session_start();

$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";

$loginSuccessful = false;

$fp = fopen("./data/users.txt", "r");

$roles = array();
$emails = array();
$firstnames = array();
$lastnames = array();
$passwords = array();

while ($line = fgets($fp)) {
    $values = explode(",", $line);

    array_push($roles, trim($values[0]));
    array_push($emails, trim($values[1]));
    array_push($firstnames, trim($values[2]));
    array_push($lastnames, trim($values[3]));
    array_push($passwords, trim($values[4]));
}

fclose($fp);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    for ($i = 0; $i < count($roles); $i++) {
        if ($email == $emails[$i] && $password == $passwords[$i]) {
            $_SESSION["role"] = $roles[$i];
            $_SESSION["email"] = $emails[$i];
            $_SESSION["firstname"] = $firstnames[$i];
            $_SESSION["lastname"] = $lastnames[$i];
            $loginSuccessful = true;
            break;
        }
    }

    if (!$loginSuccessful) {
        echo '<script>
        alert("Wrong email or password");
        window.location.href = "index.php";
        </script>
        ';
    } else {
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center">Login to your account</h1>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter email" required>

            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                    placeholder="******" required>
            </div>

            <br>
            <button type="submit" class="btn btn-primary" values="login">Login</button>
        </form>
       
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
</body>

</html>