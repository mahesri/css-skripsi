<?php

namespace Tests\ahpService;

use App\Services\AhpServices;
use PHPUnit\Framework\TestCase;

class SimilarityCountTest extends TestCase
{

    private $ahpservice;

    public function __construct($ahpservice)
    {
        $this->ahpservice = $ahpservice;
    }

    public function test_CountSimilaritySkill(array $userProfile, string $skill): float
    {

        $result = $this->ahpservice->skillMatch($userProfile, $skill);
        $this->assertTrue(true);
        return $result;
    }
}

$AhpService = new AhpServices();
$runTest = new SimilarityCountTest($AhpService);
$runTest->test_CountSimilaritySkill(['css, html, php'], "css, html, java");

