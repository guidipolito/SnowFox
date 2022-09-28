<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @routes
        @vite('resources/js/app.js')
        <script>
            let darkUrl = "{{asset('css/theme-dark.css')}}"
            let lightUrl = "{{asset('css/theme-light.css')}}"
            const setTheme = () => {
                let themeDark = localStorage.getItem('theme-dark')
                document.write(`<link id='theme-css' rel="stylesheet" href="${ themeDark ? darkUrl : lightUrl }">`)
            }
            setTheme()
            window.toggleTheme = (themeDark = !localStorage.getItem('theme-dark') ) => {
                let link = document.getElementById('theme-css')
                if(themeDark){
                    localStorage.setItem('theme-dark', 1)
                    link.href=darkUrl
                }else{
                    localStorage.removeItem('theme-dark')
                    link.href=lightUrl
                }
            }
        </script>
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
