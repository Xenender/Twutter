
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300" rel="stylesheet">


    <div class="container">
        @include('partials.navbar')
        <main class="main-content">
            @yield('content')
        </main>
    </div>
    @vite('resources/js/scriptNavBar.js')

