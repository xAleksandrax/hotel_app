<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $sql = "SELECT * FROM reservations WHERE username = '$username'";
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
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='9'>Brak rezerwacji dla tego użytkownika.</td></tr>";
    }
} else {
    echo "<tr><td colspan='9'>Użytkownik niezalogowany.</td></tr>";
}

$conn->close();
?>
