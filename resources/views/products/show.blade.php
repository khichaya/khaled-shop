@extends('layouts.master')

@section('title', $product->name . ' | Khaled Auto Pièces')

@push('styles')

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')

<!-- Fil d'Ariane (Breadcrumb) -->
<div class="bg-gray-100 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3 text-xs text-gray-500 flex items-center gap-2">
        <a href="{{ route('home') }}" class="hover:text-khaled transition">Accueil</a>
        <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
                @if($product->category)
            @if(\Illuminate\Support\Facades\Route::has('category.show'))
                <a href="{{ route('category.show', $product->category->slug ?? $product->category->id) }}" class="hover:text-khaled transition">
                    {{ $product->category->name }}
                </a>
            @else
                <span class="text-gray-700 font-medium">{{ $product->category->name }}</span>
            @endif
            <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
        @endif
        <span class="text-gray-900 font-bold truncate max-w-[280px]">{{ $product->name }}</span>
    </div>
</div>

<section class="max-w-7xl mx-auto px-4 py-8">

    <!-- Grille Principale de l'Article -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        <!-- GAUCHE : Galerie Photos (5 colonnes) -->
        <div class="lg:col-span-5">
            <div class="product-gallery">
                <!-- Image Principale -->
                <div class="main-image-container shadow-sm">
                    @php
                        $images = [];
                        if($product->image) $images[] = asset('storage/' . $product->image);
                        if($product->images) {
                            foreach(json_decode($product->images, true) ?? [] as $img) {
                                $images[] = asset('storage/' . $img);
                            }
                        }
                        if(count($images) === 0) $images[] = null;
                    @endphp

                    <img id="mainImage" 
                         src="{{ $images[0] ?? '' }}" 
                         alt="{{ $product->name }}" 
                         class="main-image"
                         onerror="this.style.display='none'; document.getElementById('mainImagePlaceholder').style.display='flex';">

                    <div id="mainImagePlaceholder" class="w-full h-[460px] bg-gray-100 items-center justify-center text-gray-400 flex-col gap-2" style="display: none;">
                        <i class="bi bi-gear-wide-connected text-6xl text-gray-300"></i>
                        <span class="text-xs font-semibold text-gray-400">Khaled Auto Pièces</span>
                    </div>

                    <!-- Badge Réduction -->
                    @if($product->price_2 > 0 && $product->price_2 > $product->price_1)
                        @php $discount = round((($product->price_2 - $product->price_1) / $product->price_2) * 100); @endphp
                        <div class="absolute top-4 left-4 bg-red-600 text-white px-3 py-1 rounded-full text-xs font-extrabold shadow">
                            -{{ $discount }}% PROMO
                        </div>
                    @endif
                </div>

                <!-- Miniatures -->
                @if(count($images) > 1)
                <div class="thumbnail-list">
                    @foreach($images as $index => $img)
                    <button class="thumbnail-btn {{ $index === 0 ? 'active' : '' }}" 
                            onclick="changeImage('{{ $img }}', this)">
                        <img src="{{ $img }}" alt="Vue {{ $index + 1 }}">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        <!-- DROITE : Fiche Technique & Commande (7 colonnes) -->
        <div class="lg:col-span-7">
            <div class="space-y-5">

                <!-- En-tête : Catégorie, Titre & Références -->
                <div>
                    <div class="flex items-center gap-2 mb-2 flex-wrap">
                        <span class="text-xs font-bold text-khaled bg-red-50 px-3 py-1 rounded-full border border-red-100">
                            {{ $product->category->name ?? 'Pièces Détachées' }}
                        </span>
                        @if($product->oem_number)
                            <span class="badge-oem-pill">
                                OEM : {{ $product->oem_number }}
                            </span>
                        @endif
                        @if($product->sku)
                            <span class="text-xs font-mono text-gray-500 bg-gray-100 px-2 py-0.5 rounded">
                                Réf : {{ $product->sku }}
                            </span>
                        @endif
                    </div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 leading-tight">
                        {{ $product->name }}
                    </h1>
                    @if($product->brand)
                        <p class="text-sm font-semibold text-gray-500 mt-1">
                            Marque / Fabricant : <span class="text-gray-800 font-bold">{{ $product->brand }}</span>
                        </p>
                    @endif
                </div>

                <!-- Note & Avis -->
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-1 text-amber-400 text-sm">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa-solid fa-star {{ $i <= ($product->rating ?? 5) ? '' : 'text-gray-300' }}"></i>
                        @endfor
                    </div>
                    <span class="text-sm font-semibold text-gray-600">{{ $product->reviews_count ?? '18' }} avis clients</span>
                    <span class="text-gray-300">|</span>
                    <span class="text-sm text-emerald-600 font-bold"><i class="bi bi-check-circle-fill"></i> Conforme aux normes constructeur</span>
                </div>

                <!-- Bloc Prix & Disponibilité -->
                <div class="bg-gray-50 rounded-xl p-5 border border-gray-200">
                    <div class="flex items-baseline gap-3 flex-wrap">
                        <span class="text-3xl font-extrabold text-khaled">
                            {{ number_format($product->price_1, 2, ',', ' ') }} <small class="text-lg font-bold text-gray-700">DZD</small>
                        </span>
                        @if($product->price_2 > 0)
                            <span class="text-lg text-gray-400 line-through">
                                {{ number_format($product->price_2, 2, ',', ' ') }} DZD
                            </span>
                            <span class="text-xs font-bold text-green-700 bg-green-100 px-2 py-0.5 rounded-full">
                                Économisez {{ number_format($product->price_2 - $product->price_1, 2, ',', ' ') }} DZD
                            </span>
                        @endif
                    </div>

                    <!-- État du Stock -->
                    <div class="mt-3 flex items-center gap-3">
                        @if(($product->current_stock ?? $product->stock ?? 10) > 5)
                            <span class="stock-badge">
                                <i class="fa-solid fa-circle text-[8px]"></i>
                                En stock immédiat au magasin ({{ $product->current_stock ?? $product->stock }} unités)
                            </span>
                        @elseif(($product->current_stock ?? $product->stock ?? 0) > 0)
                            <span class="stock-badge low">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                                Stock limité : plus que {{ $product->current_stock ?? $product->stock }} pièces disponibles !
                            </span>
                        @else
                            <span class="inline-flex items-center gap-2 px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">
                                <i class="fa-solid fa-circle-xmark"></i>
                                Rupture temporaire de stock
                            </span>
                        @endif

                        @if($product->shelf_location)
                            <span class="text-xs text-gray-500 font-mono">
                                <i class="bi bi-geo-alt"></i> Rayon : {{ $product->shelf_location }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Formulaire de Commande & Choix de Qualité -->
                <form id="productForm" action="{{ route('cart.add') }}" method="POST" class="space-y-5">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="selected_quality" id="selectedQualityInput" value="Adaptable Premium">

                    <!-- Choix de la Qualité / Condition -->
                    <div>
                        <label class="text-sm font-bold text-gray-800 block mb-2">
                            <i class="bi bi-patch-check text-khaled mr-1"></i>
                            Gamme & Qualité de la pièce :
                        </label>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" class="condition-chip active" onclick="selectQuality(this, 'Adaptable Premium')">
                                <i class="fa-solid fa-check text-xs"></i> Adaptable Premium (OEM Standard)
                            </button>
                            <button type="button" class="condition-chip" onclick="selectQuality(this, 'Origine Constructeur')">
                                <i class="fa-solid fa-check text-xs"></i> Pièce d'Origine (Genuine)
                            </button>
                        </div>
                    </div>

                    <!-- Quantité -->
                    <div class="flex items-center gap-4">
                        <label class="text-sm font-bold text-gray-700">Quantité :</label>
                        <div class="flex items-center">
                            <button type="button" class="qty-btn rounded-l-lg" onclick="updateQty(-1)">
                                <i class="fa-solid fa-minus text-xs"></i>
                            </button>
                            <input type="number" name="quantity" id="quantityInput" value="1" min="1" max="{{ $product->current_stock ?? $product->stock ?? 99 }}" class="qty-input">
                            <button type="button" class="qty-btn rounded-r-lg" onclick="updateQty(1)">
                                <i class="fa-solid fa-plus text-xs"></i>
                            </button>
                        </div>
                        <span class="text-xs text-gray-400">Max : {{ $product->current_stock ?? $product->stock ?? 10 }} pièces / commande</span>
                    </div>

                    <!-- Boutons d'Action -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-2">
                        <button type="button" onclick="buyNow()" 
                                class="btn-buy-now flex-1 text-white font-extrabold py-3.5 px-6 rounded-xl transition flex items-center justify-center gap-2 text-base">
                            <i class="fa-solid fa-bolt"></i>
                            Acheter maintenant (Express)
                        </button>
                        <button type="submit" 
                                class="btn-add-cart flex-1 sm:flex-initial font-extrabold py-3.5 px-8 rounded-xl transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-cart-plus"></i>
                            Ajouter au panier
                        </button>

                        <button type="button" onclick="toggleWishlist(this)"
                                class="w-12 h-12 flex items-center justify-center border border-gray-300 rounded-xl text-gray-400 hover:text-khaled hover:border-khaled transition bg-white" title="Ajouter aux favoris">
                            <i class="fa-regular fa-heart text-xl"></i>
                        </button>
                    </div>
                </form>

                <!-- Badges de Confiance Automobile -->
                <div class="grid grid-cols-2 gap-3 pt-4 border-t border-gray-200">
                    <div class="feature-badge">
                        <i class="fa-solid fa-truck-fast text-khaled text-xl"></i>
                        <div>
                            <div class="text-xs font-bold text-gray-900">Livraison 58 Wilayas</div>
                            <div class="text-[11px] text-gray-500">Express à domicile</div>
                        </div>
                    </div>
                    <div class="feature-badge">
                        <i class="fa-solid fa-certificate text-khaled text-xl"></i>
                        <div>
                            <div class="text-xs font-bold text-gray-900">Compatibilité Garantie</div>
                            <div class="text-[11px] text-gray-500">Testée & vérifiée</div>
                        </div>
                    </div>
                    <div class="feature-badge">
                        <i class="fa-solid fa-hand-holding-dollar text-khaled text-xl"></i>
                        <div>
                            <div class="text-xs font-bold text-gray-900">Paiement à la livraison</div>
                            <div class="text-[11px] text-gray-500">Contrôle avant paiement</div>
                        </div>
                    </div>
                    <div class="feature-badge">
                        <i class="fa-solid fa-rotate-left text-khaled text-xl"></i>
                        <div>
                            <div class="text-xs font-bold text-gray-900">Échange ou Retour</div>
                            <div class="text-[11px] text-gray-500">Sous 7 jours ouvrés</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Onglets Techniques : Compatibilité / Fiche Technique / Description / Livraison -->
        <!-- Onglets Techniques : Compatibilité / Fiche Technique / Description / Livraison -->
    <div class="mt-12 bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <!-- En-têtes d'onglets -->
        <div class="flex border-b border-gray-200 overflow-x-auto bg-gray-50">
            <button class="tab-btn active" onclick="switchTab('compat', this)">
                <i class="fa-solid fa-car mr-2"></i>Véhicules Compatibles
            </button>
            <button class="tab-btn" onclick="switchTab('specs', this)">
                <i class="fa-solid fa-sliders mr-2"></i>Spécifications Techniques
            </button>
            <button class="tab-btn" onclick="switchTab('desc', this)">
                <i class="fa-solid fa-align-left mr-2"></i>Description Détaillée
            </button>
            <button class="tab-btn" onclick="switchTab('shipping', this)">
                <i class="fa-solid fa-truck-ramp-box mr-2"></i>Livraison & Retrait
            </button>
        </div>

        <!-- Contenus des Onglets -->
        <div class="p-6 md:p-8">

            <!-- 1. Onglet Compatibilité Véhicules (يقرأ من حقل compatibility) -->
            <div id="tab-compat" class="tab-content active">
                <div class="max-w-4xl">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="bi bi-check2-circle text-success"></i>
                        Modèles et Numéros de Châssis (VIN) Compatibles
                    </h3>
                    
                    @php
                        // تحويل حقل compatibility إلى مصفوفة لعرضه بشكل منظم
                        $compatList = [];
                        if (!empty($product->compatibility)) {
                            $compatArray = is_string($product->compatibility) ? json_decode($product->compatibility, true) : $product->compatibility;
                            if (is_array($compatArray)) {
                                $compatList = $compatArray;
                            } else {
                                $compatList = array_map('trim', explode(',', $product->compatibility));
                            }
                        }
                    @endphp

                    @if(!empty($compatList))
                        <div class="flex flex-wrap gap-2">
                            @foreach($compatList as $vin)
                                <span class="px-3 py-1.5 bg-gray-100 text-gray-800 text-xs font-mono font-bold rounded-lg border border-gray-200 shadow-sm">
                                    <i class="fa-solid fa-car-side mr-1 text-khaled"></i> {{ $vin }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm bg-gray-50 p-4 rounded-lg border border-dashed">
                            <i class="fa-solid fa-info-circle mr-1"></i> Aucune information de compatibilité spécifique n'a été enregistrée pour cette pièce. Veuillez nous contacter pour vérifier.
                        </p>
                    @endif
                </div>
            </div>

            <!-- 2. Onglet Spécifications Techniques (يقرأ من sku, type, material) -->
            <div id="tab-specs" class="tab-content">
                <div class="max-w-3xl">
                    <table class="w-full text-sm border border-gray-200 rounded-xl overflow-hidden">
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 font-bold text-gray-700 w-1/3 bg-gray-50">Référence (SKU)</td>
                                <td class="py-3 px-4 font-mono font-bold text-khaled">{{ $product->sku ?? 'N/A' }}</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 font-bold text-gray-700 w-1/3 bg-gray-50">Code-barres</td>
                                <td class="py-3 px-4 font-mono text-gray-600">{{ $product->barcode ?? 'N/A' }}</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 font-bold text-gray-700 w-1/3 bg-gray-50">Type / Sous-catégorie</td>
                                <td class="py-3 px-4 text-gray-600">{{ $product->type ?? 'Pièce Détachée' }}</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 font-bold text-gray-700 w-1/3 bg-gray-50">Matériau / Matière</td>
                                <td class="py-3 px-4 text-gray-600">{{ $product->material ?? 'Standard' }}</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 font-bold text-gray-700 w-1/3 bg-gray-50">Famille / Catégorie</td>
                                <td class="py-3 px-4 text-gray-600">{{ $product->category->name ?? 'Général' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 3. Onglet Description (يقرأ من details->content) -->
            <div id="tab-desc" class="tab-content">
                <div class="max-w-4xl text-gray-700 leading-relaxed space-y-4">
                    @if($product->details && $product->details->is_published && !empty($product->details->content))
                        {!! $product->details->content !!}
                    @else
                        <p>
                            Cette pièce <strong>{{ $product->name }}</strong> est fabriquée selon les exigences les plus strictes de l'industrie automobile. Elle garantit une durée de vie optimale, des performances identiques à l'équipement d'origine et un montage direct sans aucune modification.
                        </p>
                    @endif
                </div>
            </div>

            <!-- 4. Onglet Livraison & Retrait (ثابت لا يتغير) -->
            <div id="tab-shipping" class="tab-content">
                <div class="max-w-2xl space-y-4">
                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-khaled shadow-sm flex-shrink-0">
                            <i class="fa-solid fa-truck-fast"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Expédition Express 58 Wilayas</h4>
                            <p class="text-xs text-gray-500 mt-1">Délai moyen de livraison : 24h à 48h pour les grandes wilayas du Nord et du Sud.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-khaled shadow-sm flex-shrink-0">
                            <i class="fa-solid fa-store"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Retrait Direct au Magasin</h4>
                            <p class="text-xs text-gray-500 mt-1">Disponible immédiatement à notre comptoir principal : Bab Ezzouar, W. Alger.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>

@endsection

@push('scripts')
<script>
    // ===== Image Gallery =====
    function changeImage(src, btn) {
        const mainImg = document.getElementById('mainImage');
        const placeholder = document.getElementById('mainImagePlaceholder');

        if(src) {
            mainImg.src = src;
            mainImg.style.display = 'block';
            placeholder.style.display = 'none';
        }

        document.querySelectorAll('.thumbnail-btn').forEach(b => b.classList.remove('active'));
        if(btn) btn.classList.add('active');
    }

    // ===== Quality Selection =====
    function selectQuality(btn, qualityName) {
        document.querySelectorAll('.condition-chip').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById('selectedQualityInput').value = qualityName;
    }

    // ===== Quantity Controller =====
    function updateQty(delta) {
        const input = document.getElementById('quantityInput');
        let val = parseInt(input.value) || 1;
        const max = parseInt(input.max) || 99;
        val += delta;
        if(val < 1) val = 1;
        if(val > max) val = max;
        input.value = val;
    }

    // ===== Tabs Switcher =====
    function switchTab(tabId, btn) {
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        document.getElementById('tab-' + tabId).classList.add('active');

        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    }

    // ===== Buy Now =====
    function buyNow() {
        const form = document.getElementById('productForm');
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'buy_now';
        input.value = '1';
        form.appendChild(input);
        form.submit();
    }

    // ===== Wishlist =====
    function toggleWishlist(btn) {
        const icon = btn.querySelector('i');
        if(icon.classList.contains('fa-regular')) {
            icon.classList.remove('fa-regular');
            icon.classList.add('fa-solid', 'text-khaled');
            btn.classList.add('border-khaled');
        } else {
            icon.classList.remove('fa-solid', 'text-khaled');
            icon.classList.add('fa-regular');
            btn.classList.remove('border-khaled');
        }
    }
</script>
@endpush