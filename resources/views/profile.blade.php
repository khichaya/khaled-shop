@extends('layouts.master')

@section('title', 'Mon Compte | Khaled Auto Pièces')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    
    <!-- معلومات الحساب -->
    <div class="flex items-center gap-4 mb-8 bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        <div class="w-16 h-16 bg-red-50 text-khaled rounded-full flex items-center justify-center text-3xl">
            <i class="fa-solid fa-user"></i>
        </div>
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900">{{ Auth::user()->name }}</h1>
            <p class="text-gray-500 text-sm">{{ Auth::user()->email }}</p>
        </div>
        <a href="{{ route('profile.edit') }}" class="ml-auto text-xs font-bold text-gray-500 hover:text-khaled border border-gray-300 px-3 py-2 rounded-lg transition">
            <i class="fa-solid fa-pen-to-square mr-1"></i> Modifier le profil
        </a>
    </div>

    <!-- قسم الطلبات -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        <h2 class="text-xl font-bold mb-4 border-b pb-3 text-gray-800">
            <i class="fa-solid fa-box-archive mr-2 text-khaled"></i>Mes Commandes
        </h2>

        @if($orders->count() > 0)
            <div class="space-y-4">
                @foreach($orders as $order)
                    <div class="border border-gray-100 rounded-lg p-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 hover:bg-gray-50 transition">
                        <div>
                            <span class="text-xs font-bold text-khaled bg-red-50 px-2 py-1 rounded">N° {{ $order->order_number }}</span>
                            <p class="font-bold text-gray-800 mt-2">{{ number_format($order->total_amount, 2, ',', ' ') }} DZD</p>
                            <p class="text-xs text-gray-400 mt-1"><i class="fa-regular fa-calendar mr-1"></i> {{ $order->created_at->format('d/m/Y à H:i') }}</p>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <div class="text-right">
                                @if($order->status == 'pending')
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">En attente</span>
                                @elseif($order->status == 'processing')
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">En traitement</span>
                                @elseif($order->status == 'completed')
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Livrée</span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">Annulée</span>
                                @endif>
                                <p class="text-xs text-gray-500 mt-2">{{ $order->items->count() }} article(s)</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- حالة السلة فارغة -->
            <div class="text-center py-12">
                <i class="fa-solid fa-box-open text-5xl text-gray-200 mb-3"></i>
                <h3 class="font-bold text-gray-700">Aucune commande pour le moment</h3>
                <p class="text-gray-500 text-sm mt-1">Vous n'avez pas encore passé de commande.</p>
                <a href="{{ route('home') }}" class="inline-block mt-4 bg-khaled text-white px-6 py-2 rounded-full text-sm font-bold hover:bg-khaled-dark transition">
                    Commencer mes achats
                </a>
            </div>
        @endif
    </div>

</div>
@endsection