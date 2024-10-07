<?php
require_once('../db_conn.php');
session_start();

$path = '../images/avatar.jpg';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = trim($_POST['pass']);
    $card_number = trim($_POST['card_number']);

    if (!empty($password) && !empty($card_number)) {
        $query = "SELECT * FROM Reader WHERE Library_Card_Number = '$card_number'";
        $res = mysqli_query($conn, $query);

        if ($res) {
            if (mysqli_num_rows($res) > 0) {
                $user = mysqli_fetch_assoc($res);
                if (password_verify($password, $user['Password'])) {
                    session_regenerate_id(true);
                    $_SESSION['user'] = $user['FirstName']; 
                    $_SESSION['card_number'] = $card_number;
                    $_SESSION['is_employee'] = (substr($card_number, 0, 2) === "00");
                    $redirectPage = $_SESSION['is_employee'] ? 'employee_dashboard.php' : 'reader_dashboard.php';
                    header("Location: ../library_frontend/$redirectPage");
                    exit;
                } else {
                    $_SESSION['message'] = "<div class='alert alert-danger'>Invalid Password or card number.</div>";
                }
            } else {
                $_SESSION['message'] = "<div class='alert alert-danger'>Invalid Password or card number.</div>";
            }
        } else {
            $_SESSION['message'] = "<div class='alert alert-danger'>An error occurred. Please try again later.</div>";
        }
    } else {
        $_SESSION['message'] = "<div class='alert alert-danger'>Please fill in all fields!</div>";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card my-5">
                <form class="card-body cardbody-color p-lg-5" method="POST" action="">
                    <h2 class="text-center text-dark mt-5">Login to Library</h2>
                    <div class="text-center">
                        <img src="<?php echo $path; ?>" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="card_number" name="card_number" placeholder="Enter your Card Number" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Enter your Password" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-5 mb-5 w-100">Login</button>
                    </div>
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    ?>
                    <div id="emailHelp" class="form-text text-center mb-5 text-dark">Not Registered? <a href="register.php" class="text-dark fw-bold"> Create an Account</a></div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
