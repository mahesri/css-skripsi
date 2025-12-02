<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CareerRecommendationService;

class CareerController extends Controller
{

    public function create() {

        return view('profile.setup');
    }
    public function recommend(Request $request, CareerRecommendationService $careerService)
    {
        // contoh profil user (ini nanti ambil dari LinkedIn API via Socialite)
        $userProfile = [
            'skills' => ['Accounting', 'Excel', 'Tax', 'Financial Reporting'],
            'years_experience' => 3,
            'education' => 'S1 Akuntansi',
            'preference' => ['gaji' => 'medium', 'wlb' => 'high'],
        ];

        $results = $careerService->recommend($userProfile);

        return response()->json([
            'recommendations' => $results
        ]);
    }
}
