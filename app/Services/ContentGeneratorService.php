<?php

namespace App\Services;

class ContentGeneratorService
{
    protected $aiClientFactory;
    protected $seoService;

    public function __construct(AiClientFactory $aiClientFactory, SEOService $seoService)
    {
        $this->aiClientFactory = $aiClientFactory;
        $this->seoService = $seoService;
    }

    /**
     * Generate 4 blog posts
     */
    public function generatePosts(array $payload)
    {
        $provider = $payload['ai_provider'] ?? 'openai';
        $client = $this->aiClientFactory::create($provider);

        $posts = [];
        for ($i = 0; $i < 4; $i++) {
            $title = "Generated Post Title " . ($i+1);
            $content = "This is the content of post " . ($i+1) . ", based on keywords: " . implode(', ', $payload['keywords'] ?? []);

            $seo = $this->seoService->enrich($content);

            $posts[] = [
                'title' => $title,
                'content' => $content,
                'meta_title' => $seo['meta_title'],
                'meta_description' => $seo['meta_description'],
                'lsi_keywords' => $seo['lsi_keywords'],
                'slug' => strtolower(str_replace(' ', '-', $title)),
                'internal_links' => [],
                'schema' => [
                    '@context' => 'https://schema.org',
                    '@type' => 'Article',
                    'headline' => $title,
                    'articleBody' => $content,
                ],
                'job_id' => $payload['job_id'] ?? null,
            ];
        }

        return $posts;
    }
}
