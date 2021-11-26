<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Weathery') }}</title>
 
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
 
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        
       
 
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://unpkg.com/vue@next"></script> 
       
    </head>
    <body class="font-sans antialiased ">
        <div class="min-h-screen sm:px-10 bg-blue-100"> 
           
 
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
    
</html>
