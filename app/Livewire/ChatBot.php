<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ChatBot extends Component
{
    public $messages = [];

    public $url;

    public $nombres = 'Usuario';

    public $text = '';

    public $responseText;

    public $microfono = false;

    public $sonido = false;

    public $audioBase64; // Variable para recibir el audio en Base64

    public $temporaryAudioPath;

    public $dataProductos;

    public $dataServicios;

    public function mount()
    {
        $this->messages = [];

        $this->nombres = 'Usuario';

        $this->text = '';

        $this->responseText;

        $this->microfono = false;

        $this->sonido = false;
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->cargarDatosUsuario();
        $this->cargarServicios();
        $this->cargarProductos();
    }

    public function cargarProductos()
    {
        $response = Http::withOptions([
            'verify' => false,
        ])->get($this->url.'/ListarProductos');
        if ($response->successful()) {
            $this->dataProductos = $response->json()['productos'];
        }
    }

    public function cargarServicios()
    {
        $response = Http::withOptions([
            'verify' => false,
        ])->get($this->url.'/ListarServicios');
        if ($response->successful()) {
            $this->dataServicios = $response->json()['servicios'];
        }
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

    public function sendMessage()
{
    if (empty($this->text)) {
        return;
    }

    $message = $this->text;
    $currentTime = now()->format('h:i A');

    // Añade el mensaje del usuario al historial
    $this->messages[] = [
        'sender' => 'user',
        'text' => $message,
        'time' => $currentTime,
    ];

    // Buscar todos los productos coincidentes
    $productosEncontrados = collect($this->dataProductos)->filter(function ($producto) use ($message) {
        return stripos($producto['nm_producto'], $message) !== false;
    });

    if ($productosEncontrados->isNotEmpty()) {
        // Construir la respuesta con todos los productos encontrados
        $this->responseText = "Productos encontrados:\n";
        foreach ($productosEncontrados as $producto) {
            $this->responseText .=
                "- Nombre: {$producto['nm_producto']}\n".
                "  Precio: {$producto['precio']} Soles\n".
                "  Descripción: {$producto['descripcion']}\n\n";
        }
    } elseif (isset($this->dataServicios)) {
        // Si no hay producto, buscar en servicios
        $servicioEncontrado = collect($this->dataServicios)->first(function ($servicio) use ($message) {
            return stripos($servicio['tipo'], $message) !== false;
        });

        if ($servicioEncontrado) {
            $this->responseText = "Servicio encontrado: \n".
                "Tipo: {$servicioEncontrado['tipo']}\n".
                "Descripción: {$servicioEncontrado['descripcion']}";
        } else {
            // Si no se encuentra en productos ni servicios, procesar como mensaje normal
            $this->responseText = $this->processMessage($message);
        }
    } else {
        // Si no se encuentra nada, enviar un mensaje genérico
        $this->responseText = "No se encontraron coincidencias para tu búsqueda.";
    }

    // Preparar el mensaje de respuesta
    $responseMessage = [
        'sender' => 'system',
        'text' => $this->responseText,
        'time' => $currentTime,
    ];

    if ($this->sonido) {
        $audioBase64 = $this->convertToSpeech($this->responseText);
        $responseMessage['audio'] = $audioBase64;
    }

    // Añade el mensaje de respuesta al historial
    $this->messages[] = $responseMessage;

    if ($this->responseText === 'Redirigiendo a la sección de productos.') {
        $this->text = '';
        $this->dispatch('redirect');
    }
    if ($this->responseText === 'Redirigiendo a la sección de servicios.') {
        $this->text = '';
        $this->dispatch('redirectService');
    }

    $this->reset(['text']);
}

    public function redirectToProducts($goo)
    {
        return redirect()->route('Productos');
    }
    public function redirectToServices($goo)
    {
        return redirect()->route('Servicios');
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
                'response' => 'Claro, ofrecemos servicios especializados para tus mascotas, puedes visitar la sección de servicios.',
            ],
            'horarios' => [
                'keywords' => ['horario', 'a qué hora abren', 'cuándo están abiertos', 'horas de atención'],
                'response' => 'Nuestros horarios de atención son de lunes a sábado, de 8:00 AM a 5:00 PM.',
            ],
            'emergencias' => [
                'keywords' => ['emergencia', 'urgente', 'urgencia', 'emergencias', 'urgencias'],
                'response' => 'Para emergencias, por favor llama directamente al número de contacto de emergencia: 987-654-321. ',
            ],
            'ubicación' => [
                'keywords' => ['dónde están', 'ubicacion', 'ubicación', 'dirección', 'cómo llegar'],
                'response' => 'Estamos ubicados en el Jirón Aguilar 649, cerca del parque Santo Domingo - Huánuco.',
            ],
            // 'esterilización' => [
            //     'keywords' => ['esterilización', 'castración', 'operación para mi mascota'],
            //     'response' => 'La esterilización es un procedimiento seguro que ayuda a prevenir enfermedades y controlar la población. ¿Quieres más información o agendar una cita? ✂️',
            // ],
            // 'alimentación' => [
            //     'keywords' => ['alimentación', 'qué debe comer', 'comida para perros', 'comida para gatos', 'recomendación de alimento'],
            //     'response' => 'Podemos recomendarte la dieta adecuada para tu mascota según su edad, raza y necesidades. ¿Quieres más detalles? ',
            // ],
            // 'baño' => [
            //     'keywords' => ['baño', 'estética', 'corte de pelo', 'arreglo', 'limpieza'],
            //     'response' => 'Ofrecemos servicios de baño, corte de pelo y estética para tu mascota. ¿Te interesa agendar un turno?',
            // ],
            'vacaciones' => [
                'keywords' => ['dejar mi mascota', 'vacaciones', 'hotel para mascotas', 'dónde dejo a mi mascota'],
                'response' => 'Ofrecemos servicio de hospedaje para mascotas durante tus vacaciones. ¿Te gustaría más información? ',
            ],
            'adopción' => [
                'keywords' => ['adopción', 'adopcion', 'adoptar', 'mascotas en adopción'],
                'response' => 'Todavía no contamos con este programa',
            ],
            'contacto' => [
                'keywords' => ['teléfono', 'telefono', 'número', 'numero', 'contacto', 'cómo los llamo'],
                'response' => 'Puedes contactarnos al 916-236-760 o escribirnos por WhatsApp al mismo número.',
            ],
            'productos' => [
                'keywords' => ['sección de productos', 'productos', 'ver productos', 'catalogo', 'quién ofrece productos'],
                'response' => 'Redirigiendo a la sección de productos.',
            ],
            'servicios' => [
                'keywords' => ['sección de servicios', 'servicios', 'ver servicios', 'quién ofrece servicios'],
                'response' => 'Redirigiendo a la sección de servicios.',
            ],
            'pregunta' => [
                'keywords' => ['como me llamo', 'mi nombre', 'di mi nombre'],
                'response' => 'Tu nombre es '.$this->nombres,
            ],
            'bot' => [
                'keywords' => ['como te llamas', 'tu nombre', 'di tu nombre', 'que eres', 'quien eres'],
                'response' => 'Soy HappyBot tu asistente virtual de la clínica veterinaria HappyPets.',
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
