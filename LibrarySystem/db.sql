-- Tworzenie bazy danych
-- CREATE DATABASE Biblioteka;
USE Biblioteka;

-- Tabela Autorzy
CREATE TABLE Author (
    Author_ID INT PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(32) NOT NULL,
    LastName VARCHAR(32) NOT NULL,
    Nationality VARCHAR(30),
    Birth_Date DATE
);

-- Dodawanie danych do tabeli Autorzy
INSERT INTO Author (FirstName, LastName, Nationality, Birth_Date) VALUES
('J.K.', 'Rowling', 'Brytyjska', '1965-07-31'),
('J.R.R.', 'Tolkien', 'Brytyjska', '1892-01-03');

-- Tabela Książki
CREATE TABLE Books (
    Book_ID INT PRIMARY KEY AUTO_INCREMENT,
    Title VARCHAR(100) NOT NULL,
    Page_Count INT NOT NULL,
    Author_ID INT NOT NULL,
    Published_Year YEAR NOT NULL,
    Status ENUM('Dostępna', 'Wypożyczona') NOT NULL,
    FOREIGN KEY (Author_ID) REFERENCES Author(Author_ID)
);

-- Dodawanie danych do tabeli Książki
INSERT INTO Books (Title, Page_Count, Author_ID, Published_Year, Status) VALUES
('Harry Potter i Kamień Filozoficzny', 223, 1, 1997, 'Dostępna'),
('Władca Pierścieni: Drużyna Pierścienia', 423, 2, 1954, 'Dostępna');

-- Tabela Czytelnik
CREATE TABLE Reader (
    PESEL VARCHAR(11) PRIMARY KEY NOT NULL,
    FirstName VARCHAR(32) NOT NULL,
    LastName VARCHAR(32) NOT NULL,
    Library_Card_Number VARCHAR(20) UNIQUE NOT NULL,
    Phone_Number VARCHAR(20) NOT NULL,
    Password VARCHAR(100) NOT NULL
);

-- Dodawanie danych do tabeli Czytelnik
INSERT INTO Reader (PESEL, FirstName, LastName, Library_Card_Number, Phone_Number) VALUES
('12345678901', 'Anna', 'Kowalska', 'LIB0001', '123-456-789'),
('98765432109', 'Jan', 'Nowak', 'LIB0002', '987-654-321');

-- Tabela Wypożyczenia
CREATE TABLE Borrowings (
    Borrowing_ID INT PRIMARY KEY AUTO_INCREMENT,
    Borrow_Date DATE NOT NULL,
    Return_Date DATE,
    Book_ID INT NOT NULL,
    Reader_ID VARCHAR(11) NOT NULL,
    FOREIGN KEY (Book_ID) REFERENCES Books(Book_ID),
    FOREIGN KEY (Reader_ID) REFERENCES Reader(PESEL)
);
