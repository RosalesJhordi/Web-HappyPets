<div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
    <a href="#" onclick="my_modal_11.showModal()" class="hover:underline">
        Libro de reclamos
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
          </svg>

    </a>
    <dialog id="my_modal_11" class="modal" wire:ignore.self>
        <div class="modal-box">
            <h3 class="text-lg font-bold">Ingrese su reclamo</h3>
            <form action="">
                <div class="relative mb-6">
                    <label class="flex items-center mb-2 text-sm font-medium text-gray-600">Nombres <svg width="7"
                            height="7" class="ml-1" viewBox="0 0 7 7" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z"
                                fill="#EF4444" />
                        </svg>
                    </label>
                    <input type="text" id="default-search" wire:model.live='nombres'
                        class="block w-full h-11 px-5 py-2.5 leading-7 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none "
                        placeholder="Nombres" required="">
                </div>
                <div class="relative mb-6">
                    <label class="flex items-center mb-2 text-sm font-medium text-gray-600">Telefono <svg width="7"
                            height="7" class="ml-1" viewBox="0 0 7 7" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z"
                                fill="#EF4444" />
                        </svg>
                    </label>
                    <input type="text" id="default-search" wire:model.live='telefono'
                        class="block w-full h-11 px-5 py-2.5 leading-7 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none "
                        placeholder="999999999" required="">
                </div>
                <div class="relative mb-6">
                    <label class="flex items-center mb-2 text-sm font-medium text-gray-600">Mensage <svg width="7"
                            height="7" class="ml-1" viewBox="0 0 7 7" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z"
                                fill="#EF4444"></path>
                        </svg>
                    </label>
                    <div class="flex">
                        <div class="relative w-full">
                            <textarea wire:model.live='reclamo'
                                class="block w-full h-40 px-4 py-2.5 text-base leading-7 font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-2xl placeholder-gray-400 focus:outline-none resize-none"
                                placeholder="Tu reclamo"></textarea>
                        </div>
                    </div>
                </div>
                <button wire:click='Reclamar'
                    class="w-full h-12 text-base font-semibold leading-6 text-white transition-all duration-700 bg-indigo-600 rounded-full shadow-xs hover:bg-indigo-800">Enviar reclamo</button>
            </form>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">Cancelar</button>
                </form>
            </div>
        </div>
    </dialog>
</div>
<script>
    window.addEventListener('correcto', () => {
        document.getElementById('my_modal_3').close();
        iziToast.success({
            message: event.detail,
            position: 'topRight',
            timeout: 5000,
            progressBar: true,
            closeOnClick: true,
            pauseOnHover: true,
            draggable: true,
            theme: 'light',
            transitionIn: 'bounce',
            zindex: 999999
        });
    });

    window.addEventListener('error', () => {
        document.getElementById('my_modal_3').close();
        iziToast.error({
            message: event.detail,
            position: 'topRight',
            timeout: 5000,
            progressBar: true,
            closeOnClick: true,
            pauseOnHover: true,
            draggable: true,
            theme: 'light',
            transitionIn: 'bounce',
            zindex: 999999
        });
    });
</script>
