<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;

class JwtController extends Controller
{
    public function generateToken(Request $request)
    {
        $request->validate([
            'playback_id' => 'required|string',
        ]);

        $playbackId = $request->input('playback_id');
        $secretKey = env('MUX_SECRET_KEY');

        if (!$secretKey) {
            return Response::json(['error' => 'MUX_SECRET_KEY is missing'], 500);
        }

        $payload = [
            'sub' => $playbackId,  // Subjek token adalah playback_id
            'exp' => now()->addHour()->timestamp, // Token berlaku selama 1 jam
        ];

        try {
            $token = JWT::encode($payload, $secretKey, 'HS256');
            return Response::json(['token' => $token]);
        } catch (\Exception $e) {
            Log::error("JWT Error: " . $e->getMessage());
            return Response::json(['error' => 'Failed to generate token'], 500);
        }
    }
}
