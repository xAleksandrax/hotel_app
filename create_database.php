<?php
$servername = "localhost";
$username = "root"; // Domyślna nazwa użytkownika w XAMPP to "root"
$password = "";     // Domyślne hasło w XAMPP to puste
$dbname = "hotel";  // Nazwa bazy danych, którą chcesz utworzyć


// Nawiązanie połączenia
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

// Utworzenie tabeli pokoje
$sql = "CREATE TABLE IF NOT EXISTS pokoje (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    numer_pokoju INT(4) NOT NULL,
    typ_pokoju VARCHAR(50) NOT NULL,
    dostepnosc BOOLEAN DEFAULT true
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela 'pokoje' została utworzona lub już istnieje.<br>";
} else {
    echo "Błąd podczas tworzenia tabeli 'pokoje': " . $conn->error . "<br>";
}

// Dodanie przykładowych danych do tabeli pokoje
// $sql = "INSERT INTO pokoje (numer_pokoju, typ_pokoju, dostepnosc) VALUES
//     (101, 'jednoosobowy', true),
//     (102, 'jednoosobowy', true),
//     (201, 'dwuosobowy', true),
//     (202, 'dwuosobowy', true),
//     (301, 'apartament', true),
//     (302, 'apartament', true)";

// if ($conn->query($sql) === TRUE) {
//     echo "Przykładowe pokoje zostały dodane do tabeli 'pokoje'.";
// } else {
//     echo "Błąd podczas dodawania przykładowych pokojów: " . $conn->error;
// }

$sql_rezerwacje = "CREATE TABLE IF NOT EXISTS reservations (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL,
    arrival_date DATE NOT NULL,
    departure_date DATE NOT NULL,
    adults INT NOT NULL,
    children INT NOT NULL,
    room_type VARCHAR(50) NOT NULL,
    room_id INT(6) UNSIGNED NOT NULL,  -- Dodajemy pole przechowujące identyfikator pokoju
    comments TEXT,
    reservation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql_rezerwacje) === TRUE) {
    echo "Tabela 'reservations' została utworzona lub już istnieje.<br>";
} else {
    echo "Błąd podczas tworzenia tabeli 'reservations': " . $conn->error . "<br>";
}

// Wstawianie przykładowych danych do tabeli reservations
// $sql_dodaj_rezerwacje = "INSERT INTO reservations (name, arrival_date, departure_date, adults, children, room_type, comments)
// VALUES
// ('Jan Kowalski', '2024-01-10', '2024-01-15', 2, 0, 'Pokoj jednoosobowy', 'Brak uwag'),
// ('Anna Nowak', '2024-02-05', '2024-02-10', 1, 2, 'Apartament', 'Blisko plaży')";

// if ($conn->query($sql_dodaj_rezerwacje) === TRUE) {
//     echo "Przykładowe rezerwacje zostały dodane do tabeli 'reservations'.<br>";
// } else {
//     echo "Błąd podczas dodawania przykładowych rezerwacji: " . $conn->error . "<br>";
// }

$sql_uzytkownicy = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL
)";

if ($conn->query($sql_uzytkownicy) === TRUE) {
    echo "Tabela 'users' została utworzona lub już istnieje.";
} else {
    echo "Błąd podczas tworzenia tabeli 'users': " . $conn->error;
}


// Zamknięcie połączenia
$conn->close();
?>
