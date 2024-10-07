<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = mysqli_connect('localhost', 'root', '', 'Biblioteka');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $pesel = mysqli_real_escape_string($conn, $_POST['pesel']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $card_number = mysqli_real_escape_string($conn, $_POST['library_card_number']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO Reader (PESEL, FirstName, LastName, Library_Card_Number, Phone_Number, Password) 
              VALUES ('$pesel', '$first_name', '$last_name', '$card_number', '$phone','$hashed_password')";
    $res = mysqli_query($conn, $query);

    if ($res) {
        $_SESSION['message'] = "<div class='alert alert-success'>Account successfully created!</div>";
        header("Location: login.php");
        exit();
    } else {
        error_log("Registration failed: " . mysqli_error($conn));
        $_SESSION['message'] = "<div class='alert alert-danger'>Registration failed. Please try again.</div>";
        header("Location: register.php");
        exit();
    }

    mysqli_close($conn);
}

$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card my-5">
                <h2 class="text-center text-dark mt-5">Register Your Library Account</h2>
                <form class="card-body cardbody-color p-lg-5" method="POST" action="">
                    <div class="text-center">
                        <img src="../images/avatar.jpg" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="pesel" name="pesel" placeholder="Enter PESEL" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="library_card_number" name="library_card_number" placeholder="Enter your Card Number" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter Phone Number" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Enter your Password" required>
                    </div>
                    <div class="buttons">
                        <button type="submit" class="btn btn-primary">Register</button>
                        <a href="login.php" class="btn btn-secondary">Login</a>
                    </div>
                    <div class="alert alert-danger errors" style="display: none;"></div>
                </form>
                <?php
                if (!empty($message)) {
                    echo $message;
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
<script src='../JS/register.js'></script>
</html>
