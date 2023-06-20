<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Foglalás visszaigazolás</title>
</head>
<body>
    <h1>Foglalás visszaigazolása</h1>
    <p>Kedves {{ $reservation->name }},</p>

    <p>Köszönjük a foglalását. Az alábbi részletekkel rögzítettük a foglalását:</p>

    <ul>
        <li>Név: {{ $reservation->first_name }}</li>
        <li>E-mail: {{ $reservation->email }}</li>
        <li>Telefonszám: {{ $reservation->phone_number }}</li>
        <li>Foglalás dátuma: {{ $reservation->res_date }}</li>
        <li>Üzenet: {{ $reservation->messages }}</li>
    </ul>

    <p>További kérdéseivel vagy módosítási igényeivel kapcsolatban kérjük, lépjen velünk kapcsolatba.</p>

    <p>Köszönjük, hogy minket választott!</p>

    <p>Üdvözlettel,<br>Apád</p>
</body>
</html>
