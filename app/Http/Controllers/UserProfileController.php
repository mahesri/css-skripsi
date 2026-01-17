<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Services\CareerRecommendationService;
use App\Services\AhpServices;
use App\Services\Logging;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UserProfileController extends Controller
{
    public function create(Request $request)
    {
        $linkedinUser = session('userName');
        $roles = Role::all();


        if (session(['userName']) != null){
            $userName = \session(['userName']);
        }else {
            $userName = null;
        }

        return view('profile.setup', compact('linkedinUser', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'skills' => 'required|string',
            'years_experience' => 'required|integer|min:0',
            'preferred_role' => 'nullable|string'
        ]);

        $userProfile = [
            'skills' => array_map('trim', explode(',', $validated['skills'] )),
            'years_experience' => $validated['years_experience'],
        ];

        $ahpService = new AhpServices();
        $ahpScores = $ahpService->calculate($userProfile);

        $careerService = new CareerRecommendationService($ahpScores);
        $finalResults = $careerService->calculateFinalScore(
            $validated['preferred_role'] ?? null
        );

        session(['finalResults' => $finalResults]);

        return redirect()->route('profile.result');
    }

    public function result(Request $request)
    {
        $finalResults = collect(session('finalResults', []));

        $collection = collect($finalResults);

        $perPage = 5;
        $page = request()->get('page', 1);

        $pagedData = $collection->slice(($page - 1) * $perPage, $perPage);

        $finalResultsPaginated = new LengthAwarePaginator($pagedData,
            $collection->count(),
            $perPage,
            $page,
            ['path' => request()->url()]);

        return view('profile.result', compact('finalResultsPaginated'));
    }
}
