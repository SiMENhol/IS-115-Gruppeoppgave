<style>
    table, th, td {
        color: black;
        border: 1px solid black;
        border-collapse: collapse;
        padding: 10px;
    }
</style>

<?php
    $romTyper = [];
?>

<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            <div class="p-6 flex space-x-2">
                <div class="flex-1">
                    <table>
                        <thead>
                            <tr>
                                <th>Bilde</th>
                                <th>Type</th>
                                <th>Beskrivelse</th>
                                <th>Antall senger</th>
                                <th>Pris</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $room)
                                <?php
                                    if (!array_key_exists($room->roomType, $romTyper)) {
                                        $romTyper[$room->roomType] = true;
                                        echo "<tr>";
                                        echo "<td><img src='https://sonspa.no/wp-content/uploads/2018/05/Enkeltrom-scaled.jpg'></td>";
                                        echo "<td style='white-space: nowrap;'>$room->roomType</td>";
                                        echo "<td>$room->roomDesc</td>";
                                        echo "<td style='white-space: nowrap;'>$room->places</td>";
                                        echo "<td style='white-space: nowrap;'>$room->price</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
