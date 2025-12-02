<?php

namespace App\Http\Controllers;

use App\Services\CareerRecommendationService;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function create(Request $request)
    {
        $linkedinUser = session('linkedin_user');

        return view('profile.setup', compact('linkedinUser'));
    }

    public function store(Request $request, CareerRecommendationService $careerService)
    {
        $validated = $request->validate([
            'skills' => 'required|string',
            'years_experience' => 'required|integer|min:0',
            'preference' => 'nullable|string'
        ]);

        $userProfile = [
            'skills' => array_map('trim', explode(',', $validated['skills'])),
            'years_experience' => $validated['years_experience'],
            'preference' => $validated['preference'] ?? null,
        ];

        $recommendations = $careerService->recommend($userProfile);

//        return view('profile.result', compact('userProfile', 'recommendations'));

       return $this->result($recommendations);

    }

    public function result(array $data) {

        $data = $data;

        return view('profile.result', compact('data'));
        dd($recommendationCarer);
    }
}
