@extends('layouts.master')

@section('title', $category->name . ' | Khaled Auto Pièces')

@section('content')
<section class="max-w-7xl mx-auto px-4 py-12">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">{{ $category->name }}</h2>
            <p class="text-xs text-gray-500 mt-1">Découvrez notre sélection de pièces détachées dans cette catégorie.</p>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
        @forelse($products as $product)
            <a href="{{ route('products.show', $product) }}" class="block bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md hover:-translate-y-1 transition duration-200 group">
                <div class="relative bg-gray-100 h-48 md:h-56 flex items-center justify-center overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}"
                             alt="{{ $product->name }}" 
                             class="h-full w-full object-cover group-hover:scale-105 transition duration-300"
                             onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'flex flex-col items-center justify-center text-gray-400\'><i class=\'bi bi-gear-wide text-4xl group-hover:rotate-45 transition duration-300 text-gray-300\'></i><span class=\'text-[10px] mt-2 font-bold tracking-wider uppercase\'>Khaled Auto</span></div>';">
                    @else
                        <div class="flex flex-col items-center justify-center text-gray-400">
                            <i class="bi bi-gear-wide text-4xl group-hover:rotate-45 transition duration-300 text-gray-300"></i>
                            <span class="text-[10px] mt-2 font-bold tracking-wider uppercase">Khaled Auto</span>
                        </div>
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
                Aucune pièce détachée n'est actuellement disponible dans cette catégorie.
            </div>
        @endforelse
    </div>
    
    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>
@endsection