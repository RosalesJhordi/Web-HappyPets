<?php

namespace App\Livewire;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ChatBot extends Component
{
    public $messages = [];

    public $url;

    public $nombres;

    public $text = '';

    public $responseText;

    public $microfono = false;

    public $sonido = false;

    public $audioBase64; // Variable para recibir el audio en Base64

    public $temporaryAudioPath;

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->cargarDatosUsuario();
    }

    public $transcribedText = '';

    public function updateTranscription($text)
    {
        $this->transcribedText = $text;
        $this->text = $this->transcribedText;
        if (! empty($this->text)) {
            $this->sendMessage();
        }
    }

    public function iniciarGrabacion()
    {
        $mensaje = 'Hable ahora...';
        $audioBot = $this->convertToSpeech($mensaje);
        $this->messages[] = [
            'sender' => 'system',
            'text' => $mensaje,
            'audio' => $audioBot,
            'time' => now()->format('h:i A'),
        ];
    }

    public function detenerGrabacion()
    {
        // Decodificar el audio desde Base64 y guardarlo como un archivo temporal
        $audioContent = base64_decode($this->audioBase64);
        $this->temporaryAudioPath = storage_path('framework/cache/audio_'.uniqid().'.wav');
        File::put($this->temporaryAudioPath, $audioContent);

        // Convertir audio a texto
        $transcribedText = $this->convertirAudioATexto($this->temporaryAudioPath);

        if ($transcribedText) {
            $this->messages[] = [
                'sender' => 'user',
                'text' => $transcribedText,
                'time' => now()->format('h:i A'),
            ];

            // Generar respuesta y reproducirla
            $response = $this->generateResponse($transcribedText);
            $audioResponse = $this->convertToSpeech($response);

            $this->messages[] = [
                'sender' => 'system',
                'text' => $response,
                'audio' => $audioResponse,
                'time' => now()->format('h:i A'),
            ];
        } else {
            $this->messages[] = [
                'sender' => 'system',
                'text' => 'No se pudo procesar el audio.',
                'time' => now()->format('h:i A'),
            ];
        }

        // Eliminar archivo temporal
        File::delete($this->temporaryAudioPath);
    }

    public function sendMessage()
    {
        if (empty($this->text)) {
            return;
        }
        $message = $this->text;
        $currentTime = now()->format('h:i A');
        $this->messages[] = [
            'sender' => 'user',
            'text' => $message,
            'time' => $currentTime,
        ];

        $this->responseText = $this->processMessage($this->text);

        $responseMessage = [
            'sender' => 'system',
            'text' => $this->responseText,
            'time' => $currentTime,
        ];

        if ($this->sonido) {
            $audioBase64 = $this->convertToSpeech($this->responseText);
            $responseMessage['audio'] = $audioBase64;
        }

        $this->messages[] = $responseMessage;

        if ($this->responseText === 'Redirigiendo a la sección de productos.') {
            $this->text = '';
            $this->dispatch('redirect');
        }

        $this->text = '';
    }

    public function redirectToProducts($goo)
    {
        return redirect()->route('Productos');
    }

    public function processMessage($message)
    {
        $synonyms = [
            'saludos' => [
                'keywords' => ['hola', 'buenas', 'qué tal', 'saludos'],
                'response' => '¡Hola! Bienvenido a nuestra clínica veterinaria HappyPets. ¿En qué puedo ayudarte? ',
            ],
            'despedida' => [
                'keywords' => ['adiós', 'chau', 'nos vemos', 'hasta luego', 'bye', 'adios'],
                'response' => '¡Hasta luego! Gracias por confiar en nosotros. ',
            ],
            'agradecimiento' => [
                'keywords' => ['gracias', 'agradecido', 'mil gracias', 'muchas gracias', 'te lo agradezco'],
                'response' => '¡De nada! Estamos aquí para ayudarte. ',
            ],
            'citas' => [
                'keywords' => ['cita', 'reservar', 'agenda', 'turno', 'consultar disponibilidad'],
                'response' => 'Claro, ¿para qué día y hora te gustaría agendar tu cita? ',
            ],
            'horarios' => [
                'keywords' => ['horario', 'a qué hora abren', 'cuándo están abiertos', 'horas de atención'],
                'response' => 'Nuestros horarios de atención son de lunes a sábado, de 8:00 AM a 6:00 PM. ¿Te interesa agendar una cita? ',
            ],
            'emergencias' => [
                'keywords' => ['emergencia', 'urgente', 'urgencia', 'emergencias', 'urgencias'],
                'response' => 'Para emergencias, por favor llama directamente al número de contacto de emergencia: 987-654-321. ',
            ],
            'servicios' => [
                'keywords' => ['servicios', 'qué ofrecen', 'qué hacen', 'tratamientos', 'vacunas'],
                'response' => 'Ofrecemos consultas, vacunación, desparasitación, cirugía, estética y más. ¿Quieres más información sobre algún servicio en particular? ',
            ],
            'ubicación' => [
                'keywords' => ['dónde están', 'ubicación', 'dirección', 'cómo llegar'],
                'response' => 'Estamos ubicados en la Av. Principal 123, cerca del parque central. ¿Te gustaría agendar una cita? ',
            ],
            'vacunación' => [
                'keywords' => ['vacunas', 'vacunación', 'vacunar', 'vacunas para perros', 'vacunas para gatos'],
                'response' => 'Ofrecemos un esquema completo de vacunación para perros y gatos. ¿Te gustaría agendar una cita para vacunación? ',
            ],
            'esterilización' => [
                'keywords' => ['esterilización', 'castración', 'operación para mi mascota'],
                'response' => 'La esterilización es un procedimiento seguro que ayuda a prevenir enfermedades y controlar la población. ¿Quieres más información o agendar una cita? ✂️',
            ],
            'alimentación' => [
                'keywords' => ['alimentación', 'qué debe comer', 'comida para perros', 'comida para gatos', 'recomendación de alimento'],
                'response' => 'Podemos recomendarte la dieta adecuada para tu mascota según su edad, raza y necesidades. ¿Quieres más detalles? ',
            ],
            'baño' => [
                'keywords' => ['baño', 'estética', 'corte de pelo', 'arreglo', 'limpieza'],
                'response' => 'Ofrecemos servicios de baño, corte de pelo y estética para tu mascota. ¿Te interesa agendar un turno?',
            ],
            'vacaciones' => [
                'keywords' => ['dejar mi mascota', 'vacaciones', 'hotel para mascotas', 'dónde dejo a mi mascota'],
                'response' => 'Ofrecemos servicio de hospedaje para mascotas durante tus vacaciones. ¿Te gustaría más información? ',
            ],
            'adopción' => [
                'keywords' => ['adopción', 'adoptar', 'mascotas en adopción'],
                'response' => 'Contamos con un programa de adopción para dar hogar a mascotas que lo necesitan. ¿Quieres saber más? ',
            ],
            'contacto' => [
                'keywords' => ['teléfono', 'número', 'contacto', 'cómo los llamo'],
                'response' => 'Puedes contactarnos al 123-456-789 o escribirnos por WhatsApp al mismo número.',
            ],
            'productos' => [
                'keywords' => ['sección de productos', 'productos', 'ver productos', 'catalogo', 'quién ofrece productos'],
                'response' => 'Redirigiendo a la sección de productos.',
            ],
        ];

        foreach ($synonyms as $category => $data) {
            foreach ($data['keywords'] as $keyword) {
                if (stripos($message, $keyword) !== false) {
                    return $data['response'];
                }
            }
        }

        return 'Lo siento, no entiendo tu mensaje. ¿Puedes reformularlo?';
    }

    public function cargarDatosUsuario()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url.'/Datos');

        if ($response->successful()) {
            $data = $response->json();
            $this->nombres = $data['usuarios']['nombres'];
        }
    }

    public function generateResponse($userMessage)
    {
        return "Hola, entendí tu mensaje: \"$userMessage\". ¿En qué más puedo ayudarte?";
    }

    public function convertToSpeech()
    {
        $apiKey = 'AIzaSyDybSIJGsLjaLVvXwkYs4EWYfYQRKSlro0';

        $endpoint = 'https://texttospeech.googleapis.com/v1/text:synthesize';
        $payload = [
            'input' => ['text' => $this->responseText],
            'voice' => [
                'languageCode' => 'es-PE',
                'ssmlGender' => 'FEMALE',
            ],
            'audioConfig' => ['audioEncoding' => 'MP3'],
        ];

        $response = Http::withOptions(['verify' => false])
            ->post("{$endpoint}?key={$apiKey}", $payload);

        if ($response->successful()) {
            return $response->json()['audioContent'];
        }

        return null;
    }

    public function render()
    {
        return view('livewire.chat-bot');
    }
}
