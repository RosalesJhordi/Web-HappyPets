<div class="w-full overflow-y-auto" style="height: 48vh;">
    <style>
        code {
            background-color: #1e1e1e;
            color: #dcdcdc;
            padding: 10px;
            border-radius: 4px;
            display: block;
            overflow-x: auto;
            white-space: pre;
            font-family: 'Courier New', Courier, monospace;
            font-style: bold;
            margin-top: 4px;
        }
    </style>
    <div class="mx-auto p-4 flex-grow overflow-y-auto space-y-4">
        <!-- Espacio para los mensajes -->
        @foreach ($responses as $response)
            <div class="flex flex-col">
                <!-- Mensaje del usuario -->
                <div class="bg-blue-500 text-white p-3 rounded-md shadow-sm max-w-xs self-end">
                    <p class="font-semibold mb-1">Tú:</p>
                    <p>{{ $response['message'] }}</p>
                </div>

                <!-- Respuesta del bot -->
                <div class="bg-gray-100 p-3 rounded-md shadow-inner max-w-xs self-start mt-2">
                    <p class="text-indigo-600 font-semibold">HappyBot:</p>
                    <p wire:loading.remove>
                        {!! nl2br($response['reply']) !!}
                    </p>
                    <div wire:loading class="skeleton h-4 w-20"></div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Campo para enviar mensaje -->
    <div class="p-4 border-t sticky bottom-0 bg-white">
        <div class="flex space-x-2">
            <input type="text" wire:model="message" wire:keydown.enter="sendMessage"
                class="flex-grow p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="Escribe tu mensaje...">
            <button wire:click="sendMessage"
                class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 transition duration-300 focus:outline-none">
                Enviar
            </button>
        </div>
    </div>
</div>
