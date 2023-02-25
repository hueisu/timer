<?php

namespace App\Http\Controllers;

use App\Models\TimerRecords;
use App\Models\UserTags;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'user_id' => Auth::user()->id,
            'user_tag_id' => $input['tag_id'],
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
        $user = Auth::user();

        $userRecords = $user->timerRecords;
        $userTags = $user->userTags->unique('tag_name')->values();

        return response()->json([
            'records' => $userRecords,
            'tags' => $userTags,
        ]);
    }
}
