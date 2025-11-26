<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\ContentGeneratorService;
use App\Services\SEOService;
use App\Services\AiClientFactory;
use Mockery;

class ContentGeneratorServiceTest extends TestCase
{
    public function test_generate_posts_returns_4_items()
    {
      
        $mockClient = Mockery::mock();
        $mockClient->shouldReceive('responses->create')
                   ->andReturn((object)[
                       'output_text' => json_encode([
                           'meta_title' => 'Generated Meta Title',
                           'meta_description' => 'Generated Meta Description',
                           'lsi_keywords' => ['k1','k2','k3','k4','k5']
                       ])
                   ]);

        
        $seoService = new SEOService($mockClient);

       
        $service = new ContentGeneratorService(new AiClientFactory(), $seoService);

        $payload = [
            'keywords' => ['tourism', 'hotel', 'travel'],
            'ai_provider' => 'openai',
            'job_id' => 'job_test_123'
        ];

        
        $posts = $service->generatePosts($payload);

       
        $this->assertCount(4, $posts);

        foreach ($posts as $post) {
            $this->assertArrayHasKey('title', $post);
            $this->assertArrayHasKey('content', $post);
            $this->assertArrayHasKey('meta_title', $post);
            $this->assertArrayHasKey('meta_description', $post);
            $this->assertArrayHasKey('lsi_keywords', $post);
            $this->assertArrayHasKey('slug', $post);
            $this->assertArrayHasKey('job_id', $post);
        }
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
