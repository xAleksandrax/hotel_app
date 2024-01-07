<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

$sql = "SELECT r.id, r.name, r.arrival_date, r.departure_date, r.adults, r.children, r.room_type, r.comments, r.reservation_date, p.numer_pokoju 
        FROM reservations r 
        INNER JOIN pokoje p ON r.room_id = p.id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['arrival_date'] . "</td>";
        echo "<td>" . $row['departure_date'] . "</td>";
        echo "<td>" . $row['adults'] . "</td>";
        echo "<td>" . $row['children'] . "</td>";
        echo "<td>" . $row['room_type'] . "</td>";
        echo "<td>" . $row['comments'] . "</td>";
        echo "<td>" . $row['reservation_date'] . "</td>";
        echo "<td>" . $row['numer_pokoju'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='10'>Brak rezerwacji.</td></tr>";
}

$conn->close();
?>
