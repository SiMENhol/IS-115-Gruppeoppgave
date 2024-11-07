<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
    <h1 style="color: white">User List</h1>
    <table  style="color: black">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Antall senger</th>
                <th>Status</th>
                <th>Beskrivelse</th>
                <th>Pris</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->roomId }}</td>
                    <td>{{ $room->roomType }}</td>
                    <td>{{ $room->places }}</td>
                    <td>{{ $room->roomStatus }}</td>
                    <td>{{ $room->roomDesc }}</td>
                    <td>{{ $room->price }}</td>
                    <td><a href="{{ route('room.edit', ['roomId' => $room->roomId]) }}">Edit</a></td>

                </tr>
            @endforeach
        </tbody>
    </table> <a href='room/create'>Add a new room </a>
                </div></div></div></div>

    </x-app-layout>

