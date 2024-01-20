<?php
session_start();

$servername = "localhost";
$username = "root"; // Twoja nazwa użytkownika bazy danych
$password = ""; // Twoje hasło do bazy danych
$dbname = "hotel"; // Nazwa twojej bazy danych

if ($_SESSION['role'] == 'gość') {
    echo "Access denied. You do not have the necessary role.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Błąd połączenia: " . $conn->connect_error);
    }

    $reservation_id_delete = $_POST['reservation_id_delete'];

    // Pobierz numer pokoju z rezerwacji
    $sql_get_room_number = "SELECT room_id FROM reservations WHERE id = '$reservation_id_delete'";
    $result = $conn->query($sql_get_room_number);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $room_number = $row['room_id'];

        // Usuń rezerwację
        $sql_delete = "DELETE FROM reservations WHERE id = '$reservation_id_delete'";
        if ($conn->query($sql_delete) === TRUE) {
            // Ustaw dostępność pokoju na wolny
            $sql_update_room = "UPDATE pokoje SET dostepnosc = true WHERE id = '$room_number'";
            if ($conn->query($sql_update_room) === TRUE) {
                header("Location: all_reservations.php");
            } else {
                echo "Błąd podczas aktualizacji dostępności pokoju: " . $conn->error;
            }
        } else {
            echo "Błąd podczas usuwania rezerwacji: " . $conn->error;
        }
    } else {
        echo "Nie znaleziono rezerwacji o podanym ID.";
    }

    $conn->close();
}
?>
