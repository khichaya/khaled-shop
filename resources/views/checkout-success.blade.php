@extends('layouts.master')

@section('title', 'Commande Confirmée | Khaled Auto Pièces')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-20 text-center">
    <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
        <i class="fa-solid fa-circle-check text-6xl text-green-500"></i>
    </div>
    <h1 class="text-3xl font-extrabold text-gray-900 mb-4">Commande Confirmée ! 🎉</h1>
    <p class="text-gray-600 text-lg mb-8">
        Merci pour votre confiance. Votre commande a été enregistrée avec succès. <br>
        Notre équipe va vous appeler très prochainement pour confirmer la livraison.
    </p>
    <a href="{{ route('home') }}" class="bg-khaled hover:bg-khaled-dark text-white font-bold px-8 py-3 rounded-full transition">
        Retour à l'accueil
    </a>
</div>
@endsection