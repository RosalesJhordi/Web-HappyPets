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

    public $audioBase64;

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

        $this->messages[] = [
            'sender' => 'user',
            'text' => $message,
            'time' => $currentTime,
        ];

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
            $this->responseText = 'No se encontraron coincidencias para tu búsqueda.';
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

    // Función para eliminar tildes (acentos) de un texto
    public function removeAccents($text)
    {
        $accents = [
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
            'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U',
            'ñ' => 'n', 'Ñ' => 'N',
        ];

        return strtr($text, $accents);
    }

    public function processMessage($message)
    {
        $synonyms = [
            'saludos' => [
                'keywords' => [
                    'hola', 'buenas', 'qué tal', 'saludos', 'hey', 'buenos días', 'buenas tardes', 'buenas noches',
                    'qué pasa', 'cómo estás', 'cómo va todo', 'qué tal todo', 'qué hay', 'saludos cordiales',
                ],
                'response' => '¡Hola! Bienvenido a nuestra clínica veterinaria HappyPets. ¿En qué puedo ayudarte hoy? Estamos aquí para cuidar a tu mascota. ',
            ],
            'despedida' => [
                'keywords' => [
                    'adiós', 'chau', 'nos vemos', 'hasta luego', 'bye', 'adios', 'hasta pronto', 'nos estamos viendo', 'hasta la próxima',
                ],
                'response' => '¡Hasta luego! Gracias por confiar en nosotros. No dudes en contactarnos si necesitas algo más. ',
            ],
            'agradecimiento' => [
                'keywords' => [
                    'gracias', 'agradecido', 'mil gracias', 'muchas gracias', 'te lo agradezco', 'te doy las gracias', 'gracias por todo', 'te agradezco mucho',
                ],
                'response' => '¡De nada! Estamos aquí para ayudarte siempre que lo necesites. No dudes en volver si tienes más preguntas. ',
            ],
            'citas' => [
                'keywords' => [
                    'cita', 'reservar', 'agenda', 'turno', 'consultar disponibilidad', 'agendar', 'hacer una cita', 'reserva de cita', 'programar una cita','como reservo cita','quiero mas informacion de citas','quiero mas informacion de cita','como reservo una cita','informacion de cita', 'informacion cita','dame informacion sobre cita','sobre cita'
                ],
                'response' => 'Claro, ofrecemos servicios especializados para tus mascotas. Puedes visitar la sección de servicios para poder reservar una cita, solo seleciona el servicio el dia y la hora que desea.',
            ],
            'horarios' => [
                'keywords' => [
                    'horario', 'a qué hora abren', 'están atendiendo', 'están atendiendo ahora', 'están atendiendo ahurita', 'están atendiendo ahorita', 'cuándo están abiertos', 'horas de atención', 'cuando abren', 'horarios de apertura', 'hora de apertura', 'horarios de atención','estan disponibles','esta abierto',
                ],
                'response' => 'Nuestros horarios de atención son de lunes a sábado, de 8:00 AM a 5:00 PM. Estamos cerrados los domingos.',
            ],
            'emergencias' => [
                'keywords' => [
                    'emergencia', 'urgente', 'urgencia', 'emergencias', 'urgencias', 'emergencia veterinaria', 'urgencia veterinaria', 'atención urgente', 'atención emergente','ayuda',
                ],
                'response' => 'Para emergencias, por favor llama directamente al número de contacto de emergencia: 987-654-321. Estamos disponibles para ayudarte en cualquier momento.',
            ],
            'ubicación' => [
                'keywords' => [
                    'dónde están', 'ubicacion', 'ubicación', 'dirección', 'cómo llegar', 'donde los encuentro', 'dónde queda', 'cómo llegar hasta allí', 'dónde los encuentro','como los ubico','donde los ubico'
                ],
                'response' => 'Estamos ubicados en el Jirón Aguilar 649, cerca del parque Santo Domingo - Huánuco. Puedes usar Google Maps o la experiencia de Realidad Aumentada para indicaciones precisas.',
            ],
            'adopción' => [
                'keywords' => [
                    'adopción', 'adopcion', 'adoptar', 'mascotas en adopción', 'dar en adopción', 'adoptar una mascota', 'adopción de animales', 'quiero adoptar una mascota',
                ],
                'response' => 'Todavía no contamos con un programa de adopción, pero mantente en contacto para cualquier novedad.',
            ],
            'contacto' => [
                'keywords' => [
                    'teléfono', 'telefono', 'número', 'numero', 'contacto', 'cómo los llamo', 'cómo contactar', 'cómo te llamo','numero de llamada','llamada','como los contacto','informacion de contacto',
                ],
                'response' => 'Puedes contactarnos al 916-236-760 o escribirnos por WhatsApp al mismo número. También puedes enviar un correo a happypets@gmail.com',
            ],
            'productos' => [
                'keywords' => [
                    'sección de productos', 'productos', 'ver productos', 'catalogo', 'quién ofrece productos', 'productos disponibles', 'artículos para mascotas', 'productos para mi mascota','comida para gato','comida para perro',
                ],
                'response' => 'Redirigiendo a la sección de productos. Aquí podrás encontrar todo lo que necesitas para tu mascota.',
            ],
            'servicios' => [
                'keywords' => [
                    'sección de servicios', 'servicios', 'ver servicios', 'quién ofrece servicios', 'servicios disponibles', 'atención veterinaria', 'consultas veterinarias', 'servicios para mascotas',
                ],
                'response' => 'Redirigiendo a la sección de servicios. Aquí podrás conocer todos los servicios que ofrecemos para tu mascota.',
            ],
            'pregunta' => [
                'keywords' => [
                    'como me llamo', 'mi nombre','nombre', 'di mi nombre', 'cómo me llamas', 'cuál es mi nombre', 'qué nombre tengo', 'qué nombre me diste',
                ],
                'response' => 'Tu nombre es '.$this->nombres,
            ],
            'bot' => [
                'keywords' => [
                    'como te llamas', 'tu nombre', 'di tu nombre', 'que eres', 'quien eres', 'quién eres', 'qué eres', 'qué haces aquí',
                ],
                'response' => 'Soy HappyBot, tu asistente virtual de la clínica veterinaria HappyPets. Estoy aquí para ayudarte con todo lo relacionado con tus mascotas.',
            ],
            'fecha' => [
                'keywords' => [
                    'qué día es hoy', 'día de hoy', 'qué fecha es', 'cuál es la fecha', 'qué día es',
                ],
                'response' => 'Hoy es '.now()->format('l, j F Y').'.',
            ],
            'hora' => [
                'keywords' => [
                    'qué hora es', 'cuál es la hora', 'hora actual', 'a qué hora', 'qué hora tienes',
                ],
                'response' => 'La hora actual es '.now()->format('h:i A').'.',
            ],
            'clínica' => [
                'keywords' => [
                    'qué es HappyPets', 'quiénes son', 'qué hacen', 'qué servicios ofrece HappyPets', 'de qué se trata HappyPets', 'quiénes son ustedes', 'qué tipo de clínica es',
                ],
                'response' => 'HappyPets es una clínica veterinaria especializada en el cuidado integral de tus mascotas. Ofrecemos consultas, tratamientos, y servicios de alojamiento. ¡Estamos aquí para ayudarte a cuidar de tu amigo peludo! ',
            ],
        ];

        $messageWithoutAccents = $this->removeAccents($message);

        foreach ($synonyms as $category => $data) {
            foreach ($data['keywords'] as $keyword) {
                if (stripos($this->removeAccents($keyword), $messageWithoutAccents) !== false) {
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
