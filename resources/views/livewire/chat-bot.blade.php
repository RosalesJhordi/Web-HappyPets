<div class="w-full h-[87%] px-2 mt-2 overflow-y-auto">
    <div class="w-full min-h-[80%] h-auto mb-2 ">
        <div class="grid pb-11">
            <input id="transcript" class="hidden" wire:model.defer='goo' />
            @foreach ($messages as $message)
                @if ($message['sender'] === 'user')
                    <div class="flex gap-2.5 justify-end items-start">
                        <div class="flex flex-col justify-end w-full text-right">
                            <h5 class="w-full pb-1 text-sm font-semibold text-gray-900 text-end">
                                {{ $nombres ? $nombres : 'Usuario' }}
                            </h5>
                            <div class="flex flex-col justify-end w-full">
                                <div class="flex items-center justify-end w-full">
                                    <div
                                        class="px-3.5 py-2 bg-green-500 text-white max-w-1/2 w-auto h-auto flex  rounded justify-end items-end gap-3">
                                        <h5 class="w-auto h-auto text-sm font-normal leading-snug text-white">
                                            {{ $message['text'] }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="mt-1 text-right">
                                    <h6 class="py-1 text-xs font-normal text-gray-500">
                                        {{ $message['time'] }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <!-- Iniciales del usuario -->
                        <span class="flex items-center justify-center w-10 h-10 font-semibold rounded-full bg-rosa">
                            <p class="p-2 text-lg text-white">{{ $nombres ? substr($nombres, 0, 2) : 'US' }}</p>
                        </span>
                    </div>
                @else
                    <div class="flex gap-2.5">
                        <span class="flex items-center justify-center w-10 h-10 rounded-full bg-rosa">
                            <i class="text-2xl text-white fa-solid fa-shield-dog"></i>
                        </span>
                        <div class="grid">
                            <h5 class="pb-1 text-sm font-semibold leading-snug text-gray-900">HappyBot</h5>
                            <div class="grid w-full">
                                <div
                                    class="px-3.5 py-2 bg-blue-500 text-white w-1/2 h-auto  rounded justify-start items-center gap-3 inline-flex">
                                    <h5 class="w-full h-auto text-sm font-normal leading-snug text-white">
                                        {{ $message['text'] }}
                                    </h5>
                                </div>
                                <div class="justify-end items-center w-1/2 inline-flex mb-2.5">
                                    <h6 class="py-1 text-xs font-normal leading-4 text-gray-500">{{ $message['time'] }}
                                    </h6>
                                </div>
                            </div>
                            @if (isset($message['audio']) && $message['audio'])
                                <audio class="hidden" controls autoplay class="mt-2">
                                    <source src="data:audio/mp3;base64,{{ $message['audio'] }}" type="audio/mpeg">
                                    Tu navegador no soporta el audio.
                                </audio>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Input de mensaje -->
    <div class="sticky bottom-0 w-full h-auto py-2 bg-white" style="bottom: 0px;">
        <div
            class="inline-flex items-center justify-between w-full gap-2 py-1 pl-3 pr-1 bg-white border border-gray-200 rounded-3xl">
            <div class="flex items-center w-full gap-2">

                <button id="stop-btn" hidden>
                    <i class="w-5 text-xl text-blue-500 fa-solid fa-microphone"></i>
                </button>
                <button id="start-btn">
                    <i class="w-5 text-xl text-gray-500 fa-solid fa-microphone-slash"></i>
                </button>


                @if ($sonido)
                    <button type="button" wire:click="$set('sonido', false)"
                        class="flex items-center justify-between w-auto">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                            </svg>
                        </span>
                    </button>
                @else
                    <button type="button" wire:click="$set('sonido', true)"
                        class="flex items-center justify-between w-auto">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.25 9.75 19.5 12m0 0 2.25 2.25M19.5 12l2.25-2.25M19.5 12l-2.25 2.25m-10.5-6 4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                            </svg>

                        </span>
                    </button>
                @endif

                <input
                    class="w-full h-full p-2 font-medium leading-4 text-black border-0 outline-none text-md focus:outline-none focus:ring-0"
                    placeholder="Tu mensaje..." wire:model.defer="text" value={{ $text }}>

            </div>
            <div class="flex items-center gap-2">
                <button wire:click="sendMessage" wire:keydown.enter='sendMessage' class="flex items-center px-3 py-2 bg-indigo-600 rounded-full shadow ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16"
                        fill="none">
                        <g id="Send 01">
                            <path id="icon"
                                d="M9.04071 6.959L6.54227 9.45744M6.89902 10.0724L7.03391 10.3054C8.31034 12.5102 8.94855 13.6125 9.80584 13.5252C10.6631 13.4379 11.0659 12.2295 11.8715 9.81261L13.0272 6.34566C13.7631 4.13794 14.1311 3.03408 13.5484 2.45139C12.9657 1.8687 11.8618 2.23666 9.65409 2.97257L6.18714 4.12822C3.77029 4.93383 2.56187 5.33664 2.47454 6.19392C2.38721 7.0512 3.48957 7.68941 5.69431 8.96584L5.92731 9.10074C6.23326 9.27786 6.38623 9.36643 6.50978 9.48998C6.63333 9.61352 6.72189 9.7665 6.89902 10.0724Z"
                                stroke="white" stroke-width="1.6" stroke-linecap="round" />
                        </g>
                    </svg>
                    <h3 class="px-2 font-semibold leading-4 text-white text-md">Enviar</h3>
                </button>
            </div>
        </div>
    </div>
    <script>
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        if (!SpeechRecognition) {
            console.error("SpeechRecognition no está soportado en este navegador.");
        } else {
            const recognition = new SpeechRecognition();
            recognition.lang = 'es-ES';
            recognition.continuous = true;
            recognition.interimResults = true;

            let isRecognizing = false;
            let finalTranscript = "";

            const startBtn = document.getElementById('start-btn');
            const stopBtn = document.getElementById('stop-btn');
            const transcriptEl = document.getElementById('transcript');

            startBtn.addEventListener('click', () => {
                if (!isRecognizing) {
                    finalTranscript = "";
                    transcriptEl.textContent = "";
                    recognition.start();
                    isRecognizing = true;

                    startBtn.hidden = true;
                    stopBtn.hidden = false;
                }
            });

            stopBtn.addEventListener('click', () => {
                if (isRecognizing) {
                    recognition.stop();
                    isRecognizing = false;

                    stopBtn.hidden = true;
                    startBtn.hidden = false;
                }
            });

            recognition.onresult = (event) => {
                let interimTranscript = "";

                for (let i = event.resultIndex; i < event.results.length; ++i) {
                    const transcript = event.results[i][0].transcript;

                    if (event.results[i].isFinal) {
                        finalTranscript += transcript + " ";
                        @this.updateTranscription(finalTranscript);
                    } else {
                        interimTranscript += transcript;
                    }
                }
                transcriptEl.value = finalTranscript + interimTranscript;
            };

            recognition.onerror = (event) => {
                console.error("Error en la transcripción:", event.error);
            };
        }
    </script>

</div>
<script>
    window.addEventListener('redirect', event => {
        setTimeout(() => {
            @this.redirectToProducts('goo');
        }, 3000);
    });
</script>
