<?php

namespace App\Services;

class CareerRecommendationService
{
    private $ahpWeights;
    private $userPreferenceWeight = 0.25;
    private $ahpWeightPortion = 0.75;

    public function __construct(array $ahpScores)
    {

        $this->ahpWeights = $ahpScores;
    }
    /**
     *  $preferredRole adalah parameter 'role' yang dipilih user (Sebagai contoh 'Backend Enginner')
     *  Pengembalian: array role dengan skor final
     */

    public function calculateFinalScore($preferredRole) {
        $results = [];

        foreach ($this->ahpWeights as $role => $ahpScore) {

            $userPrefScore = ($preferredRole === $role) ? 1 : 0;

            $finalScore =
                ($ahpScore * $this->ahpWeightPortion ) +
                ($userPrefScore * $this->userPreferenceWeight);

            $results[$role] = $finalScore;
        }
        arsort($results);

        return $results;
    }
}
