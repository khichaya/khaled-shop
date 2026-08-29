@extends('layouts.master')

@section('title', 'Mon Panier | Khaled Auto Pièces')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Mon Panier</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    @if(!empty($cart) && count($cart) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- قائمة المنتجات (يسار) -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                @foreach($cart as $id => $item)
                    <div class="flex items-center gap-4 p-4 border-b">
                        <div class="w-20 h-20 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            @if($item['image'])
                                <img src="{{ asset($product->image) }}" class="w-full h-full object-contain rounded-lg">
                            @else
                                <i class="bi bi-gear text-2xl text-gray-300"></i>
                            @endif
                        </div>
                        <div class="flex-grow">
                            <h3 class="font-bold text-gray-800">{{ $item['name'] }}</h3>
                            <p class="text-sm text-gray-500">Prix unitaire: {{ number_format($item['price'], 2, ',', ' ') }} DZD</p>
                            <p class="text-sm text-gray-500">Qté: {{ $item['quantity'] }}</p>
                        </div>
                        <div class="font-extrabold text-khaled text-lg">
                            {{ number_format($item['price'] * $item['quantity'], 2, ',', ' ') }} DZD
                        </div>
                        <a href="{{ route('cart.remove', $id) }}" class="text-red-500 hover:text-red-700 text-xl">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- ملخص الطلب والدفع (يمين) -->
            <div class="lg:col-span-1 bg-white p-6 rounded-xl shadow-sm border border-gray-200 h-fit">
                <h2 class="text-xl font-bold mb-4 border-b pb-3">Résumé</h2>
                <div class="flex justify-between text-gray-600 mb-2">
                    <span>Sous-total</span>
                    <span>{{ number_format($total, 2, ',', ' ') }} DZD</span>
                </div>
                <div class="flex justify-between text-gray-600 mb-4">
                    <span>Livraison</span>
                    <span class="text-green-600 font-semibold">À convenir</span>
                </div>
                <div class="flex justify-between text-2xl font-extrabold text-gray-900 border-t pt-4 mb-6">
                    <span>Total</span>
                    <span class="text-khaled">{{ number_format($total, 2, ',', ' ') }} DZD</span>
                </div>
                
                <a href="{{ route('checkout.show') }}" class="w-full bg-khaled hover:bg-khaled-dark text-white font-extrabold py-4 rounded-xl text-center block shadow-lg transition">
                    Passer la commande
                </a>
                <a href="{{ route('home') }}" class="w-full text-center text-gray-500 font-semibold mt-4 block hover:text-khaled">
                    Continuer mes achats
                </a>
            </div>
        </div>
    @else
        <!-- السلة فارغة -->
        <div class="text-center py-20 bg-white rounded-xl border border-dashed">
            <i class="fa-solid fa-cart-shopping text-6xl text-gray-200 mb-4"></i>
            <h2 class="text-2xl font-bold text-gray-700">Votre panier est vide</h2>
            <p class="text-gray-500 mt-2">Parcourez notre catalogue pour ajouter des pièces.</p>
            <a href="{{ route('home') }}" class="inline-block mt-6 bg-khaled text-white px-8 py-3 rounded-full font-bold">Voir le catalogue</a>
        </div>
    @endif
</div>
@endsection