<?php
require_once('../db_conn.php');
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../loginScripts/login.php");
    exit;
}

$link = isset($_SESSION['is_employee']) && $_SESSION['is_employee'] ? '../library_frontend/employee_dashboard.php' : '../library_frontend/reader_dashboard.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = isset($_POST['title']) ? trim($_POST['title']) : '';

    if (!empty($title)) {
        $q2 = "SELECT Status FROM books WHERE Title = '$title'";
        $res2 = mysqli_query($conn, $q2);

        if($res2 && mysqli_num_rows($res2) > 0) {
            $row = mysqli_fetch_assoc($res2);

            if($row['Status'] == 'Wypożyczona'){
                $_SESSION['message'] = "<div class='alert alert-warning text-center' role = 'warning'>Nie można wypożyczyć książki, która nie jest dostępna.</div>";
            } else {
                $q = "UPDATE books SET Status = 'Wypożyczona' WHERE Title = '$title'";
                $res = mysqli_query($conn, $q);
                if($res){
                    $_SESSION['message'] = "<div class='alert alert-success text-center'>Książka została pomyślnie wypożyczona</div>";
                } else {
                    $_SESSION['message'] = "<div class='alert alert-danger text-center'>Błąd podczas wypożyczania książki</div>";
                }
            }
        } else {
            $_SESSION['message'] = "<div class='alert alert-warning text-center' role = 'warning'>Książka o podanym tytule nie istnieje</div>";
        }
    }

    $returnTitle = isset($_POST['return-title']) ? trim($_POST['return-title']) : '';
    if (!empty($returnTitle)) {
        $q2 = "SELECT Status FROM books WHERE Title = '$returnTitle'";
        $res2 = mysqli_query($conn, $q2);

        if ($res2 && mysqli_num_rows($res2) > 0) {
            $row = mysqli_fetch_assoc($res2);

            if ($row['Status'] == 'Dostępna') {
                $_SESSION['message'] = "<div class='alert alert-warning text-center' role = 'warning'>Nie można zwrócić książki, która jest już dostępna</div>";
            } else {
                $q = "UPDATE books SET Status = 'Dostępna' WHERE Title = '$returnTitle'";
                $res = mysqli_query($conn, $q);
                if ($res) {
                    $_SESSION['message'] = "<div class='alert alert-success text-center'>Książka została pomyślnie zwrócona</div>";
                } else {
                    $_SESSION['message'] = "<div class='alert alert-danger text-center'>Błąd podczas zwracania książki</div>";
                }
            }
        } else {
            $_SESSION['message'] = "<div class='alert alert-warning text-center' role = 'warning'>Książka o podanym tytule nie istnieje</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteka</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Biblioteka</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="<?= $link; ?>">Strona główna</a></li>
                <li class="nav-item"><a class="nav-link" href="borrowings.php">Wypożyczenia</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Kontakt</a></li>
                <li class="nav-item"><a class="nav-link" href="newBooks.php">Wstaw nową książkę</a></li>
                <li class="nav-item"><a class="nav-link" href="aboutUs.php">O nas</a></li>
            </ul>
            <div class="ml-auto">
                <a href="../loginScripts/logout.php" class="btn btn-outline-light">Wyloguj mnie</a>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <h4>Lista dostępnych książek</h4>
            <ul class="list-group" id="book-list">
                <?php
                    $q = "SELECT * FROM Books WHERE Status = 'Dostępna'";
                    $res = mysqli_query($conn, $q);
                    if ($res && mysqli_num_rows($res) > 0){
                        while($r = mysqli_fetch_assoc($res)) {
                            echo "<li class='list-group-item'>" . ($r["Title"]) . "</li>";
                        }
                    }
                ?>
            </ul>
        </div>
        <div class="col-md-8">
            <div class="borrow-form mb-4">
                <h4>Wypożycz książkę</h4>
                <form id="borrow-form" method="post">
                    <div class="form-group">
                        <label for="title">Nazwa książki:</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Nazwa książki, którą chcesz wypożyczyć" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Wypożycz</button>
                </form>
            </div>

            <div class="return-form">
                <h4>Zwróć książkę</h4>
                <form id="return-form" method="post">
                    <div class="form-group">
                        <label for="return-title">Nazwa książki:</label>
                        <input type="text" name="return-title" id="return-title" class="form-control" placeholder="Nazwa książki, którą chcesz zwrócić" required>
                    </div>
                    <button type="submit" class="btn btn-danger">Zwróć</button>
                </form>
                <?php
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4">
                <h5 class="mb-3">Biblioteka Miejska w Piasecznie</h5>
                <p>Adres: Jana Pawła II 55, 05-500 Piaseczno</p>
                <p>Telefon: (+48) 22 484 21 50</p>
                <p>Email: kontakt@biblioteka-piaseczno.pl</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="mb-3">Nasze Motto</h5>
                <span>"Gdzie książki, tam mądrość. Gdzie mądrość, tam przyszłość."</span>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="mb-1">Godziny otwarcia</h5>
                <table class="table text-light">
                    <tbody>
                    <tr><td>Pon - Pt:</td><td>8:00 - 19:00</td></tr>
                    <tr><td>Sob - Niedz:</td><td>9:00 - 17:00</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2024 Copyright: Gmina Piaseczno
    </div>
</footer>
</body>
</html>
