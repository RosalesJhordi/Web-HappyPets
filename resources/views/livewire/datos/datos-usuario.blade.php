<div class="z-10 flex items-center justify-center gap-3">

    <div class="relative z-10 inline-block text-left">
        <div class="z-10">
            <button type="button"
                class="inline-flex z-10 justify-center items-center h-8 w-8 gap-x-1.5 rounded-full bg-blue-600 px-3 py-2 text-base font-normal text-white  hover:bg-blue-500"
                id="menu-button" aria-expanded="false" aria-haspopup="true" onclick="toggleDropdown()">
                {{ substr($nombres, 0, 2) }}
            </button>
        </div>

        <div id="dropdown-menu"
            class="absolute right-0 z-10 hidden w-56 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5"
            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <div class="py-1" role="none">
                <a wire:navigate href="{{ route('Perfil') }}" class="block px-4 py-2 text-sm text-gray-700"
                    role="menuitem" tabindex="-1" id="menu-item-0">Perfil</a>

                <button wire:click='deletetoken' type="button"
                    class="block w-full px-4 py-2 text-sm text-left text-gray-700" role="menuitem" tabindex="-1"
                    id="menu-item-3">
                    Cerrar sesion
                </button>
            </div>
        </div>
    </div>

    @if ($permisos)
        @foreach ($permisos as $permiso)
            @if ($permiso == 'Administrador')
                <a href="{{ route('Admin') }}">
                    <div class="fixed z-50 p-5 text-white bg-orange-600 rounded-md bottom-2 right-2">
                        <span>
                            <i class="fa-solid fa-chart-simple"></i>
                        </span>
                        Administrar
                    </div>
                </a>
            @endif
        @endforeach
    @endif
</div>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdown-menu');
        const button = document.getElementById('menu-button');
        const isOpen = button.getAttribute('aria-expanded') === 'true';

        button.setAttribute('aria-expanded', !isOpen);
        dropdown.classList.toggle('hidden', isOpen);
    }
</script>
