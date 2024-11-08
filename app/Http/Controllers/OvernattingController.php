<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class OvernattingController extends Controller
{
        public function index(): View
        {
            return view('overnatting', [
                'rooms'=>Room::all(),
            ]);
        }
        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            //
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            //
        }

        /**
         * Display the specified resource.
         */
        public function show(Room $rom)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Room $rom)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, Room $rom)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Room $rom)
        {
            //
        }

    }


