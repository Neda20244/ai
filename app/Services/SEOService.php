<?php

namespace App\Services;

class SEOService {

    protected $client;

    
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function enrich(string $text): array
    {
        
        $response = $this->client->responses()->create([
            'model' => 'gpt-4.1-mini',
            'input' => "Generate SEO for the following text: $text
                        Return JSON with keys: meta_title, meta_description, lsi_keywords (5 items)."
        ]);

        $json = json_decode($response->output_text, true);

        return [
            'meta_title' => $json['meta_title'] ?? substr($text, 0, 60),
            'meta_description' => $json['meta_description'] ?? substr($text, 0, 155),
            'lsi_keywords' => $json['lsi_keywords'] ?? ['keyword1','keyword2','keyword3','keyword4','keyword5'],
        ];
    }
}
