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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Custom CSS untuk memperbesar tampilan -->
        <style>
            /* Memperbesar tampilan form register/login */
            body {
                font-size: 16px !important;
            }
            
            .auth-container {
                max-width: 500px !important;
                width: 100% !important;
                padding: 2rem !important;
            }
            
            .auth-form {
                font-size: 1.1rem !important;
            }
            
            .auth-form label {
                font-size: 1.1rem !important;
                font-weight: 600 !important;
                margin-bottom: 0.5rem !important;
            }
            
            .auth-form input,
            .auth-form select {
                font-size: 1.1rem !important;
                padding: 0.75rem 1rem !important;
                height: auto !important;
                border-radius: 0.5rem !important;
            }
            
            .auth-form button {
                font-size: 1.1rem !important;
                padding: 0.75rem 2rem !important;
                font-weight: 600 !important;
            }
            
            .auth-form a {
                font-size: 1rem !important;
            }
            
            .auth-title {
                font-size: 2rem !important;
                font-weight: 700 !important;
                text-align: center !important;
                margin-bottom: 2rem !important;
            }
            
            .form-group {
                margin-bottom: 1.5rem !important;
            }
            
            .form-group label {
                display: block !important;
                margin-bottom: 0.5rem !important;
            }
            
            .form-group input,
            .form-group select {
                width: 100% !important;
                display: block !important;
            }
            
            .form-actions {
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                margin-top: 2rem !important;
            }
            
            .error-message {
                font-size: 0.95rem !important;
                margin-top: 0.5rem !important;
            }
            
            /* Responsive */
            @media (max-width: 640px) {
                .auth-container {
                    max-width: 100% !important;
                    margin: 1rem !important;
                    padding: 1.5rem !important;
                }
                
                .auth-form {
                    font-size: 1rem !important;
                }
                
                .auth-title {
                    font-size: 1.75rem !important;
                }
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="auth-container w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
