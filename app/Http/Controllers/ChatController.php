<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Chat::all(); // or Chat::latest()->get();
        return view('chats.chat', compact('messages'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $userMessage = $request->message;

        // Save user message
        Chat::create([
            'sender' => 'user',
            'message' => $userMessage,
        ]);

        // Call OpenAI API
        try {
            $apiResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                    ['role' => 'user', 'content' => $userMessage],
                ],
                'temperature' => 0.7,
                'max_tokens' => 150,
            ]);

            if ($apiResponse->successful()) {
                $botReply = $apiResponse['choices'][0]['message']['content'] ?? "I couldn't understand that.";
            } else {
                Log::error('OpenAI API error', [
                    'status' => $apiResponse->status(),
                    'body' => $apiResponse->body(),
                ]);
                $botReply = "Sorry, something went wrong.";
            }
        } catch (\Exception $e) {
            Log::error('OpenAI API exception: ' . $e->getMessage());
            $botReply = "Sorry, something went wrong.";
        }

        // Save bot reply
        Chat::create([
            'sender' => 'bot',
            'message' => $botReply,
        ]);

        return response()->json(['reply' => $botReply]);
    }
}
