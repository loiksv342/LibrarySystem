<?php
require_once('../db_conn.php');
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../loginScripts/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteka</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Biblioteka</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="employee_dashboard.php">Strona główna</a></li>
                <li class="nav-item"><a class="nav-link" href="borrowings.php">Wypożyczenia</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Kontakt</a></li>
                <li class="nav-item"><a class="nav-link" href="newBooks.php">Dodaj nową książkę</a></li>
                <li class="nav-item"><a class="nav-link" href="aboutUs.php">O nas</a></li>
            </ul>
            <div class="ml-auto">
                <a href="../loginScripts/logout.php" class="btn btn-outline-light">Wyloguj mnie</a>
            </div>
        </div>
    </div>
</nav>


<main class="container mt-4">
    <div class="text-center mb-4">
        <h2>Witaj w Księgarni!</h2>
        <p>W twojej krainie fantazji i marzeń</p>
    </div>
    <h3 class="text-center mb-4">Jak wygląda nasza biblioteka?</h3>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../images/books1.jpg" class="d-block w-100" alt="Książki 1">
            </div>
            <div class="carousel-item">
                <img src="../images/books2.jpg" class="d-block w-100" alt="Książki 2">
            </div>
            <div class="carousel-item">
                <img src="../images/books3.jpg" class="d-block w-100" alt="Książki 3">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Poprzedni</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Następny</span>
        </a>
    </div>

    <div class="latest-books mt-4">
        <h4 class="text-center">5 najnowszych książek w naszej bibliotece</h4>
        <div class="row">
            <?php
            $query = "SELECT Title, Page_Count, Published_Year FROM Books ORDER BY Published_Year DESC LIMIT 5"; 
            $res = mysqli_query($conn, $query);

            if (mysqli_num_rows($res) > 0) {
                while ($r = mysqli_fetch_assoc($res)) {
                    echo "<div class='col-md-4 mb-4'>";
                    echo "<div class='card'>";
                    echo "<div class='card-body text-center'>";
                    echo "<h5 class='card-title'>{$r['Title']}</h5>";
                    echo "<p class='card-text'>Liczba stron: {$r['Page_Count']}</p>";
                    echo "<p class='card-text'>Rok wydania: {$r['Published_Year']}</p>";
                    echo "</div></div></div>";
                }
            } else {
                echo "<p class='text-center'>Brak danych</p>";
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>
</main>

<footer class="footer bg-dark text-white mt-4">
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
                <table class="table text-white">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
