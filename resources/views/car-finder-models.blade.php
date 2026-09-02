@extends('layouts.master')

@section('title', 'Sélection du modèle | Khaled Auto Pièces')

@section('content')
<section class="max-w-7xl mx-auto px-4 py-12">
    <div class="text-center mb-10">
        <h2 class="text-2xl font-extrabold text-gray-900">Sélectionnez le modèle de votre {{ ucfirst($brand) }}</h2>
        <p class="text-sm text-gray-500 mt-2">Choisissez le véhicule pour trouver les pièces compatibles.</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($models as $item)
            @php
                $modelName = $item->model;
                // استخدام صورة الموديل من قاعدة البيانات إن وجدت، وإلا اسم الموديل كملف png
                if (!empty($item->model_image)) {
                    $imageUrl = filter_var($item->model_image, FILTER_VALIDATE_URL)
                        ? $item->model_image
                        : asset('Images/cars/' . $item->model_image);
                } else {
                    $imageUrl = asset('Images/cars/' . strtolower(str_replace(' ', '-', $modelName)) . '.png');
                }
            @endphp
            <a href="{{ route('car.years', ['brand' => $brand, 'model' => $modelName]) }}" class="block bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition duration-300 group">
                <div class="bg-gray-50 h-40 flex items-center justify-center p-4">
                    <img src="{{ $imageUrl }}" alt="{{ $modelName }}" class="h-full w-auto object-contain group-hover:scale-105 transition duration-300"
                         onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'flex items-center justify-center h-full text-gray-300\'><i class=\'fa-solid fa-car-side text-5xl\'></i></div>';">
                </div>
                <div class="p-4 text-center border-t border-gray-100">
                    <h3 class="font-bold text-gray-800">{{ ucfirst($modelName) }}</h3>
                    <span class="text-khaled text-xs font-bold mt-2 inline-block">Voir les années →</span>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endsection