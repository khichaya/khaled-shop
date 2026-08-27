<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Khaled Auto Pièces | Vente de Pièces Détachées & Accessoires')</title>
    
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
                        khaled: {
                            DEFAULT: '#D32F2F',
                            dark: '#B71C1C',
                            light: '#FEF2F2',
                        },
                        brandDark: {
                            100: '#292524',
                            200: '#1c1917',
                            300: '#0f172a'
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-khaled { background-color: #D32F2F; }
        .text-khaled { color: #D32F2F; }
        .border-khaled { border-color: #D32F2F; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800 pb-16 md:pb-0 min-h-screen flex flex-col justify-between">

    <!-- 1. Top Announcement Bar -->
    <div class="bg-brandDark-200 text-white text-xs py-2 px-4 text-center flex justify-between items-center md:px-8 border-b border-white/10">
        <div class="hidden md:flex items-center gap-4 text-gray-300">
            <span><i class="fa-solid fa-location-dot text-khaled mr-1"></i> bab ezzouar, W. Alger</span>
            <span><i class="fa-solid fa-phone text-khaled mr-1"></i> Contact: +213 (0) 600 00 00 00</span>
        </div>
        <div class="w-full md:w-auto text-center font-medium text-amber-400">
            🚚 Livraison express vers 58 wilayas | Retrait direct disponible au magasin
        </div>
        <div class="hidden md:flex items-center gap-2">
            <span class="bg-khaled text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full">Paiement à la livraison</span>
        </div>
    </div>

    <!-- 2. Main Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Logo & Brand Name -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="w-11 h-11 bg-khaled text-white rounded-xl flex items-center justify-center text-xl shadow-md transition-transform duration-300 group-hover:scale-105">
                            <i class="bi bi-gear-wide-connected"></i>
                        </div>
                        <div class="flex flex-col border-l-2 border-khaled pl-3 ml-1">
                            <span class="text-base font-extrabold text-gray-900 leading-tight">KHALED AUTO PIÈCES</span>
                            <span class="text-[10px] text-gray-500 font-semibold">Pièces de rechange & Accessoires</span>
                        </div>
                    </a>
                </div>

                <!-- Search Bar -->
                <div class="hidden md:flex flex-1 max-w-md mx-8">
                    <form action="#" method="GET" class="w-full relative">
                        <input type="text" name="query" placeholder="Rechercher par réf, code OEM, marque (Toyota, Renault...)" 
                               class="w-full bg-gray-100 border border-gray-300 rounded-full py-2 pl-4 pr-10 text-sm focus:outline-none focus:border-khaled focus:bg-white transition shadow-inner">
                        <button type="submit" class="absolute right-3 top-2.5 text-gray-400 hover:text-khaled">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>

                <!-- User & Cart Actions -->
                <div class="flex items-center gap-4">
                                        @auth
                        <!-- Menu Utilisateur (Si connecté) -->
                        <div class="hidden sm:flex items-center gap-2 relative group cursor-pointer">
                            <button class="flex items-center gap-2 text-gray-700 hover:text-khaled transition">
                                <i class="fa-regular fa-user text-lg text-khaled"></i>
                                <span class="text-xs font-semibold">{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-chevron-down text-[8px] mt-0.5"></i>
                            </button>
                            
                            <!-- ✅ تمت إزالة mt-2 وإضافة pt-2 لسد الفراغ ومنع اختفاء القائمة -->
                            <div class="absolute top-full right-0 pt-2 w-48 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-200">
                                <!-- المربع الأبيض الداخلي -->
                                <div class="bg-white rounded-lg shadow-xl border border-gray-100 overflow-hidden">
                                    <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-khaled rounded-t-lg">
                                        <i class="fa-solid fa-box mr-2"></i> Mes Commandes
                                    </a>
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-khaled">
                                        <i class="fa-solid fa-user-gear mr-2"></i> Mon Profil
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-b-lg">
                                            <i class="fa-solid fa-right-from-bracket mr-2"></i> Déconnexion
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Boutons Login/Register (Si non connecté) -->
                        <a href="{{ route('login') }}" class="hidden sm:flex items-center gap-2 text-gray-700 hover:text-khaled transition">
                            <i class="fa-regular fa-user text-lg text-khaled"></i>
                            <span class="text-xs font-semibold">Connexion</span>
                        </a>
                        <a href="{{ route('register') }}" class="hidden sm:block bg-khaled text-white text-xs px-4 py-2 rounded-full font-bold hover:bg-khaled-dark transition">S'inscrire</a>
                    @endauth
                    
                    <!-- Panier -->
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-600 hover:text-khaled transition">
                        <i class="fa-solid fa-cart-shopping text-2xl"></i>
                        @php $cart_count = count(session()->get('cart', [])); @endphp
                        @if($cart_count > 0)
                            <span class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] w-5 h-5 rounded-full flex items-center justify-center font-bold">
                                {{ $cart_count }}
                            </span>
                        @endif
                    </a>
                </div>
            </div>
        </div>

        
               <!-- 3. Desktop Categories Menu -->
        <nav class="bg-brandDark-200 text-white hidden md:block border-t border-white/10">
            <div class="max-w-7xl mx-auto px-8 flex items-center gap-8 text-sm font-medium h-11">
                <a href="{{ route('home') }}" class="text-amber-400 font-bold border-b-2 border-khaled py-2.5">Accueil</a>
                
                <!-- 1. Filtration & Huiles -->
                <div class="relative group py-2.5 cursor-pointer">
                    <span class="hover:text-amber-400 flex items-center gap-1 transition">
                        Filtration & Huiles <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </span>
                    <div class="absolute top-full left-0 w-64 bg-white text-gray-800 shadow-xl rounded-b-lg hidden group-hover:block p-3 z-50 border-t-2 border-khaled">
                        <a href="{{ route('products.byType', 'Filtre à huile & carburant') }}" class="block py-1.5 px-2 hover:bg-red-50 hover:text-khaled rounded text-xs font-semibold">Filtre à huile & carburant</a>
                        <a href="{{ route('products.byType', 'Filtre à air & habitacle') }}" class="block py-1.5 px-2 hover:bg-red-50 hover:text-khaled rounded text-xs font-semibold">Filtre à air & habitacle</a>
                        <a href="{{ route('products.byType', 'Huiles moteur & transmissions') }}" class="block py-1.5 px-2 hover:bg-red-50 hover:text-khaled rounded text-xs font-semibold">Huiles moteur & transmissions</a>
                    </div>
                </div>

                <!-- 2. Freinage & Suspension -->
                <div class="relative group py-2.5 cursor-pointer">
                    <span class="hover:text-amber-400 flex items-center gap-1 transition">
                        Freinage & Suspension <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </span>
                    <div class="absolute top-full left-0 w-64 bg-white text-gray-800 shadow-xl rounded-b-lg hidden group-hover:block p-3 z-50 border-t-2 border-khaled">
                        <a href="{{ route('products.byType', 'Plaquettes & disques de frein') }}" class="block py-1.5 px-2 hover:bg-red-50 hover:text-khaled rounded text-xs font-semibold">Plaquettes & disques de frein</a>
                        <a href="{{ route('products.byType', 'Amortisseurs & ressorts') }}" class="block py-1.5 px-2 hover:bg-red-50 hover:text-khaled rounded text-xs font-semibold">Amortisseurs & ressorts</a>
                        <a href="{{ route('products.byType', 'Rotules & bras de suspension') }}" class="block py-1.5 px-2 hover:bg-red-50 hover:text-khaled rounded text-xs font-semibold">Rotules & bras de suspension</a>
                    </div>
                </div>

                <!-- 3. Moteur & Embrayage -->
                <div class="relative group py-2.5 cursor-pointer">
                    <span class="hover:text-amber-400 flex items-center gap-1 transition">
                        Moteur & Embrayage <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </span>
                    <div class="absolute top-full left-0 w-64 bg-white text-gray-800 shadow-xl rounded-b-lg hidden group-hover:block p-3 z-50 border-t-2 border-khaled">
                        <a href="{{ route('products.byType', 'Kits de distribution & courroies') }}" class="block py-1.5 px-2 hover:bg-red-50 hover:text-khaled rounded text-xs font-semibold">Kits de distribution & courroies</a>
                        <a href="{{ route('products.byType', 'Kits d\'embrayage & volants moteur') }}" class="block py-1.5 px-2 hover:bg-red-50 hover:text-khaled rounded text-xs font-semibold">Kits d'embrayage & volants moteur</a>
                        <a href="{{ route('products.byType', 'Bougies d\'allumage & préchauffage') }}" class="block py-1.5 px-2 hover:bg-red-50 hover:text-khaled rounded text-xs font-semibold">Bougies d'allumage & préchauffage</a>
                        <a href="{{ route('products.byType', 'Pompes à eau & thermostats') }}" class="block py-1.5 px-2 hover:bg-red-50 hover:text-khaled rounded text-xs font-semibold">Pompes à eau & thermostats</a>
                    </div>
                </div>

                <!-- 4. Électricité & Capteurs -->
                <div class="relative group py-2.5 cursor-pointer">
                    <span class="hover:text-amber-400 flex items-center gap-1 transition">
                        Électricité & Capteurs <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </span>
                    <div class="absolute top-full left-0 w-64 bg-white text-gray-800 shadow-xl rounded-b-lg hidden group-hover:block p-3 z-50 border-t-2 border-khaled">
                        <a href="{{ route('products.byType', 'Batteries & alternateurs') }}" class="block py-1.5 px-2 hover:bg-red-50 hover:text-khaled rounded text-xs font-semibold">Batteries & alternateurs</a>
                        <a href="{{ route('products.byType', 'Démarreurs') }}" class="block py-1.5 px-2 hover:bg-red-50 hover:text-khaled rounded text-xs font-semibold">Démarreurs</a>
                        <a href="{{ route('products.byType', 'Capteurs & sondes (MAF, Lambda...)') }}" class="block py-1.5 px-2 hover:bg-red-50 hover:text-khaled rounded text-xs font-semibold">Capteurs & sondes (MAF, Lambda...)</a>
                        <a href="{{ route('products.byType', 'Optiques de phares & ampoules') }}" class="block py-1.5 px-2 hover:bg-red-50 hover:text-khaled rounded text-xs font-semibold">Optiques de phares & ampoules</a>
                    </div>
                </div>

                <a href="#" class="ml-auto bg-khaled text-white text-xs px-3.5 py-1 rounded-full font-bold hover:bg-khaled-dark transition">
                    Promotions & Arrivages 🏷️
                </a>
            </div>
        </nav>
    </header>

    <!-- Dynamic Page Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- 4. Mobile Bottom Navigation -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 py-2.5 px-4 flex justify-around items-center z-50 shadow-lg">
        <a href="{{ route('home') }}" class="flex flex-col items-center text-khaled">
            <i class="fa-solid fa-house text-lg"></i>
            <span class="text-[10px] font-bold mt-0.5">Accueil</span>
        </a>
        <a href="#" class="flex flex-col items-center text-gray-500 hover:text-khaled">
            <i class="fa-solid fa-list-ul text-lg"></i>
            <span class="text-[10px] mt-0.5">Rayons</span>
        </a>
        <a href="{{ route('cart.index') }}" class="flex flex-col items-center text-gray-500 hover:text-khaled relative">
            <i class="fa-solid fa-cart-shopping text-lg"></i>
            <span class="text-[10px] mt-0.5">Panier</span>
            @php $cart_count = count(session()->get('cart', [])); @endphp
            @if($cart_count > 0)
                <span class="absolute -top-1 -right-2 bg-khaled text-white text-[9px] font-bold h-4 w-4 rounded-full flex items-center justify-center">{{ $cart_count }}</span>
            @endif
        </a>
        @auth
            <a href="{{ route('profile.index') }}" class="flex flex-col items-center text-gray-500 hover:text-khaled">
                <i class="fa-solid fa-user text-lg"></i>
                <span class="text-[10px] mt-0.5">Compte</span>
            </a>
        @else
            <a href="{{ route('login') }}" class="flex flex-col items-center text-gray-500 hover:text-khaled">
                <i class="fa-solid fa-right-to-bracket text-lg"></i>
                <span class="text-[10px] mt-0.5">Login</span>
            </a>
        @endauth
    </div>

    <!-- 5. Footer -->
    <footer class="bg-brandDark-200 text-gray-400 text-xs py-10 border-t-4 border-khaled mt-12">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
            <div>
                <div class="bg-khaled text-white py-1.5 px-4 rounded-full inline-block mb-3 shadow">
                    <span class="font-bold text-base tracking-wide">KHALED AUTO PIÈCES</span>
                </div>
                <p class="leading-relaxed text-gray-400">
                    Spécialiste de la vente de pièces détachées d'origine et adaptables pour véhicules légers et utilitaires. Magasin situé à bab ezzouar, W. Alger. Qualité garantie et livraison rapide sur toute l'Algérie.
                </p>
            </div>
            <div>
                <h4 class="text-white font-bold text-sm mb-3">Rayons Principaux</h4>
                <ul class="space-y-2 font-medium">
                    <li><a href="#" class="hover:text-white transition">Filtration, Huiles & Consommables</a></li>
                    <li><a href="#" class="hover:text-white transition">Système de Freinage & Suspension</a></li>
                    <li><a href="#" class="hover:text-white transition">Distribution, Moteur & Embrayage</a></li>
                    <li><a href="#" class="hover:text-white transition">Conditions de Livraison & Retours</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold text-sm mb-3">Contact & Localisation</h4>
                <p class="mb-2"><i class="fa-solid fa-location-dot text-khaled mr-1"></i> Centre-ville, bab ezzouar, W. Alger</p>
                <p class="mb-2"><i class="fa-solid fa-phone text-khaled mr-1"></i> +213 (0) 600 00 00 00</p>
                <p><i class="fa-solid fa-envelope text-khaled mr-1"></i> contact@khaled-autoparts.com</p>
            </div>
        </div>
        <div class="text-center pt-8 mt-8 border-t border-gray-800 text-[11px] text-gray-500">
            Tous droits réservés © 2026 Khaled Auto Pièces — Powered by AutoPOS System
        </div>
    </footer>

    @stack('scripts')
</body>
</html>