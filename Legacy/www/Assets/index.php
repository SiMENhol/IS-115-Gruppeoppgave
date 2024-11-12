<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotell</title>
    <link rel="stylesheet" href="CSS/styles.css" />
</head>
<body>
<?php
//Inkluderer header, footer og database tilkoblingen
include('../Include/header.php');
include('../Include/footer.php');
include('../Include/dbconnection.php');

?>
<!-- En form for å velge hvilket romtype en ønsker og bruker POST metode for å sende data -->
<form method="post">
    <label>Search</label>
    <label for="room">Velg romtype:</label>
        <select name="room" id="room" multiple>
            <option value="Dobbeltrom">Dobbeltrom</option>
            <option value="Enkeltrom">Enkeltrom</option>
        </select>
        <input type="submit" name="submit">
</form>
<?php

    if (isset($_POST["submit"])) {
        $str = $_POST["room"]; // Henter romtypen og setter den som variabel str

        // SQL kode for å joine hotellrom og reservasjon ved romID
        $sth = $conn->prepare("
            SELECT hotellrom.*, reservasjon.CheckOutDato
            FROM hotellrom
            LEFT JOIN reservasjon ON hotellrom.Id = reservasjon.RomId
            WHERE TypeRom = ?
            ORDER BY RomStatus ASC
        ");
        $sth->bind_param("s", $str);

    // Kjører spørringen
    $sth->execute();

    // Får resultatet
    $result = $sth->get_result();

    // Lager to arrays for å separere ledig fra booka rom
    $available_rooms = [];
    $booked_rooms = [];

    // Henter og kategoriserer resultate
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_object()) {
            if ($row->RomStatus == 0) {
                $available_rooms[] = $row;
            } else {
                $booked_rooms[] = $row;
            }
        }

        // Vise rom som er ledig først
        echo "<h2>Ledige Rom</h2>";
        if (count($available_rooms) > 0) {
            foreach ($available_rooms as $room) {
                echo "Romtype: " . $room->TypeRom . "<br>";
                echo "Pris: " . $room->PrisPrNatt . "<br>";
                echo "Romnummer: " . $room->Id . "<br>";
                echo "<hr>";
            }
        } else {
            echo "Ingen ledige rom funnet.<br>";
        }

        // Viser booka rom under egen heade, viser når de blir ledig
        echo "<h2>Booka Rom</h2>";
        if (count($booked_rooms) > 0) {
            foreach ($booked_rooms as $room) {
                echo "Romtype: " . $room->TypeRom . "<br>";
                echo "Pris: " . $room->PrisPrNatt . "<br>";
                echo "Romnummer: " . $room->Id . "<br>";
                if ($room->CheckOutDato) {
                    echo "Blir ledig på: " . $room->CheckOutDato . "<br>";
                } else {
                    echo "Ingen tilgjengelighetsdato.<br>";
                }
                echo "<hr>";
            }
        } else {
            echo "Ingen booka rom funnet.<br>";
        }
    } else {
        echo "Ingen rom funnet for valgt romtype.";
    }
}
?>

<p>For å sjekke andre tilgjengelige rom <a href='Sites/RoomInformation.php'>klikk her</a></p>
</body>
</html>
