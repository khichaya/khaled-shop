<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CarFinderController extends Controller
{
    // 1. عرض مربعات السيارات (الموديلات) حسب الماركة
    public function showModels($brand)
    {
        // جلب الموديلات الموجودة لهذه الماركة في قاعدة البيانات
        $models = Product::where('car_brand', $brand)
                         ->whereNotNull('car_model')
                         ->distinct()
                         ->pluck('car_model')
                         ->toArray();

        return view('car-finder-models', compact('brand', 'models'));
    }

    // 2. عرض السنوات المتوفرة للموديل المختار
    public function showYears(Request $request, $brand, $model)
    {
        // جلب كل القطع التي تنتمي لهذا الموديل لاستخراج السنوات منها
        $products = Product::where('car_brand', $brand)
                           ->where('car_model', $model)
                           ->get();

        $availableYears = [];
        
        // تحليل حقل السنوات برمجياً (سواء كان مدى 2010-2013 أو قائمة 2010,2011)
        foreach ($products as $product) {
            $yearsString = $product->years;
            if (!$yearsString) continue;

            if (strpos($yearsString, '-') !== false) {
                list($start, $end) = explode('-', $yearsString);
                for ($i = (int)trim($start); $i <= (int)trim($end); $i++) {
                    $availableYears[] = $i;
                }
            } elseif (strpos($yearsString, ',') !== false) {
                $parts = explode(',', $yearsString);
                foreach ($parts as $part) {
                    $availableYears[] = (int)trim($part);
                }
            } else {
                $availableYears[] = (int)trim($yearsString);
            }
        }

        // إزالة التكرارات وترتيب السنوات
        $availableYears = array_unique($availableYears);
        sort($availableYears);

        return view('car-finder-years', compact('brand', 'model', 'availableYears'));
    }

    // 3. الفلترة النهائية وجلب القطع حسب السنة المختارة
    public function getParts(Request $request, $brand, $model)
    {
        $selectedYears = $request->input('years', []);

        // جلب كل قطع هذا الموديل
        $products = Product::where('car_brand', $brand)
                           ->where('car_model', $model)
                           ->where('is_active', true)
                           ->get();

        // فلترة القطع برمجياً للتأكد أن السنة المختارة تقع ضمن سنوات التوافق
        $filteredProducts = $products->filter(function ($product) use ($selectedYears) {
            $yearsString = $product->years;
            if (!$yearsString) return false;

            foreach ($selectedYears as $year) {
                if (strpos($yearsString, '-') !== false) {
                    list($start, $end) = explode('-', $yearsString);
                    if ($year >= (int)trim($start) && $year <= (int)trim($end)) {
                        return true; // القطعة توافق هذه السنة
                    }
                } elseif (strpos($yearsString, ',') !== false) {
                    $parts = array_map('trim', explode(',', $yearsString));
                    if (in_array($year, $parts)) {
                        return true;
                    }
                } else {
                    if ($year == (int)trim($yearsString)) {
                        return true;
                    }
                }
            }
            return false;
        });

        return view('catalog', ['products' => $filteredProducts]);
    }
}