<?php

namespace App\Http\Controllers;

use App\Models\Quiz;

class DashboardController extends Controller
{
    public function view()
    {
        $numbers = [
            'quizzes' => Quiz::where('user_id', auth()->id())->count(),
            'answered' => 0,
        ];

        return view('dashboard.view', compact('numbers'));
    }
}
