<!DOCTYPE html>
<html>
<head>
    <title>Moje rezerwacje</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="login-bar">
        <a href="front.html">Zarezerwuj pokoj</a>
        <a href="login.html">Wyloguj</a>
    </div>
    <div class="container2">
        <div class="image-container">
            <img src="trolley.png" alt="Obrazek">
        </div>
        <div class="form-container2">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Imię i nazwisko</th>
                    <th>Data przyjazdu</th>
                    <th>Data wyjazdu</th>
                    <th>Liczba dorosłych</th>
                    <th>Liczba dzieci</th>
                    <th>Rodzaj pokoju</th>
                    <th>Uwagi</th>
                    <th>Data rezerwacji</th>
                </tr>
                <!-- Tutaj będzie załączany plik PHP -->
                <?php include 'my_reservations_data.php'; ?>
            </table>
        </div>
    </div>
</body>
</html>
