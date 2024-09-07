<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class CopyscapeService
{
    protected $client;
    protected $apiKey;
    protected $apiUrl = 'https://www.copyscape.com/api/';

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.copyscape.key');
    }

    public function checkPlagiarism($text)
    {
        try {
            $response = $this->client->request('POST', $this->apiUrl, [
                'form_params' => [
                    'u' => $this->apiKey,
                    'o' => 'csearch',
                    't' => $text,
                    'e' => 'UTF-8',
                    'f' => 'json',
                ]
            ]);

            $result = json_decode($response->getBody(), true);

            if (isset($result['error'])) {
                Log::error('Copyscape API error: ' . $result['error']);
                return false;
            }

            return [
                'percentPlagiarized' => $result['percentmatched'],
                'matchedWords' => $result['wordsmatched'],
                'totalWords' => $result['wordcount'],
            ];

        } catch (\Exception $e) {
            Log::error('Copyscape API request failed: ' . $e->getMessage());
            return false;
        }
    }
}