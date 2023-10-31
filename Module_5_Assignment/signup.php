<?php
session_start();
$firstname = $_POST["firstname"] ?? "";
$lastname = $_POST["lastname"] ?? "";
$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";

$role = "user";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lines = file("./data/users.txt");
    $emailExists = false;

    foreach ($lines as $line) {
        $values = explode(",", $line);

        if (count($values) >= 2) {
            $existingEmail = trim($values[1]);

            if ($email == $existingEmail) {
                $emailExists = true;
                break;
            }
        }
    }

    if ($emailExists) {
        echo '<script>
        alert("Email already exists. Please choose a different email.");
        window.location.href = "signup.php";
        </script>
        ';
    } elseif ($email != "" && $password != "") {
        $fp = fopen("./data/users.txt", "a");

        fwrite($fp, "\n{$role}, {$email}, {$firstname}, {$lastname}, {$password}");
        fclose($fp);
        header("Location: login.php");
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
        <h1 class="text-center">Create a new account</h1>

        <form action="signup.php" method="POST">

            <div class="form-group">
                <label for="firstname">First name</label>
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter firstname"
                    required>

            </div>

            <div class="form-group">
                <label for="lastname">Last name</label>
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter lastname"
                    required>

            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                    placeholder="Enter email" required>

            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="******" required>
            </div>
            <br>

            <button type="submit" class="btn btn-warning">Sign up</button>
        </form>

        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
</body>

</html>