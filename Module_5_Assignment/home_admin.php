<?php
session_start();
$filename = "./data/users.txt";

//     $selectedUser = $_POST['user'];
//     $newRole = $_POST['newRole'];

//     if ($selectedUser === $_SESSION['email']) {
//         echo "You cannot update your own role.";
//     } else {
//         $lines = file($filename);

//         if ($lines !== false) {
//             $updatedData = [];

//             foreach ($lines as $line) {
//                 $values = array_map('trim', explode(",", $line));

//                 if (count($values) >= 5) {
//                     list($role, $email, $firstname, $lastname, $newUserPassword) = $values;

//                     if ($email === $selectedUser) {
//                         $role = $newRole;
//                     }

//                     $updatedData[] = "$role, $email, $firstname, $lastname, $newUserPassword";
//                 }
//             }

//             if (file_put_contents($filename, implode("\n", $updatedData)) !== false) {
//                 echo '
// 		        <script>
// 		    	alert("Role updated successfully.");
//                 window.location.href = "index.php";
// 		        </script>
// 		        ';

//             } else {
//                 echo '
// 		        <script>
// 		    	alert("Failed to update role.");
//                 window.location.href = "index.php";
// 		        </script>
// 		        ';
//             }
//         }
//     }
// }

// Add a new user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['newUserEmail'])) {
        $newUserEmail = $_POST['newUserEmail'];
        $newUserFirstName = $_POST['newUserFirstName'];
        $newUserLastName = $_POST['newUserLastName'];
        $newUserRole = $_POST['newUserRole'];
        $newUserPassword = $_POST['newUserPassword'];

        $lines = file($filename);

        $emailExists = false;
        foreach ($lines as $line) {
            $values = explode(",", $line);
            if (count($values) >= 2) {
                $email = trim($values[1]);
                if (strcasecmp($email, $newUserEmail) === 0) {
                    $emailExists = true;
                    break;
                }
            }
        }

        if ($emailExists) {
            echo '
        <script>
        alert("Email already exists. Please choose a different email.");
        window.location.href = "index.php";
        </script>
        ';

        } else {

            $newUserData = "$newUserRole, $newUserEmail, $newUserFirstName, $newUserLastName, $newUserPassword";
            file_put_contents($filename, PHP_EOL . $newUserData, FILE_APPEND);
            echo '
        <script>
        alert("New user added successfully.");
        window.location.href = "index.php";
        </script>
        ';
        }
    } elseif (isset($_POST['user'])) {
        $selectedUser = $_POST['user'];
        $newRole = $_POST['newRole'];

        if ($selectedUser === $_SESSION['email']) {
            echo "You cannot update your own role.";
            echo '
                    <script>
                    alert("You cannot update your own role.");
                    window.location.href = "index.php";
                    </script>
                    ';
        } else {
            $lines = file($filename);

            if ($lines !== false) {
                $updatedData = [];

                foreach ($lines as $line) {
                    $values = array_map('trim', explode(",", $line));

                    if (count($values) >= 5) {
                        list($role, $email, $firstname, $lastname, $newUserPassword) = $values;

                        if ($email === $selectedUser) {
                            $role = $newRole;
                        }

                        $updatedData[] = "$role, $email, $firstname, $lastname, $newUserPassword";
                    }
                }

                if (file_put_contents($filename, implode("\n", $updatedData)) !== false) {
                    echo '
                    <script>
                    alert("Role updated successfully.");
                    window.location.href = "index.php";
                    </script>
                    ';

                } else {
                    echo '
                    <script>
                    alert("Failed to update role.");
                    window.location.href = "index.php";
                    </script>
                    ';
                }
            }
        }
    }
}

// Handle user deletion
if (isset($_GET['delete'])) {
    $userToDelete = $_GET['delete'];

    // Check if the selected user matches the currently logged-in user
    if ($userToDelete === $_SESSION['email']) {
        echo "You cannot delete your own account.";
    } else {
        $lines = file($filename);
        $updatedData = [];

        foreach ($lines as $line) {
            $values = explode(",", $line);

            if (count($values) >= 4) {
                $email = trim($values[1]);

                if (strcasecmp($email, $userToDelete) !== 0) {
                    $updatedData[] = $line;
                }
            }
        }


        if (file_put_contents($filename, implode("\n", $updatedData)) !== false) {
            $emailToDelete = htmlspecialchars($userToDelete);
            echo '<script>
                alert("User with email ' . $emailToDelete . ' has been deleted.");
                window.location.href = "index.php";
                </script>';
        } else {
            echo '<script>
            alert("Failed to delete user.");
            window.location.href = "index.php";
            </script>
            ';
        }
    }
}

$lines = file($filename);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <h1>Admin Panel</h1>
        <h2>Welcome!
            <?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"]; ?>
        </h2>
        <h2>Role:
            <?php echo $_SESSION["role"]; ?>
        </h2>
        <form method="POST" action="logout.php">
            <button type="submit" id="logOutButton">Logout</button>
        </form>

    </header>
    <div class="container">

        <form method="POST" action="">
            <table>
                <tr>
                    <th colspan="6" style="background-color: #333; text-align: center;">Add New User</th>
                </tr>
                <tr>
                    <th>Role</th>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Password</th>
                </tr>
                <tr>
                    <td>
                        <select name="newUserRole" id="newUserRole">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                        </select>
                    </td>
                    <td><input type="email" name="newUserEmail" id="newUserEmail" required></td>
                    <td><input type="text" name="newUserFirstName" id="newUserFirstName" required></td>
                    <td><input type="text" name="newUserLastName" id="newUserLastName" required></td>
                    <td><input type="password" name="newUserPassword" id="newUserPassword" required></td>
                </tr>

            </table>
            <div style="text-align: center;">
                <button type="submit" id="addUserButton">Add New User</button>
            </div>
        </form>
        <table>
            <tr>
                <th colspan="6" style="background-color: #333; text-align: center;">All User List</th>
            </tr>
            <tr>
                <th>Role</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($lines as $line) {
                $values = explode(",", $line);
                if (count($values) >= 4) {
                    list($role, $email, $firstname, $lastname) = array_map('trim', $values);
                    echo "<tr>";
                    echo "<td>$role</td>";
                    echo "<td>$email</td>";
                    echo "<td>$firstname</td>";
                    echo "<td>$lastname</td>";
                    if ($email !== $_SESSION['email']) {
                        echo "<td><a class='delete-link' href='?delete=$email'>Delete</a></td>";
                    } else {
                        echo "<td>Cannot delete own account</td>";
                    }
                    echo "</tr>";
                }
            }
            ?>
        </table>
        <br><br>
        <form method="POST" action="">
            <table>
                <tr>
                    <th colspan="6" style="background-color: #333; text-align: center;">Update Role</th>
                </tr>
                <tr>
                    <th>Select User</th>
                    <th>Select Role</th>
                </tr>
                <tr>
                    <td>

                        <select name="user" id="user">
                            <?php
                            foreach ($lines as $line) {
                                $values = explode(",", $line);
                                if (count($values) >= 2) {
                                    $email = trim($values[1]);
                                    echo "<option value='$email'>$email</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name="newRole" id="newRole">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                        </select>
                    </td>
                </tr>

            </table>
            <div style="text-align: center;">
                <button type="submit" id="addUserButton">Update Role</button>
            </div>
        </form>

    </div>
</body>

</html>