<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela do modyfikacji</title>
</head>
<body>
<?php
        require_once($_SERVER['DOCUMENT_ROOT']. '/hotel_app/login.html');
        require_once($_SERVER['DOCUMENT_ROOT']. '/hotel_app/function.php');

        if (isset($_POST['submit']))
            Generate();
?>
</body>
</html>