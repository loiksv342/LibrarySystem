<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../loginScripts/login.php");
    exit;
}

$link = isset($_SESSION['is_employee']) && $_SESSION['is_employee'] ? '../library_frontend/employee_dashboard.php' : '../library_frontend/reader_dashboard.php';
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
                <li class="nav-item"><a class="nav-link active" href=<?php $link; ?>>Strona główna</a></li>
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

<main class="container mt-4">
    <div class="card">
        <div class="card-body">
            <?php
            // Wyświetlenie komunikatu, jeśli istnieje
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']); // Usunięcie komunikatu po wyświetleniu
            }
            ?>
            <h4 class="card-title">Dane dotyczące autora:</h4>
            <form action="../book_management_scripts/addBook.php" method="post">
                <div class="form-group">
                    <label for="authorFirstName">Imię autora:</label>
                    <input type="text" class="form-control" id="authorFirstName" name="authorFirstName" placeholder="Podaj imię autora" required>
                </div>
                <div class="form-group">
                    <label for="authorLastName">Nazwisko autora:</label>
                    <input type="text" class="form-control" id="authorLastName" name="authorLastName" placeholder="Podaj nazwisko autora" required>
                </div>
                <div class="form-group">
                    <label for="authorNationality">Pochodzenie autora:</label>
                    <input type="text" class="form-control" id="authorNationality" name="authorNationality" placeholder="Podaj pochodzenie autora" required>
                </div>
                <div class="form-group">
                    <label for="authorBirthDay">Data narodzin autora:</label>
                    <input type="date" class="form-control" id="authorBirthDay" name="authorBirthDay" required>
                </div>

                <h4 class="card-title">Dane dotyczące książki:</h4>
                <div class="form-group">
                    <label for="bookTitle">Tytuł książki:</label>
                    <input type="text" class="form-control" id="bookTitle" name="bookTitle" placeholder="Podaj tytuł książki" required>
                </div>
                <div class="form-group">
                    <label for="bookPages">Liczba stron:</label>
                    <input type="number" class="form-control" id="bookPages" name="bookPages" placeholder="Podaj liczbę stron książki" required>
                </div>
                <div class="form-group">
                    <label for="bookYear">Rok opublikowania:</label>
                    <input type="number" class="form-control" id="bookYear" name="bookYear" placeholder="Podaj rok opublikowania książki" required>
                </div>

                <button type="submit" class="btn btn-primary">Zapisz książkę</button>
            </form>
        </div>
    </div>
</main>

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
