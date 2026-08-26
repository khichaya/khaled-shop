@extends('layouts.master')

@section('title', 'Mon Profil | Khaled Auto Pièces')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Mon Profil</h1>

    @if(session('status'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 font-semibold">
            {{ session('status') }}
        </div>
    @endif

    <!-- تعديل المعلومات الشخصية -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 mb-6">
        <h2 class="text-xl font-bold mb-4 border-b pb-3">Informations personnelles</h2>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-bold text-gray-700">Nom complet</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-khaled focus:border-khaled outline-none" required>
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="text-sm font-bold text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-khaled focus:border-khaled outline-none" required>
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="text-sm font-bold text-gray-700">Téléphone</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-khaled focus:border-khaled outline-none" placeholder="Ex: 05 00 00 00 00">
                    @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>                 
                <!-- ✅ حقل العنوان الجديد -->
                <div>
                    <label class="text-sm font-bold text-gray-700">Adresse de livraison</label>
                    <textarea name="address" rows="3" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-khaled focus:border-khaled outline-none" placeholder="Ex: Cité 1000 logements, Bt 4, Bab Ezzouar, Alger">{{ old('address', $user->address) }}</textarea>
                    @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
            <button type="submit" class="mt-6 bg-khaled hover:bg-khaled-dark text-white font-bold px-6 py-3 rounded-xl transition">
                <i class="fa-solid fa-save mr-1"></i> Enregistrer
            </button>
        </form>
    </div>

    <!-- تغيير كلمة المرور -->
        <!-- تغيير كلمة المرور -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        <h2 class="text-xl font-bold mb-4 border-b pb-3">Sécurité & Mot de passe</h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')
            
            {{-- إظهار أخطاء كلمة المرور بشكل عام --}}
            @if ($errors->updatePassword->any())
                <div class="bg-red-50 text-red-600 p-3 rounded-lg mb-4 text-sm font-semibold">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->updatePassword->first() }}
                </div>
            @endif

            <div class="space-y-4">
                <div>
                    <label class="text-sm font-bold text-gray-700">Mot de passe actuel</label>
                    <input type="password" name="current_password" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-khaled focus:border-khaled outline-none" required>
                    @error('current_password', 'updatePassword') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="text-sm font-bold text-gray-700">Nouveau mot de passe</label>
                    <input type="password" name="password" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-khaled focus:border-khaled outline-none" required>
                    @error('password', 'updatePassword') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="text-sm font-bold text-gray-700">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-khaled focus:border-khaled outline-none" required>
                </div>
            </div>
            <button type="submit" class="mt-6 bg-gray-800 hover:bg-gray-900 text-white font-bold px-6 py-3 rounded-xl transition">
                <i class="fa-solid fa-key mr-1"></i> Mettre à jour le mot de passe
            </button>
        </form>
    </div>
</div>
@endsection