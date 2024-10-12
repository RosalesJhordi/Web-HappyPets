<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ChatBot extends Component
{
    public $message = '';
    public $responses = [];
    public function sendMessage()
    {
        $apiKey = 'AIzaSyDgUOMF0EltOBBnxtFl2ew6cvPQJyEkfZI';
        $response = Http::withOptions([
            'verify' => false,
            'timeout' => 60,
        ])->withHeaders([
            'Content-Type' => 'application/json'
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key={$apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $this->message]
                    ]
                ]
            ]
        ]);

        // Procesar la respuesta
        if ($response->successful()) {
            $reply = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'No response';
            $reply = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $reply);

            $reply = preg_replace('/^\s*\*\s*/m', '• ', $reply);
            $reply = preg_replace('/^\*+\s*/m', '', $reply);
            $reply = preg_replace('/^```(.*?)```$/ms', '<code>$1</code>', $reply);
            $this->responses[] = ['message' => $this->message, 'reply' => $reply];

            $this->message = '';
        } else {
            $this->responses[] = ['message' => $this->message, 'reply' => 'Error al obtener la respuesta.'];
        }
    }
    public function render()
    {
        return view('livewire.chat-bot');
    }
}
