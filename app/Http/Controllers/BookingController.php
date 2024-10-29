<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class BookingController extends Controller
{
        public function index(): View
        {
            return view('booking', [
                'booking' => Booking::with('user')->latest()->get(),
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
        public function store(Request $request): RedirectResponse
        {
            $validated = $request->validateWithBag('store', [
                'message' => 'required|string|max:255',
            ]);

            $request->user()->booking()->create($validated);

            return redirect(route('booking.index'));
        }

        /**
         * Display the specified resource.
         */
        public function show(Booking $rom)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Booking $rom)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, Booking $rom)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Booking $rom)
        {
            //
        }

    }


