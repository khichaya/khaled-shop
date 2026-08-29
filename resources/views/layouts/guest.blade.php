<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Khaled Auto Pièces') }} - Espace Client</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome & Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Google Font: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        khaled: { DEFAULT: '#D32F2F', dark: '#B71C1C', light: '#FEF2F2' },
                        brandDark: { 100: '#292524', 200: '#1c1917', 300: '#0f172a' }
                    },
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f9fafb; }
        .text-khaled { color: #D32F2F; }
        .bg-khaled { background-color: #D32F2F; }
        .border-khaled { border-color: #D32F2F; }
    </style>
</head>
<body class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50">
    
    <!-- Logo et Identité Visuelle -->
    <div class="mb-8">
        <a href="{{ route('home') }}" class="flex flex-col items-center gap-2">
            <img src="{{ asset('Images/logo.png') }}" alt="Logo Khaled Auto Pièces" class="w-16 h-16 object-contain">
            <div class="flex flex-col items-center border-l-2 border-khaled pl-3">
                <span class="text-base font-extrabold text-gray-900 leading-tight">KHALED AUTO PIÈCES</span>
                <span class="text-[10px] text-gray-500 font-semibold">Espace Client</span>
            </div>
        </a>
    </div>

    <!-- Contenu de la page (Formulaire de login ou register) -->
    <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-lg border border-gray-100 overflow-hidden sm:rounded-2xl">
        {{ $slot }}
    </div>
    
    <!-- Pied de page -->
    <p class="mt-8 text-xs text-gray-400">© {{ date('Y') }} Khaled Auto Pièces — Tous droits réservés</p>
</body>
</html>