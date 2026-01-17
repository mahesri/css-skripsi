<?php

namespace App\Services;

use App\Models\Role;

class AhpServices
{

private function getCriteriaWeights(): array
{
    $matrix =   [ [1, 3,  5,  7],
                [1/3,   1,  3,  5],
                [1/5,   1/3,    1,  3],
                [1/7,   1/5,    1/3,    1]];

    $colSums = [0,0,0,0];
    foreach ($matrix as $row) {
        foreach ($row as $j => $val) {
            $colSums[$j] += $val; }}

    $normalized = [];
    foreach ($matrix as $i => $row) {
        foreach ($row as $j => $val) {
            $normalized[$i][$j] = $val / $colSums[$j]; }}

    $priority = [];
    foreach ($normalized as $row) {
        $priority[] = array_sum($row) / count($row);
    }

return [    'skill' => $priority[0],
            'experience' => $priority[1],
            'demand' => $priority[2],
            'salary' => $priority[3], ];}

private array $criteriaWeights = [
'skill' => 0.40,
'experience' => 0.20,
'demand' => 0.10,
'salary' => 0.05,
];

    public function calculate(array $userProfile): array {
        $roles = Role::all();
        $raw = [];
        foreach($roles as $role) {
            $raw[$role->role_name] = [
                'skill'         => $this->skillMatch($userProfile['skills'], $role->skills),
                'experience'    => $this->experienceScore($userProfile['years_experience'], $role->experience_required),
                'demand'        => $role->vacancy_count ?? 0,
                'salary'        => $role->avg_salary_idr ?? 0,
            ];
        }

        $normalized = $this->normalize($raw);

        // Hitung skor AHP

        $scores = [];
        foreach($normalized as $role => $values) {
            $score = 0;

            foreach($this->getCriteriaWeights() as $criteria => $weight) {

                $score += $values[$criteria] * $weight;
            }
            $scores[$role] = round($score, 4);
        }

        return $scores;

    }

    private function skillMatch(array $userSkills, string $roleSkills): float
    {
        $user = array_map('trim', array_map('strtolower', $userSkills));
        $role = array_map('trim', explode(',', strtolower($roleSkills)));
        $intersection = count(array_intersect($user, $role));
        return count($role) === 0 ? 0 : $intersection / count($role);
    }

    private function normalize(array $data): array
    {
        $max = [];
        foreach($data as $values) {
            foreach($values as $k => $v){
                $max[$k] = max($max[$k] ?? 0, $v);
            }
        }

        foreach ($data as $role => $values) {

            foreach ($values as $k => $v) {

                $data[$role][$k] = $max[$k] == 0 ? 0 : $v / $max[$k];
            }
        }


        return $data;
    }

    private function experienceScore(int $userExp, int $required): float
    {
        if ($required == 0) return 1;
        return min(1, $userExp / $required);
    }
}
