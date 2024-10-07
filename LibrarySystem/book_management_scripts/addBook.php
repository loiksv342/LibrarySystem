<?php
require_once('../db_conn.php');
session_start();

// Sprawdzanie, czy użytkownik jest zalogowany i czy jest pracownikiem
if (!isset($_SESSION['user']) || !isset($_SESSION['is_employee']) || !$_SESSION['is_employee']) {
    header("Location: ../reader_dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Pobierz dane z formularza
    $authorFirstName = isset($_POST['authorFirstName']) ? trim($_POST['authorFirstName']) : '';
    $authorLastName = isset($_POST['authorLastName']) ? trim($_POST['authorLastName']) : '';
    $authorNationality = isset($_POST['authorNationality']) ? trim($_POST['authorNationality']) : '';
    $authorBirthDay = isset($_POST['authorBirthDay']) ? trim($_POST['authorBirthDay']) : '';
    $bookTitle = isset($_POST['bookTitle']) ? trim($_POST['bookTitle']) : '';
    $bookPages = isset($_POST['bookPages']) ? trim($_POST['bookPages']) : '';
    $bookYear = isset($_POST['bookYear']) ? trim($_POST['bookYear']) : '';

    if (!empty($authorFirstName) && !empty($authorLastName) && !empty($authorNationality) && !empty($authorBirthDay) &&
        !empty($bookTitle) && !empty($bookPages) && !empty($bookYear)) {

        // Dodanie nowego autora
        $query = "INSERT INTO Author (FirstName, LastName, Nationality, Birth_Date) 
                  VALUES ('$authorFirstName', '$authorLastName', '$authorNationality', '$authorBirthDay')";

        if (mysqli_query($conn, $query)) {
            // Pobierz ID nowo dodanego autora
            $authorID = mysqli_insert_id($conn);

            // Dodanie nowej książki
            $query = "INSERT INTO Books (Title, Page_Count, Author_ID, Published_Year) 
                      VALUES ('$bookTitle', '$bookPages', '$authorID', '$bookYear')";

            if (mysqli_query($conn, $query)) {
                echo "Dane zostały dodane pomyślnie.";
            } else {
                echo "Błąd podczas dodawania książki: " . htmlspecialchars(mysqli_error($conn));
            }
        } else {
            echo "Błąd podczas dodawania autora: " . htmlspecialchars(mysqli_error($conn));
        }
    } else {
        echo "Wszystkie pola muszą być wypełnione.";
    }
}

mysqli_close($conn); // Zamknięcie połączenia
?>
