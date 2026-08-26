@extends('layouts.master')

@section('title', 'Finaliser la Commande | Khaled Auto Pièces')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">Finaliser la Commande</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- ملخص الطلب (يسار) -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <h2 class="text-xl font-bold mb-4 border-b pb-3">Résumé de votre panier</h2>
            @php $total = 0; @endphp
            @foreach($cart as $id => $item)
                @php $total += $item['price'] * $item['quantity']; @endphp
                <div class="flex items-center gap-4 py-3 border-b">
                    <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                        @if($item['image'])
                            <img src="{{ asset('storage/' . $item['image']) }}" class="w-full h-full object-contain rounded-lg">
                        @else
                            <i class="bi bi-gear text-2xl text-gray-300"></i>
                        @endif
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-bold text-sm text-gray-800">{{ $item['name'] }}</h3>
                        <p class="text-xs text-gray-500">Qté: {{ $item['quantity'] }}</p>
                    </div>
                    <div class="font-extrabold text-khaled">{{ number_format($item['price'] * $item['quantity'], 2, ',', ' ') }} DZD</div>
                </div>
            @endforeach
            
            <div class="flex justify-between mt-4 text-xl font-extrabold text-gray-900">
                <span>Total à payer :</span>
                <span class="text-khaled">{{ number_format($total, 2, ',', ' ') }} DZD</span>
            </div>
            <p class="text-xs text-gray-500 mt-2 bg-yellow-50 p-3 rounded-lg border border-yellow-100">
                <i class="fa-solid fa-money-bill-wave"></i> Paiement à la livraison (Cash). Vous payez lorsque vous recevez votre colis.
            </p>
        </div>

        <!-- معلومات الزبون (يمين) -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <h2 class="text-xl font-bold mb-4 border-b pb-3">Vos Informations de Livraison</h2>
            
                       <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg mb-4">
                        <p class="font-bold"><i class="fa-solid fa-triangle-exclamation"></i> Veuillez corriger les erreurs :</p>
                        <ul class="list-disc ml-5 mt-2 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-bold text-gray-700">Nom et Prénom *</label>
                        <input type="text" name="customer_name" required value="{{ old('customer_name', auth()->user()->name ?? '') }}" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-khaled focus:border-khaled outline-none" placeholder="Ex: Ahmed Benali">
                    </div>
                    <div>
                        <label class="text-sm font-bold text-gray-700">Téléphone *</label>
                        <input type="tel" name="customer_phone" required value="{{ old('customer_phone', auth()->user()->phone ?? '') }}" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-khaled focus:border-khaled outline-none" placeholder="Ex: 05 00 00 00 00">
                    </div>
                    <div>
                        <label class="text-sm font-bold text-gray-700">Wilaya *</label>
                        <select name="customer_wilaya" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-khaled focus:border-khaled outline-none bg-white">
                            <option value="">-- Choisir votre Wilaya --</option>
                            <option {{ old('customer_wilaya') == 'Alger' ? 'selected' : '' }}>Alger</option>
                            <option {{ old('customer_wilaya') == 'Oran' ? 'selected' : '' }}>Oran</option>
                            <option {{ old('customer_wilaya') == 'Constantine' ? 'selected' : '' }}>Constantine</option>
                            <option {{ old('customer_wilaya') == 'El Oued' ? 'selected' : '' }}>El Oued</option>
                            <option>Autre...</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-bold text-gray-700">Adresse de Livraison (Rue, Cité...) *</label>
                        <textarea name="customer_address" required rows="3" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-khaled focus:border-khaled outline-none" placeholder="Entrez votre adresse complète">{{ old('customer_address', auth()->user()->address ?? '') }}</textarea>
                    </div>
                </div>

                <button type="submit" class="w-full mt-6 bg-khaled hover:bg-khaled-dark text-white font-extrabold py-4 rounded-xl text-lg shadow-lg transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-circle-check"></i> Confirmer la Commande
                </button>
            </form>
        </div>
    </div>
</div>
@endsection