<?php
session_start();

$servername = "localhost";
$username = "root"; // Twoja nazwa użytkownika bazy danych
$password = ""; // Twoje hasło do bazy danych
$dbname = "hotel"; // Nazwa twojej bazy danych

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Połączenie z bazą danych
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Błąd połączenia: " . $conn->connect_error);
    }

    // Pobranie danych z formularza
    $name = $_POST['name'];
    $arrival_date = $_POST['arrival_date'];
    $departure_date = $_POST['departure_date'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $room_type = $_POST['room_type'];
    $comments = $_POST['comments'];
    $username = $_SESSION['username'];

    // Zapytanie SQL do sprawdzenia dostępności pokoju
    $check_room_query = "SELECT id FROM pokoje WHERE typ_pokoju = '$room_type' AND dostepnosc = true LIMIT 1";
    $room_result = $conn->query($check_room_query);

    if ($room_result->num_rows > 0) {
        $room_row = $room_result->fetch_assoc();
        $room_id = $room_row['id'];

        // Zapytanie SQL do dodania rezerwacji
        $add_reservation_query = "INSERT INTO reservations (username, room_id, name, arrival_date, departure_date, adults, children, room_type, comments) 
        VALUES ('$username', '$room_id', '$name', '$arrival_date', '$departure_date', '$adults', '$children', '$room_type', '$comments')";


        if ($conn->query($add_reservation_query) === TRUE) {
            // Zaktualizuj dostępność pokoju na False
            $update_room_query = "UPDATE pokoje SET dostepnosc = false WHERE id = '$room_id'";
            $conn->query($update_room_query);

            header("Location: my_reservations.php");
        } else {
            header("Location: front.html");
        }
    } else {
        header("Location: front.html");
    }

    $conn->close();
}
?>
