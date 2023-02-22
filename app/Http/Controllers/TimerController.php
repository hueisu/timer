<?php

namespace App\Http\Controllers;

use App\Models\TimerRecords;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TimerController extends Controller
{
    public function show() {
        return Inertia::render('Timer');
    }

    /**
     * Store new timer record
     * 
     * @param Request $request
     * @return Response
     */
    public function saveRecord(Request $request) {
        $input = $request->all();
        $record = [
            'tag_name' => $input['tag_name'],
            'duration' => $input['duration'],
            'description' => $input['description'],
            'start_time' => Carbon::create($input['start_time']),
        ];
        TimerRecords::create($record);

        return response()->json(['message' => 'Timer record created.']);
    }

    /**
     * Get timer records
     * 
     * @return TimerRecords $records
     */
    public function getRecords() {
        $records = TimerRecords::all();

        return response()->json($records);
    }
}
