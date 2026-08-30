@extends('layouts.master')

@section('title', 'Khaled Auto Pièces | Vente de Pièces Détachées & Accessoires Auto')

@section('content')
<!-- 1. Hero Banner Principal avec Image d'Arrière-plan Claire -->
<section class="relative text-white overflow-hidden border-b border-white/10 bg-cover bg-center bg-no-repeat"
         style="background-image: url('{{ asset('Images/hero-bg.jpg') }}');">
    
    <!-- تخفيف التظليل ليكون شفافاً وخفيفاً فقط خلف النصوص -->
    <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/35 to-transparent"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 py-16 md:py-24 flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="space-y-4 max-w-xl text-center md:text-left">
            <span class="inline-block bg-khaled text-white px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider shadow-md">
                Nouvel Arrivage & Pièces d'Origine ✨
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold leading-tight tracking-tight drop-shadow-[0_2px_10px_rgba(0,0,0,0.8)]">
                Toutes vos pièces automobiles au meilleur prix
            </h1>
            <p class="text-gray-100 text-sm md:text-base leading-relaxed drop-shadow-[0_1px_4px_rgba(0,0,0,0.9)]">
                Khaled Auto Pièces à bab ezzouar vous propose un large choix de pièces détachées d'origine et adaptables pour véhicules légers et utilitaires. Livraison rapide vers 58 wilayas.
            </p>
            <div class="flex flex-wrap gap-4 justify-center md:justify-start pt-2">
                <a href="#products" class="bg-khaled hover:bg-khaled-dark text-white font-bold px-6 py-3 rounded-full shadow-xl transition text-sm flex items-center gap-2">
                    <i class="fa-solid fa-list-check"></i> Parcourir le catalogue
                </a>
                <a href="https://wa.me/213780562445" class="bg-brandDark-200/80 hover:bg-brandDark-200 text-white font-medium px-6 py-3 rounded-full border border-white/30 transition text-sm flex items-center gap-2 backdrop-blur-sm shadow-lg" target="_blank">
                    <i class="fa-brands fa-whatsapp text-green-400 text-base"></i> Commander via WhatsApp
                </a>
            </div>
        </div>

        <!-- Carte Spécialité & Marque -->
        <div class="w-full md:w-1/2 flex justify-center">
            <div class="relative bg-white/95 backdrop-blur-md text-gray-900 p-6 rounded-2xl shadow-2xl border-4 border-khaled max-w-sm w-full text-center">
                <div class="w-16 h-16 bg-khaled text-white rounded-2xl flex items-center justify-center text-3xl mx-auto mb-3 shadow-md">
                    <i class="bi bi-gear-wide-connected"></i>
                </div>
                <h3 class="font-extrabold text-xl text-gray-900 tracking-tight">KHALED AUTO PIÈCES</h3>
                <p class="text-xs text-gray-500 font-semibold mt-1">bab ezzouar, W. Alger — Algérie</p>
                <div class="mt-4 pt-4 border-t border-gray-100 grid grid-cols-3 gap-2 text-xs text-gray-700 font-bold">
                    <div><i class="fa-solid fa-check text-khaled block mb-1 text-sm"></i> Filtration</div>
                    <div><i class="fa-solid fa-check text-khaled block mb-1 text-sm"></i> Freinage</div>
                    <div><i class="fa-solid fa-check text-khaled block mb-1 text-sm"></i> Moteur</div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- 2. Barre des Avantages & Services -->
    <section class="bg-white py-6 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
            <div class="p-3">
                <i class="fa-solid fa-truck-fast text-2xl text-khaled mb-2"></i>
                <h4 class="font-bold text-sm text-gray-900">Livraison 58 Wilayas</h4>
                <p class="text-xs text-gray-500">Rapide et sécurisée à domicile ou en point relais</p>
            </div>
            <div class="p-3">
                <i class="fa-solid fa-hand-holding-dollar text-2xl text-khaled mb-2"></i>
                <h4 class="font-bold text-sm text-gray-900">Paiement à la Réception</h4>
                <p class="text-xs text-gray-500">Payez en toute sécurité après vérification</p>
            </div>
            <div class="p-3">
                <i class="fa-solid fa-shield-halved text-2xl text-khaled mb-2"></i>
                <h4 class="font-bold text-sm text-gray-900">Qualité & Garantie</h4>
                <p class="text-xs text-gray-500">Pièces certifiées d'origine & marques reconnues</p>
            </div>
            <div class="p-3">
                <i class="fa-solid fa-store text-2xl text-khaled mb-2"></i>
                <h4 class="font-bold text-sm text-gray-900">Retrait au Magasin</h4>
                <p class="text-xs text-gray-500">Magasin central — bab ezzouar, W. Alger</p>
            </div>
        </div>
    </section>

    <!-- 3. Grille des Produits / Pièces Détachées -->
    <section id="products" class="max-w-7xl mx-auto px-4 py-12">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Pièces Récentes & Recommandées</h2>
                <p class="text-xs text-gray-500 mt-1">Trouvez rapidement la référence compatible avec votre véhicule</p>
            </div>
            <a href="{{ route('catalog') }}" class="text-khaled font-bold text-sm hover:underline flex items-center gap-1">
                Voir tout le catalogue <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @forelse($featuredProducts as $product)
                <a href="{{ route('products.show', $product) }}" class="block bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md hover:-translate-y-1 transition duration-200 group">
                    <div class="relative bg-gray-100 h-48 md:h-56 flex items-center justify-center overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                alt="{{ $product->name }}" 
                                class="h-full w-full object-cover group-hover:scale-105 transition duration-300"
                                onerror="this.onerror=null; this.style.display='none'; this.parentElement.innerHTML='<div class=\'flex flex-col items-center justify-center text-gray-400\'><i class=\'bi bi-gear-wide text-4xl group-hover:rotate-45 transition duration-300 text-gray-300\'></i><span class=\'text-[10px] mt-2 font-bold tracking-wider uppercase\'>Khaled Auto</span></div>';">
                        @else
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <i class="bi bi-gear-wide text-4xl group-hover:rotate-45 transition duration-300 text-gray-300"></i>
                                <span class="text-[10px] mt-2 font-bold tracking-wider uppercase">Khaled Auto</span>
                            </div>
                        @endif

                        @if(!empty($product->oem_number))
                            <span class="absolute top-2 left-2 bg-black/70 text-white text-[10px] font-mono px-2 py-0.5 rounded backdrop-blur-sm">
                                OEM: {{ $product->oem_number }}
                            </span>
                        @endif
                    </div>

                    <div class="p-4">
                        <span class="text-[10px] text-gray-400 block font-semibold uppercase tracking-wider">
                            {{ $product->category->name ?? 'Pièces Générales' }}
                        </span>
                        <h3 class="font-bold text-sm text-gray-800 line-clamp-1 mt-0.5" title="{{ $product->name }}">
                            {{ $product->name }}
                        </h3>
                        
                        <div class="mt-3 flex items-center justify-between">
                            <div>
                                <span class="text-khaled font-extrabold text-base">
                                    {{ number_format($product->price_1, 2, ',', ' ') }}
                                </span>
                                <span class="text-xs font-bold text-gray-500">DZD</span>
                            </div>
                            <span class="bg-red-50 text-khaled p-2 rounded-full shadow-sm group-hover:bg-khaled group-hover:text-white transition">
                                <i class="fa-solid fa-arrow-right text-xs"></i>
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-12 text-gray-500 bg-white rounded-xl border border-dashed border-gray-200">
                    <i class="bi bi-box-seam text-4xl text-gray-300 mb-2 block"></i>
                    Aucune pièce détachée n'est actuellement disponible dans le catalogue.
                </div>
            @endforelse
        </div>
    </section>
@endsection