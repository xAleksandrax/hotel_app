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

    $login_query = "SELECT * FROM users WHERE username = '$input_username' AND password = '$input_password'";
    $result = $conn->query($login_query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        if ($_SESSION['role'] == 'pracownik') {
            header("Location: all_reservations.php");
        } elseif ($_SESSION['role'] == 'gość') {
            header("Location: front.html");
        }
    } else {
        echo "Błąd logowania: Nieprawidłowa nazwa użytkownika lub hasło.";
    }
}

$conn->close();
?>
