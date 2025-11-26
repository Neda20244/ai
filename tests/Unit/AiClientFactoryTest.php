<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\AiClientFactory;
use Exception;

class AiClientFactoryTest extends TestCase
{
    public function test_create_returns_openai_client()
    {
        $client = AiClientFactory::create('openai');
        $this->assertInstanceOf(\App\Services\OpenAIClient::class, $client);
    }

    public function test_create_returns_gemini_client()
    {
        $client = AiClientFactory::create('gemini');
        $this->assertInstanceOf(\App\Services\GeminiClient::class, $client);
    }

    public function test_create_returns_claude_client()
    {
        $client = AiClientFactory::create('claude');
        $this->assertInstanceOf(\App\Services\ClaudeClient::class, $client);
    }

    public function test_create_throws_exception_for_invalid_provider()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid AI provider: unknown');
        
        AiClientFactory::create('unknown');
    }
}
