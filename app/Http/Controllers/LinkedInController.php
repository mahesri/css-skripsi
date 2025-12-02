<?php

namespace App\Http\Controllers;

use App\Services\CareerRecommendationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Laravel\Socialite\Facades\Socialite;

class LinkedInController extends Controller
{

    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin-openid')->redirect();
    }

    public function handleLinkedInCallback(\App\Services\CareerRecommendationService $careerServices)
    {
        try {
            $linkedinUser = Socialite::driver('linkedin-openid')->stateless()->user();

            $userProfile = [
                'id' => $linkedinUser->getId(),
                'name' => $linkedinUser->getName(),
                'email' => $linkedinUser->getEmail(),
                'avatar' => $linkedinUser->getAvatar(),

                'skills' => ['Accounting', 'Excel', 'Tax'],
                'years_experience' => 3,
                'education' => 'S1 Akuntansi',
                ];

                $userName = $linkedinUser->getName();
                return view('profile.setup', compact('userName'));

            $recommendations = $careerServices->recommend($userProfile);

//            return response()->json([
//                'linkedin_user' => $userProfile,
//                'recommendations' => $recommendations
//            ]);

        }catch (\Exception $e) {
            dd([
                  'error' => $e->getMessage(),
                  'file' => $e->getFile(),
                  'line' => $e->getLine(),
                  'trace' => $e->getTraceAsString()
                ]
            );
        }
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
        return view('profile.result', compact('userProfile', 'recommendations'));

    }
}
