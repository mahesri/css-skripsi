<?php

namespace Tests\ahpServices;

use App\Services\Logging;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertIsArray;

class AhpServiceTest extends TestCase
{
    private Logging $ahpService;

    protected function setUp(): void
    {
        $this->ahpService = new Logging();
    }

    public function test_CountSimilaritySkill(): void
    {
        $skillsProfile = ['css', 'php', 'html'];
        $altSkills = 'css, php, javascript';

        $result = $this->ahpService->skillMatch($skillsProfile, $altSkills);
        $this->assertIsFloat($result);
        var_dump($result);
    }

    public function test_experienceScore()
    {

        $profileExperience = 3;
        $altExperienceRequired = 1;

        $result = $this->ahpService->experienceScore($profileExperience, $altExperienceRequired);
        $this->assertIsFloat($result);
    }


    #[DataProvider('rawDataSource')]
    public function test_normalize(array $raw): void
    {
        $result = $this->ahpService->normalize($raw);
        $this->assertIsArray($result);
    }

    public static function rawDataSource(): array
    {

        return array([
            ['Software Developer' => [
                'skill' => 0.5,
                'experience' => 1.0,
                'demand' => 234,
                'salary' => 30000000
            ]],
            ['Frontend Developer' => [
                'skill' => 4 / 14,
                'experience' => 1.0,
                'demand' => 1342,
                'salary' => 14500000
            ]]
        ]);
    }

    public static function test_AsInputUserProfile(): array
    {

        self::assertTrue(true);
        $profile = [

            'user_skills' => 'capcut, html, css, git,  Canva, Premiere Pro, Story Telling, SEO,  After Effects, PHP, Mysql, laravel, Linux, HTML, CSS, Corel Draw, Social Media, Creativity, Visual Story, communication, database, content creation, sql, seo',
            'experience' => 5
        ];

        return [
            'skills' => array_map('trim', explode(',', $profile['user_skills'])),
            'years_experience' => $profile['experience']
        ];
    }

    #[Depends('test_AsInputUserProfile')]
//    #[DataProvider('altRole')]
    public function test_calculate(
        array $userProfile,
        // array $altRole
    ): void
    {

        $altRole = $this->altRole();
        $AhpScore = $this->ahpService->calculate($userProfile, $altRole);
        assertIsArray($AhpScore);
    }

    private function altRole(): array
    {

        return array(
            [
                'role_name' => "Staff it support",
                'skills' => "networking,computer hardware,windows os,printer troubleshooting,installation",
                'avg_salary_idr' => 3250000,
                'vacancy_count' => 1100,
                'experience_required' => 1,
                'source' => "JobStreet Indonesia, Desember 2025 (diambil manual)"
            ],
            [
                'role_name' => "Content Creator",
                'skills' => "capcut, canva, creativity,storytelling,social media strategy,seo,content creation,editing tools,time management",
                'avg_salary_idr' => 5000000,
                'vacancy_count' => 1201,
                'experience_required' => 0,
                'source' => "JobStreet Indonesia, Desember 2025 (diambil manual)"
            ]
        );
    }
}
