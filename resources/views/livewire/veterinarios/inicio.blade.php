<div class="py-14">
    <div class="container px-5 mx-auto">
        <h2 class="mb-10 text-2xl font-extrabold text-center text-gray-800 lg:text-4xl">
            Conoce a Nuestro Equipo
        </h2>
        <div class="grid grid-cols-2 gap-4 md:gap-10 sm:grid-cols-3 xl:grid-cols-4">
            @if ($datos)
                @foreach ($datos as $veterinario)
                    <div
                        class="overflow-hidden transition duration-300 transform bg-white border shadow-lg rounded-xl hover:scale-105 hover:shadow-2xl">
                        @if ($veterinario['imagen'])
                            <img src="https://api.happypetshco.com/ServidorPerfiles/{{ $veterinario['imagen'] }}"
                                alt="perfil de {{ $veterinario['nombres'] }}" class="object-cover w-full h-40 lg:60">
                        @else
                            <img src="{{ asset('img/profile.jpg') }}"
                                alt="perfil de {{ $veterinario['nombres'] }}" class="object-cover w-full h-40 lg:60">
                        @endif
                        <div class="p-2 lg:p-6">
                            <!-- Nombre y Cargo -->
                            <h3 class="mb-2 text-xl font-semibold text-gray-800">{{ $veterinario['nombres'] }}</h3>
                            <span
                                class="w-auto px-3 py-1 mb-4 text-xs font-medium rounded-full bg-violet-100 text-violet-600">{{ $veterinario['especialidad'] }}</span>
                            <!-- Descripción -->
                            <p class="h-24 mt-2 mb-4 text-xs text-gray-700 lg:text-sm leaing-relaxed">
                                @if ($veterinario['descripcion'])
                                    {{ $veterinario['descripcion'] }}
                                @else
                                    En nuestra clínica, nos dedicamos a ofrecer una atención de calidad y confianza para
                                    cada mascota, garantizando su bienestar y salud en un ambiente cálido y profesional.
                                @endif
                            </p>
                            <!-- Badges -->
                            <div class="flex flex-wrap gap-2 mb-4">

                                <span
                                    class="px-3 py-1 text-xs font-medium text-green-600 bg-green-100 rounded-full">#Innovación</span>
                                <span
                                    class="px-3 py-1 text-xs font-medium text-purple-600 bg-purple-100 rounded-full">#Trabajo
                                    en Equipo</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
