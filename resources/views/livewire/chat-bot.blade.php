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
    <div class="flex-grow p-4 mx-auto space-y-4 overflow-y-auto">
        <!-- Espacio para los mensajes -->
        <div class="flex flex-col space-y-4">
            <!-- Mensaje del usuario -->
            <div class="self-end max-w-xs p-3 text-white bg-blue-500 rounded-md shadow-sm">
                <p class="mb-1 font-semibold">Tú:</p>
                <p>{{ $message }}</p>
            </div>

            <!-- Respuesta del chatbot -->
            @if ($output)
                <div class="self-start max-w-xs p-3 text-white bg-gray-500 rounded-md shadow-sm">
                    <p class="mb-1 font-semibold">ChatBot:</p>
                    <p>{{ $output }}</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Campo para enviar mensaje -->
    <div class="sticky bottom-0 p-4 bg-white border-t">
        <div class="flex space-x-2">
            <input type="text" wire:model="message" wire:keydown.enter="sendMessage"
                class="flex-grow p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="Escribe tu mensaje...">
            <button wire:click="sendMessage"
                class="px-4 py-2 text-white transition duration-300 bg-indigo-500 rounded-md hover:bg-indigo-600 focus:outline-none">
                Enviar
            </button>
        </div>
    </div>
</div>
