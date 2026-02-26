<?php

namespace CareerRecommendation;

use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;
use App\Services\CareerRecommendationService;
use function PHPUnit\Framework\assertIsArray;

class CareerRecommendationTest extends TestCase
{

    // 'Test With' is a data source which in this scenario
    // Represent a datasource from input or other resource
    #[TestWith(
        [ [
            "Staff it support" => 0.2276,
            "Backend Developer" => 0.4172,
            "Frontend Developer" => 0.4791,
            "Data Analyst" => 0.328,
            "UI UX Designer" => 0.2343,
            "Network Engineer" => 0.2521,
            "Mobile Developer" => 0.3814,
            "Full Stack Developer" => 0.3633,
            "Digital Marketing" => 0.6804,
            "Cloud Engineer" => 0.3305,
            "Accountant" => 0.3361,
            "Content Creator" => 0.6354,
            "Video Editor" => 0.499,
            "Graphic Designer" => 0.4967], 'Video Editor'
        ]
    )]
    public function testRecommendationCareer_success(array $ahpScore, string $preferred_role)
    {
        $service = new CareerRecommendationService($ahpScore);
        $result = $service->calculateFinalScore($preferred_role);
        self::assertIsArray($result);
    }


    // Below test is to determine whether if scenario would return an exception.
    // If a scenario would thrown an exception. in unit test we can use
    // 'expectException(Exception::class)'
    #[TestWith(
        [ [
            "Staff it support" => 0.2276,
            "Backend Developer" => 0.4172,
            "Frontend Developer" => 0.4791,
            "Data Analyst" => 0.328,
            "UI UX Designer" => 0.2343,
            "Network Engineer" => 0.2521,
            "Mobile Developer" => 0.3814,
            "Full Stack Developer" => 0.3633,
            "Digital Marketing" => 0.6804,
            "Cloud Engineer" => 0.3305,
            "Accountant" => 0.3361,
            "Content Creator" => 0.6354,
            "Video Editor" => 0.499,
            "Graphic Designer" => 0.4967], 'Video Editor'
        ]
    )]
    public function testRecommendationCareer_withException(array $ahpScore, string $preferred_role)
    {
        $service = new CareerRecommendationService($ahpScore);
        $this->expectException(\Exception::class);
        $result = $service->calculateFinalScore($preferred_role);
    }
}
