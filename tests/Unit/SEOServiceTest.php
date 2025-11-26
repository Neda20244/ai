<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\SEOService;
use Mockery;

class SEOServiceTest extends TestCase
{
    public function test_enrich_returns_expected_structure()
    {
        $text = "This is a sample text to generate SEO metadata.";

 
        $mockClient = Mockery::mock();
        $mockResponse = (object)[
            'output_text' => json_encode([
                'meta_title' => 'Generated Meta Title',
                'meta_description' => 'Generated Meta Description',
                'lsi_keywords' => ['k1','k2','k3','k4','k5']
            ])
        ];

  
        $mockClient->shouldReceive('responses->create')
                   ->once()
                   ->andReturn($mockResponse);

  
        $seoService = new SEOService($mockClient);
        $result = $seoService->enrich($text);


        $this->assertArrayHasKey('meta_title', $result);
        $this->assertArrayHasKey('meta_description', $result);
        $this->assertArrayHasKey('lsi_keywords', $result);
        $this->assertEquals('Generated Meta Title', $result['meta_title']);
        $this->assertEquals('Generated Meta Description', $result['meta_description']);
        $this->assertCount(5, $result['lsi_keywords']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
