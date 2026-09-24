<?php

use Firebase\JWT\JWT;

class LiveKit
{
    private string $apiKey;
    private string $apiSecret;

    public function __construct()
    {
        $this->apiKey =
            LIVEKIT_API_KEY;

        $this->apiSecret =
            LIVEKIT_API_SECRET;
    }

    public function createToken(string $identity, string $room, bool $canPublish = false, bool $canSubscribe = true): string {

        $now = time();

        $payload = [

            'iss' => $this->apiKey,

            'sub' => $identity,

            'nbf' => $now,

            'exp' => $now + 3600,

            'video' => [

                'roomJoin' => true,

                'room' => $room,

                'canPublish' => $canPublish,

                'canSubscribe' => $canSubscribe,

                'canPublishData' => true
            ]
        ];

        return JWT::encode(
            $payload,
            $this->apiSecret,
            'HS256'
        );
    }
}

$liveKit = new LiveKit();