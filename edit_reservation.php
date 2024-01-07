<?php
session_start();

$servername = "localhost";
$username = "root"; // Twoja nazwa użytkownika bazy danych
$password = ""; // Twoje hasło do bazy danych
$dbname = "hotel"; // Nazwa twojej bazy danych

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Błąd połączenia: " . $conn->connect_error);
    }

    $reservation_id = $_POST['reservation_id'];
    $new_arrival_date = $_POST['new_arrival_date'];
    $new_departure_date = $_POST['new_departure_date'];
    $new_room_number = $_POST['new_room_number'];

    // Pobierz identyfikator pokoju na podstawie numeru pokoju
    $sql_get_room_id = "SELECT id FROM pokoje WHERE numer_pokoju = '$new_room_number'";
    $result = $conn->query($sql_get_room_id);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $new_room_id = $row['id'];

        // Aktualizuj rezerwację z użyciem identyfikatora pokoju
        $sql_update_reservation = "UPDATE reservations 
        SET arrival_date = '$new_arrival_date', departure_date = '$new_departure_date', room_id = '$new_room_id' 
        WHERE id = '$reservation_id'";
        
        if ($conn->query($sql_update_reservation) === TRUE) {
            // Ustaw dostępność pokoi
            $sql_update_current_room = "UPDATE pokoje SET dostepnosc = true WHERE id = '$current_room_id'";
            $sql_update_new_room = "UPDATE pokoje SET dostepnosc = false WHERE id = '$new_room_id'";
            
            if ($conn->query($sql_update_current_room) === TRUE && $conn->query($sql_update_new_room) === TRUE) {
                header("Location: all_reservations.php");
            } else {
                echo "Błąd podczas aktualizacji dostępności pokoi: " . $conn->error;
            }
        } else {
            echo "Błąd podczas aktualizacji rezerwacji: " . $conn->error;
        }
    } else {
        echo "Nie znaleziono pokoju o podanym numerze.";
    }

    $conn->close();
}
?>
