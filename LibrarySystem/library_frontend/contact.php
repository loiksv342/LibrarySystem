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
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .alert {
            text-align: center;
            display: none;
        }
        #map {
            height: 400px;
            width: 100%;
        }
        .announcement-banner {
            background-color: #007bff;
            color: white;
            padding: 1rem;
            text-align: center;
            font-size: 1.25rem;
            font-weight: bold;
        }
        footer {
            background-color: #343a40;
            color: #fff;
            padding: 2rem 0;
        }
        .footer a {
            color: #fff;
        }
        .footer a:hover {
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

<div class="container py-5">
    <div class="row">
        <div class="col-lg-6">
            <h2 class="text-center mb-4">Kontakt</h2>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Uwaga:</strong> musisz wprowadzić dane!
            </div>
            <form id="contactForm">
                <div class="form-group">
                    <label for="email">Adres e-mail</label>
                    <input type="email" class="form-control" id="email" placeholder="Wprowadź adres e-mail" required>
                </div>
                <div class="form-group">
                    <label for="message">Wiadomość</label>
                    <textarea class="form-control" id="message" rows="4" placeholder="Wprowadź swoją wiadomość" required></textarea>
                </div>
                <button type="button" onclick="sendEmail()" class="btn btn-primary">Wyślij</button>
            </form>
        </div>
        <div class="col-lg-6">
            <h2 class="text-center mb-4">Nasza lokalizacja</h2>
            <div id="map"></div>
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    function initMap() {
        const location = [52.07472, 21.02612]; // Współrzędne dla Biblioteki miejskiej w Piasecznie
        const map = L.map('map').setView(location, 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker(location).addTo(map)
            .bindPopup('Biblioteka Miejska w Piasecznie')
            .openPopup();
    }

    document.addEventListener('DOMContentLoaded', initMap);

    sendEmail = () => {
        const email = document.getElementById('email').value;
        const message = document.getElementById('message').value;

        if (!email || !message) {
            const alert = document.querySelector('.alert');
            alert.style.display = "block";
            return;
        }

        const subject = 'Kontakt z Biblioteki';
        const body = `Wiadomość od: ${email}%0D%0A%0D%0A${message}`;
        window.location.href = `mailto:kontakt@biblioteka-piaseczno.pl?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
    }
</script>
</body>
</html>
