<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductSyncController extends Controller
{
    public function sync(Request $request)
    {
        $validated = $request->validate([
            'code'             => 'required|string',
            'name'             => 'required|string',
            'sku'              => 'nullable|string|max:255',
            'barcode'          => 'nullable|string|max:255',
            'type'             => 'nullable|string|max:255',
            'material'         => 'nullable|string|max:255',
            'price_1'          => 'nullable|numeric',
            'price_2'          => 'nullable|numeric',
            'price_3'          => 'nullable|numeric',
            'price_4'          => 'nullable|numeric',
            'current_stock'    => 'nullable|numeric',
            'colors'           => 'nullable|string',
            'compatibility'    => 'nullable|string',
            'category_name'    => 'nullable|string|max:255',
            'unit_name'        => 'nullable|string|max:255',
            'supplier_name'    => 'nullable|string|max:255',
            'details_title'    => 'nullable|string|max:255',
            'details_content'  => 'nullable|string',
            'details_published'=> 'nullable|boolean',
            'image_file'       => 'nullable|image|max:2048',
        ]);

        // ✅ البحث عن الصنف أو إنشاؤه
        $category = Category::firstOrCreate(['name' => $validated['category_name'] ?? 'Général']);

        // ✅ البحث عن الوحدة والمورد بأمان (في حال لم تكن الموديلات موجودة في المتجر السحابي)
        $unit = null;
        if (class_exists('\App\Models\Unit')) {
            $unit = \App\Models\Unit::firstOrCreate(['name' => $validated['unit_name'] ?? 'Pièce']);
        }

        $supplier = null;
        if (class_exists('\App\Models\Supplier') && !empty($validated['supplier_name'])) {
            $supplier = \App\Models\Supplier::firstOrCreate(['name' => $validated['supplier_name']]);
        }

        $product = Product::firstOrNew(['code' => $validated['code']]);

        $product->name           = $validated['name'];
        $product->sku            = $validated['sku'] ?? null;
        $product->barcode        = $validated['barcode'] ?? null;
        $product->type           = $validated['type'] ?? null;
        $product->material       = $validated['material'] ?? null;
        $product->price_1        = $validated['price_1'] ?? 0;
        $product->price_2        = $validated['price_2'] ?? 0;
        $product->price_3        = $validated['price_3'] ?? 0;
        $product->price_4        = $validated['price_4'] ?? 0;
        $product->current_stock  = $validated['current_stock'] ?? 0;
        $product->colors         = $validated['colors'] ?? null;
        $product->compatibility  = $validated['compatibility'] ?? null;
        $product->is_active      = $request->boolean('is_active', true);
        
        // ✅ ربط المعرّفات
        $product->category_id    = $category->id;
        
        // نتحقق إذا كان العمود موجوداً في قاعدة البيانات السحابية قبل محاولة حفظه
        if (schema_has_column('products', 'unit_id')) {
            $product->unit_id = $unit->id ?? null;
        }
        if (schema_has_column('products', 'supplier_id')) {
            $product->supplier_id = $supplier->id ?? null;
        }

                 // استلام الصورة الرئيسية
                // استلام الصورة الرئيسية (الطريقة القياسية لـ Hostinger)
        if ($request->hasFile('image_file')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            
            // ✅ الحفظ في storage/app/public/products
            $path = $request->file('image_file')->store('products', 'public');
            $product->image = $path;
        }
        $product->save();

        if ($request->has('details_content')) {
            ProductDetail::updateOrCreate(
                ['product_id' => $product->id],
                [
                    'title'         => $request->details_title,
                    'content'       => $request->details_content,
                    'is_published'  => $request->boolean('details_published', false),
                ]
            );
        }

        return response()->json([
            'status'         => 'success', 
            'product_id'     => $product->id,
            'image_received' => $request->hasFile('image_file'),
            'image_path'     => $product->image,
            'details_synced' => $request->has('details_content')
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        $product = Product::where('code', $request->code)->first();

        if ($product) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $product->delete();

            return response()->json([
                'status' => 'success', 
                'message' => 'Product and details deleted successfully'
            ]);
        }

        return response()->json([
            'status' => 'not_found', 
            'message' => 'Product not found'
        ], 404);
    }
}

// دالة مساعدة للتحقق من وجود العمود في قاعدة البيانات السحابية
if (!function_exists('schema_has_column')) {
    function schema_has_column($table, $column) {
        return \Schema::hasColumn($table, $column);
    }
}