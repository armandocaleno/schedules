<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Fontawesome icons --}}
    <script src="https://kit.fontawesome.com/95cec0f688.js" crossorigin="anonymous"></script>
    
    {{-- Toast messanges --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">  

    <!-- Scripts -->
    <!-- Full calendar -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"
        integrity="sha256-J37ZtjEw94oWBNZ9w/XC73raGXE9t10//XHJfKz2QCM=" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.5/locales-all.global.min.js'></script>

    <!-- Toast -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100 pb-20 md:pb-6">
        {{-- @livewire('navigation-menu') --}}

        @include('sidebar')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow w-full fixed z-20">
                <div class="py-6 sm:px-20 px-6 border">
                    {{ $header }}
                </div>

            </header>
        @endif

        <!-- Page Content -->
        <main class=" pt-16">
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @stack('js')

    @livewireScripts

    <script>
        //  Captura un mensaje enviado por el componente y lo muestra en pantalla
        window.addEventListener('success', event => {
            toastr.success(event.detail.message)                                 
        }) 
                    
        window.addEventListener('info', event => {
            // show toast message
            toastr.info(event.detail.message)        
        });  

        // Opciones de mensajes tooltips
        toastr.options = {                                    
            "positionClass": "toast-bottom-right",                                    
            "timeOut": "3000"                  
        }           
    </script>
</body>

</html>
