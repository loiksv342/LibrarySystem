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
    <link rel="stylesheet" href="../css/aboutUs.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .announcement-banner {
            background-color: #007bff;
            color: white;
            padding: 1rem;
            font-size: 1.25rem;
            font-weight: bold;
        }
        .aboutUs {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-top: 2rem;
        }
        h3 {
            color: #343a40;
        }
        footer {
            background-color: #343a40;
            color: #fff;
            padding: 2rem 0;
        }
        footer a {
            color: #fff;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
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

<div class="aboutUs container py-5">
    <div class="row">
        <div class="col-lg-6 mb-4">
            <h3>O nas</h3>
            <p>Biblioteka w Piasecznie to przestrzeń, gdzie pasja do książek łączy się z edukacją i kulturą. Od 2000 roku wspieramy mieszkańców w rozwijaniu swoich zainteresowań i odkrywaniu literackich skarbów.</p>
            <p>Nasz zespół to grupa entuzjastów literatury, gotowych pomóc Ci w każdej literackiej przygodzie. Dołącz do naszej społeczności i odkryj, jak wiele możesz zyskać dzięki książkom!</p>
        </div>
        <div class="col-lg-6 mb-4">
            <h3>Co oferujemy?</h3>
            <ul class="list-unstyled">
                <li><i class="fas fa-book"></i> Szeroki zbiór książek: Od klasyki literatury po najnowsze bestsellery</li>
                <li><i class="fas fa-film"></i> Usługi wypożyczeń: Wygodne wypożyczanie książek i multimediów.</li>
                <li><i class="fas fa-tablet-alt"></i> E-booki i audiobooki: Dostęp do cyfrowych wersji książek.</li>
                <li><i class="fas fa-users"></i> Programy edukacyjne: Warsztaty, spotkania z autorami i inne wydarzenia kulturalne.</li>
            </ul>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4">
                <h5>Biblioteka Miejska w Piasecznie</h5>
                <p>Adres: Jana Pawła II 55, 05-500 Piaseczno</p>
                <p>Telefon: (+48) 22 484 21 50</p>
                <p>Email: kontakt@biblioteka-piaseczno.pl</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Nasze Motto</h5>
                <p>"Gdzie książki, tam mądrość. Gdzie mądrość, tam przyszłość."</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Godziny otwarcia</h5>
                <table class="table table-dark table-bordered">
                    <tbody>
                    <tr>
                        <td>Pon - Pt:</td>
                        <td>8:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Sob - Niedz:</td>
                        <td>9:00 - 17:00</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">
            © 2024 Copyright: Gmina Piaseczno
        </div>
    </div>
</footer>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
