<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class WhatAppMessageService
{
    public static function sendReferralMessage($referral_request)
    {
        if ($referral_request['phone']) {
            $url = 'https://messages-sandbox.nexmo.com/v0.1/messages';
            $params = ['to' => ['type' => 'whatsapp', 'number' => $referral_request['phone']],
                'from' => ['type' => 'whatsapp', 'number' => env('VONAGE_PHONE_NO')],
                'message' => [
                    'content' => [
                        'type' => 'text',
                        'text' => $referral_request['body'].' please visit this link to view more info about it '.$referral_request['actionURL'],
                    ],
                ],
            ];
            $headers = ['Authorization' => 'Basic '.base64_encode(env('VONAGE_KEY').':'.env('VONAGE_SECRET'))];
            $client = new \GuzzleHttp\Client(['base_uri' => $url, 'verify' => false]);
            try {
                $response = $client->request('POST', $url, ['headers' => $headers, 'json' => $params]);
                $data = $response->getBody();
                Log::Info($data);

                return $data;
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                return $e->getResponse()->getBody()->getContents();
            }
        }
    }
}
