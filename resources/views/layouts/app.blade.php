<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main id="app">
                {{ $slot }}
            </main>
        </div>
        <script>
            @if(session('success'))
                showSuccessMsg();
            @endif

            function confirmDelete(e) {
              myform = document.getElementById('form');
              flag = confirm('지울거야?');
              if (flag) {
                // 서브밋
                myform.submit();
              }
              // e.preventDefault(); // form이 서버로 전달되는 것을 막아준다.
            }

            function showSuccessMsg() {
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '작성완료!',
                showConfirmButton: false,
                timer: 1500
                })
            }

          </script>
    </body>
</html>
