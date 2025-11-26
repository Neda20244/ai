<?php

namespace App\Services;

use Exception;

class AiClientFactory
{
    /**
     * Return AI client instance based on provider name
     */
    public static function create(string $provider)
    {
        switch (strtolower($provider)) {
            case 'openai':
                return new OpenAIClient();
            case 'gemini':
                return new GeminiClient();
            case 'claude':
                return new ClaudeClient();
            default:
                throw new Exception("Invalid AI provider: {$provider}");
        }
    }
}


class OpenAIClient {}
class GeminiClient {}
class ClaudeClient {}
