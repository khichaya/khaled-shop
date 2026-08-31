@extends('layouts.master')

@section('title', 'Sélection de l\'année | Khaled Auto Pièces')

@section('content')
<section class="max-w-3xl mx-auto px-4 py-12 text-center">
    <div class="mb-8">
        <h2 class="text-2xl font-extrabold text-gray-900">Année(s) de fabrication</h2>
        <p class="text-sm text-gray-500 mt-2">Votre {{ ucfirst($brand) }} {{ ucfirst($model) }} a été fabriquée en quelle année ?</p>
    </div>

    <form action="{{ route('car.parts', ['brand' => $brand, 'model' => $model]) }}" method="POST">
        @csrf
        <div class="grid grid-cols-3 md:grid-cols-6 gap-4">
            @foreach($availableYears as $year)
                <label class="cursor-pointer">
                    <input type="checkbox" name="years[]" value="{{ $year }}" class="peer hidden">
                    <div class="w-full p-4 border-2 border-gray-200 rounded-lg peer-checked:border-khaled peer-checked:bg-khaled peer-checked:text-white text-gray-800 font-bold hover:border-khaled transition">
                        {{ $year }}
                    </div>
                </label>
            @endforeach
        </div>

        <button type="submit" class="mt-10 bg-khaled hover:bg-khaled-dark text-white px-8 py-3 rounded-full font-bold shadow-lg transition">
            <i class="fa-solid fa-magnifying-glass mr-2"></i> Trouver les pièces
        </button>
    </form>
</section>
@endsection