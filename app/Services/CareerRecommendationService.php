<?php

namespace App\Services;

class CareerRecommendationService
{

    private $ahpWeights;
    private $userPreferenceWeight = 0.25; // Determine user preference as much as 25%
    private $ahpWeightPortion = 0.75; // Determine user preference as much as 75%

    public function __construct($ahpWeights)
    {
        $this->ahpWeights = $ahpWeights;
    }
    /**
     *  $preferredRole adalah parameter 'role' yang dipilih user (Sebagai contoh 'Backend Enginner')
     *  Pengembalian: array role dengan skor final
     */

    public function calculateFinalScore($preferredRole) {

        $results = [];

        foreach ($this->ahpWeights as $role => $ahpScore) {

            // 1. buat skor prefrensi user
            $userPrefScore = ($preferredRole === $role) ? 1 : 0; // Cek pilihan role dari user

            // Hitung skor final
            $finalScore =
                ($ahpScore * $this->ahpWeightPortion ) +
                ($userPrefScore * $this->userPreferenceWeight);

            $results[$role] = $finalScore;
        }
        arsort($results);

        return $results;

    }

// The old services
//    protected array $roles;
//    protected array $weights;
//
//    public function __construct()
//    {
//        // Definisi role + skill (nanti bisa dipindah ke DB)
//        $this->roles = [
//            'Accountant' => [
//                'skills' => ['accounting', 'excel', 'tax', 'reporting'],
//                'avg_salary' => 8000000,
//                'demand_index' => 0.6
//            ],
//            'Financial Analyst' => [
//                'skills' => ['financial analysis', 'excel', 'reporting', 'modeling'],
//                'avg_salary' => 10000000,
//                'demand_index' => 0.5
//            ],
//            'Data Analyst' => [
//                'skills' => ['sql', 'excel', 'python', 'reporting', 'visualization'],
//                'avg_salary' => 11000000,
//                'demand_index' => 0.7
//            ],
//            'Bookkeeper' => [
//                'skills' => ['bookkeeping', 'excel', 'accounting'],
//                'avg_salary' => 6000000,
//                'demand_index' => 0.4
//            ],
//        ];
//
//        // Bobot AHP sederhana
//        $this->weights = ['skill'=>0.5, 'experience'=>0.2, 'demand'=>0.2, 'salary'=>0.1];
//    }
//
//    /* ================== PUBLIC API ================== */
//    public function recommend(array $userProfile): array
//    {
//        $results = [];
//        foreach ($this->roles as $roleName => $r) {
//            $results[$roleName] = $this->calculateRoleScore($userProfile, $r);
//        }
//        arsort($results); // sort descending
//        return $results;
//    }
//
//    /* ================== CORE LOGIC ================== */
//    private function calculateRoleScore(array $user, array $role): float
//    {
//        $uSkills = $this->normalizeSkillList($user['skills'] ?? []);
//        $rSkills = $this->normalizeSkillList($role['skills']);
//
//        $skillMatch = $this->jaccardSimilarity($uSkills, $rSkills);
//
//        $expFactor = min(1, ($user['years_experience'] ?? 0) / 10);
//        $salaryFactor = min(1, ($role['avg_salary'] ?? 0) / 20000000);
//        $demand = $role['demand_index'] ?? 0;
//
//        $score = $this->weights['skill'] * $skillMatch
//            + $this->weights['experience'] * $expFactor
//            + $this->weights['demand'] * $demand
//            + $this->weights['salary'] * $salaryFactor;
//
////        return round($score, 3);
//
//        return $score;
//    }
//
//    /* ================== HELPERS ================== */
//    private function normalizeSkillList(array $skills): array
//    {
//        $out = [];
//        foreach ($skills as $s) {
//            $n = $this->normalizeSkill($s);
//            $n = $this->mapSynonyms($n);
//            if ($n !== '') $out[] = $n;
//        }
//        return array_values(array_unique($out));
//    }
//
//    private function normalizeSkill(string $s): string
//    {
//        $s = mb_strtolower($s);
//        $s = preg_replace('/[^a-z0-9\s]+/u', ' ', $s);
//        $s = preg_replace('/\s+/', ' ', trim($s));
//        return $s;
//    }
//
//    private function mapSynonyms(string $skill): string
//    {
//        $map = [
//            'ms excel' => 'excel',
//            'spreadsheets' => 'excel',
//            'financial reporting' => 'reporting',
//            'bookkeeping' => 'accounting',
//        ];
//        return $map[$skill] ?? $skill;
//    }
//
//    private function jaccardSimilarity(array $a, array $b): float
//    {
//        $a = array_unique($a);
//        $b = array_unique($b);
//        $inter = count(array_intersect($a, $b));
//        $union = count(array_unique(array_merge($a, $b)));
//        return $union === 0 ? 0 : $inter / $union;
//    }
}
