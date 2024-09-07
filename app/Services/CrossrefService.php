<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Article;

class CrossrefService
{
    protected $client;
    protected $apiUrl = 'https://api.crossref.org/deposits';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function assignDoi(Article $article)
    {
        $xml = $this->generateCrossrefXml($article);

        $response = $this->client->post($this->apiUrl, [
            'auth' => [config('services.crossref.username'), config('services.crossref.password')],
            'headers' => ['Content-Type' => 'application/vnd.crossref.deposit+xml'],
            'body' => $xml
        ]);

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            return $data['message']['doi'];
        }

        return null;
    }

    protected function generateCrossrefXml(Article $article)
    {
        // Generate the XML according to Crossref's specifications
        // This is a placeholder and needs to be implemented based on Crossref's requirements
        return '<doi_batch>...</doi_batch>';
    }
}