<?php

namespace App\Services;

class CareerRecommendationService
{
    private $ahpWeights;
    private $userPreferenceWeight = 0.25;
    private $ahpWeightPortion = 0.75;

    public function __construct(array $ahpScores){
        $this->ahpWeights = $ahpScores;
    }

    public function calculateFinalScore($preferredRole) {
        $results = [];
        foreach ($this->ahpWeights as $role => $ahpScore) {

            if ($userPrefScore = ($preferredRole === $role) ? 1 : 0){
                throw new \Exception('It is True ');
            }


            $finalScore =
                ($ahpScore * $this->ahpWeightPortion ) +
                ($userPrefScore * $this->userPreferenceWeight);

            $results[$role] = $finalScore;
        }
        arsort($results);

        return $results;
    }
}
