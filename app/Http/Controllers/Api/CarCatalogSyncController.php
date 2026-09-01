<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarCatalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarCatalogSyncController extends Controller
{
    public function sync(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'years' => 'required|string',
            'brand_logo' => 'nullable|image|max:1024',
            'model_image' => 'nullable|image|max:1024',
        ]);

        $car = CarCatalog::firstOrNew(['brand' => $validated['brand'], 'model' => $validated['model']]);
        $car->years = $validated['years'];

        if ($request->hasFile('brand_logo')) {
            if ($car->brand_logo) Storage::disk('public')->delete($car->brand_logo);
            $car->brand_logo = $request->file('brand_logo')->store('cars/brands', 'public');
        }
        if ($request->hasFile('model_image')) {
            if ($car->model_image) Storage::disk('public')->delete($car->model_image);
            $car->model_image = $request->file('model_image')->store('cars/models', 'public');
        }

        $car->save();
        return response()->json(['message' => 'Car catalog synced successfully']);
    }
}