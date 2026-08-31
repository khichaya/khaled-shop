@extends('layouts.master')

@section('title', 'Sélection du modèle | Khaled Auto Pièces')

@section('content')
<section class="max-w-7xl mx-auto px-4 py-12">
    <div class="text-center mb-10">
        <h2 class="text-2xl font-extrabold text-gray-900">Sélectionnez le modèle de votre {{ ucfirst($brand) }}</h2>
        <p class="text-sm text-gray-500 mt-2">Choisissez le véhicule pour trouver les pièces compatibles.</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($models as $model)
            @php
                // تحويل اسم الموديل إلى أحرف صغيرة وإزالة المسافات لجلب الصورة
                $imageName = strtolower(str_replace(' ', '-', $model)) . '.png';
            @endphp
            <a href="{{ route('car.years', ['brand' => $brand, 'model' => $model]) }}" class="block bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition duration-300 group">
                <div class="bg-gray-50 h-40 flex items-center justify-center p-4">
                    <img src="{{ asset('Images/cars/' . $imageName) }}" alt="{{ $model }}" class="h-full w-auto object-contain group-hover:scale-105 transition duration-300"
                         onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'flex items-center justify-center h-full text-gray-300\'><i class=\'fa-solid fa-car-side text-5xl\'></i></div>';">
                </div>
                <div class="p-4 text-center border-t border-gray-100">
                    <h3 class="font-bold text-gray-800">{{ ucfirst($model) }}</h3>
                    <span class="text-khaled text-xs font-bold mt-2 inline-block">Voir les années →</span>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endsection