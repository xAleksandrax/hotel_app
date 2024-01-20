<?php
$servername = "localhost";
$username = "root"; // Default username in XAMPP is "root"
$password = "";     // Default password in XAMPP is empty
$dbname = "hotel";  // Name of the database you want to create

// Establishing a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Checking the connection
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

// Creating the 'pokoje' table
$sql_pokoje = "CREATE TABLE IF NOT EXISTS pokoje (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    numer_pokoju INT(4) NOT NULL,
    typ_pokoju VARCHAR(50) NOT NULL,
    dostepnosc BOOLEAN DEFAULT true
)";

if ($conn->query($sql_pokoje) === TRUE) {
    echo "Table 'pokoje' created or already exists.<br>";
} else {
    echo "Error creating 'pokoje' table: " . $conn->error . "<br>";
}

// Creating the 'users' table
$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL
)";

if ($conn->query($sql_users) === TRUE) {
    echo "Table 'users' created or already exists.<br>";
} else {
    echo "Error creating 'users' table: " . $conn->error . "<br>";
}

// Creating the 'reservations' table with foreign keys
$sql_reservations = "CREATE TABLE IF NOT EXISTS reservations (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL,
    arrival_date DATE NOT NULL,
    departure_date DATE NOT NULL,
    adults INT NOT NULL,
    children INT NOT NULL,
    room_type VARCHAR(50) NOT NULL,
    room_id INT(6) UNSIGNED NOT NULL,
    comments TEXT,
    reservation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE,
    FOREIGN KEY (room_id) REFERENCES pokoje(id) ON DELETE CASCADE
)";

if ($conn->query($sql_reservations) === TRUE) {
    echo "Table 'reservations' created or already exists.<br>";
} else {
    echo "Error creating 'reservations' table: " . $conn->error . "<br>";
}

// Deleting orphaned reservations
$sql_delete_orphans = "DELETE FROM reservations WHERE username NOT IN (SELECT username FROM users)";
if ($conn->query($sql_delete_orphans) === TRUE) {
    echo "Orphaned reservations have been deleted.<br>";
} else {
    echo "Error deleting orphaned reservations: " . $conn->error . "<br>";
}

// Closing the connection
$conn->close();
?>
