<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OpenAIController extends Controller
{
    public function sendMessage(Request $request)
    {
        $apiKey = env('OPENAI_API_KEY'); // Get the API key from .env file

        // Call OpenAI API
        $response = $this->callOpenAI($request->message, $apiKey);

        // Log the response for debugging
        Log::info('OpenAI API Response:', $response);

        // Check if response is valid
        if (isset($response['choices'][0]['message']['content'])) {
            return response()->json($response);
        }

        return response()->json(['error' => 'Failed to get response from OpenAI'], 500);
    }

    private function callOpenAI($message, $apiKey)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiKey
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'model' => 'gpt-3.5-turbo',
            'messages' => [['role' => 'user', 'content' => $message]],
            'max_tokens' => 150
        ]));

        $response = curl_exec($ch);

        // Check for cURL errors
        if(curl_errno($ch)) {
            Log::error('cURL Error: ' . curl_error($ch)); // Log cURL errors
        }

        curl_close($ch);

        return json_decode($response, true);
    }
}
