@extends('Layout.App')

@section('titulo')
    Sobre Nosotros
@endsection

@section('contenido')
    <div
        class="flex flex-col items-start justify-center w-full px-6 py-10 mx-auto bg-white rounded-xl md:flex-row md:space-x-6 xl:max-w-6xl">

        <!-- Sección de texto del proyecto -->
        <div
            class="w-full p-5 transition-all duration-500 bg-white shadow-lg group md:w-1/2 shadow-gray-200 rounded-xl hover:shadow-gray-300">
            <div class="flex flex-col items-center justify-center gap-4 text-center">
                <h2 class="text-4xl font-semibold text-gray-800">Sobre este Proyecto</h2>
                <p class="text-lg leading-relaxed text-gray-600 text-start">
                    Este proyecto estratégico propone la implementación de un software inteligente y multiplataforma para la
                    gestión integral de ventas, citas e inventario en la empresa veterinaria “HappyPets”. El objetivo es
                    optimizar la productividad y la eficiencia operativa, fortaleciendo al mismo tiempo la posición
                    competitiva de la empresa en el mercado local.
                </p>
                <p class="text-lg leading-relaxed text-gray-600 text-start">
                    La metodología ágil SCRUM será el enfoque elegido para llevar a cabo la planificación y ejecución del
                    proyecto, garantizando flexibilidad y capacidad de respuesta ante las necesidades emergentes del
                    negocio. Se emplearán herramientas de modelado como UML (Lenguaje Unificado de Modelado) para
                    representar de forma clara y precisa los procesos y la arquitectura del sistema.
                </p>
                <p class="text-lg leading-relaxed text-gray-600 text-start">
                    La solución tecnológica incluye el uso de PHP y Java como lenguajes de programación, el framework
                    Laravel 11 junto con Livewire, y el sistema de gestión de bases de datos MySQL para asegurar una
                    implementación robusta y eficiente. El sistema integrará varias APIs y herramientas clave para mejorar
                    su funcionalidad y eficiencia.
                </p>
            </div>
        </div>

        <!-- Sección de información de HappyPets -->
        <div
            class="w-full p-5 transition-all duration-500 bg-white shadow-lg group md:w-1/2 shadow-gray-200 rounded-xl hover:shadow-gray-300">
            <div class="flex flex-col items-center justify-center gap-4 text-center">
                <h2 class="text-4xl font-semibold text-gray-800"">Acerca de HappyPets</h2>
                <img src="{{ asset('img/logo.jpg') }}" alt="">
                <p class="text-lg leading-relaxed text-gray-600 text-start">
                    HappyPets es una clínica veterinaria dedicada a ofrecer servicios de atención y cuidado integral para
                    tus mascotas. Nuestro equipo de profesionales altamente capacitados se especializa en brindar atención
                    médica de alta calidad, desde consultas generales y vacunaciones hasta cirugía y tratamientos
                    especializados.
                </p>
                <p class="text-lg leading-relaxed text-gray-600 text-start">
                    En HappyPets, nos comprometemos a mejorar la salud y el bienestar de cada mascota, ofreciendo soluciones
                    personalizadas que se adaptan a las necesidades específicas de cada animal. Nos enorgullece nuestra
                    dedicación a la comunidad, manteniendo un entorno limpio y seguro, y utilizando lo último en tecnología
                    veterinaria para garantizar el mejor cuidado posible para tus fieles compañeros.
                </p>
            </div>
        </div>
    </div>
    @livewire('veterinarios.inicio')
@endsection
