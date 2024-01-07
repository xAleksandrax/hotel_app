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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];
    $input_role = $_POST['role'];

    // Sprawdzenie, czy użytkownik o podanej nazwie już istnieje
    $check_user_sql = "SELECT id FROM users WHERE username = '$input_username'";
    $check_result = $conn->query($check_user_sql);

    if ($check_result->num_rows > 0) {
        echo "Użytkownik o podanej nazwie już istnieje.";
    } else {
        // Dodanie nowego użytkownika
        $insert_user_sql = "INSERT INTO users (username, password, role) VALUES ('$input_username', '$input_password', '$input_role')";
        if ($conn->query($insert_user_sql) === TRUE) {
            header("Location: login.html"); // Przekierowanie po udanej rejestracji
            exit(); // Upewnij się, że po przekierowaniu nie ma już kodu do wykonania
        } else {
            echo "Błąd podczas rejestracji użytkownika: " . $conn->error;
        }
    }
}

$conn->close();
?>
