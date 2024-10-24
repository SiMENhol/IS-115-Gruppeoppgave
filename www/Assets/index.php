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
include('../Include/header.php');
include('../Include/footer.php');
include('../Include/dbconnection.php');

?>

<form method="post">
    <label>Search</label>
   <!-- <input type="text" name="search"> -->

    <label for="cars">Velg romtype:</label>

<select name="cars" id="cars" multiple>
  <option value="Dobbeltrom">Dobbeltrom</option>
  <option value="Enkeltrom">Enkeltrom</option>
</select>
<input type="submit" name="submit">
</form>
<?php 
if (isset($_POST["submit"])) {
    $str = $_POST["cars"]; // Get the selected value from the dropdown
    
    // Prepare statement to join hotellrom and reservasjon on RoomID
    $sth = $conn->prepare("
        SELECT hotellrom.*, reservasjon.CheckOutDato
        FROM hotellrom
        LEFT JOIN reservasjon ON hotellrom.Id = reservasjon.RomId
        WHERE TypeRom = ?
        ORDER BY RomStatus ASC
    ");
    $sth->bind_param("s", $str);
    
    // Execute query
    $sth->execute();
    
    // Get result
    $result = $sth->get_result();
    
    // Initialize arrays to categorize rooms
    $available_rooms = [];
    $booked_rooms = [];
    
    // Fetch and categorize results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_object()) {
            if ($row->RomStatus == 0) {
                $available_rooms[] = $row;  // Available rooms
            } else {
                $booked_rooms[] = $row;     // Booked rooms
            }
        }
        
        // Display available rooms first
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

        // Display booked rooms under separate heading
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