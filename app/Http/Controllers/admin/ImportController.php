<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\NewsImport;
use App\Models\City;



class ImportController extends Controller
{
    public function show()
    {
        // foreach (News::get() as $item) {
        //     dd($item);
        //     if ($item->grouping_id == null) {
        //         $item->update([
        //             'grouping_id'=>2
        //         ]);
        //     }
        // }
        return view('admin.import.show');
    }

    public function store(Request $request)
    {
        $path = $request->file('file')->getRealPath();
        $import = new NewsImport();
        $data = Excel::toArray($import, $request->file);
        //dd($data[0]);
        $i = 0;
        // foreach ($data[0] as $item) {
        //     $product = Product::whereid($item[0])->first();
        //      if ($product->id == 578) {
        //     dd($item[0].'-'.$item[6],'578-ورق-سیاه-2-میل-عرض-1000');
        //     //     if ($product->slug != $item[6]) {
        //     //         dd($item[0]);
        //     //     }
        //     $product->update([
        //         'slug'=>$item[0].'-'.$item[6]
        //     ]);
        //     }
        // }
        // foreach (Brand::get() as $item) {
        //     $item->update();
        // }
        //news
        // foreach ($data[0]as $item) {
        //     if ($i++ != 0) {
        //         //dd($item[0]);
        //         News::create([
        //             'id'=>$item[0],
        //             'grouping_id'=>2,
        //             'user_id'=>2,
        //             'title'=>$item[1],
        //             'slug'=>$item[2],
        //             'description'=>$item[3],
        //             'body'=>$item[6],
        //             'meta'=>$item[11],
        //             'created_at'=>$item[4],

        //         ]);
        //     }
        // }

        //category
        foreach ($data[0] as $item) {
            if ($i++ != 0) {
            City::create([
                'name'=>$item[2],
            ]);
        }
        }

        //brand
        // foreach ($data[0]as $item) {
        //     if ($i++ != 0) {
        //         Brand::create([
        //             'id'=>(int)$item[0],
        //             'name'=>$item[1],
        //             'images'=>'/upload/2023/5/1/ztJnlkhozestan.jpg',
        //         ]);
        //     }
            
        // }


        //Brandcategory
        // foreach ($data[0]as $item) {
        //     if ($i++ != 0) {
        //         if (Category::whereid((int)$item[1])->first()) {
        //             Brandcategory::create([
        //                 'category_id'=>(int)$item[1],
        //                 'brand_id'=>(int)$item[2],
        //                 //'images'=>'/upload/2023/5/1/ztJnlkhozestan.jpg',
        //             ]);
        //         }
                
        //     }
            
        // }

        //product
        // foreach ($data[0]as $item) {
        //     if ($i++ != 0) {
        //         if (Category::whereid((int)$item[1])->first()) {
        //             Product::create([
        //                 'id'=>(int)$item[0],
        //                 'user_id'=>2,
        //                 'category_id'=>(int)$item[1],
        //                 'brand_id'=>(int)$item[2],
        //                 'name'=>$item[5],
        //                 'slug'=>$item[6],
        //                 'body'=>'توضیخات خالی است',
        //                 'images'=>'/upload/2023/5/1/42BNKIMG2.png',
        //             ]);
        //         }
                
        //     }
            
        // }


        //price
        // foreach ($data[0]as $item) {
        //     if ($i++ != 0) {
        //         if (Product::whereid((int)$item[1])->first()) {
        //             if ($item[3] >= '2023-03-21') {
        //                 Price::create([
        //                     'product_id'=>(int)$item[1],
        //                     'user_id'=>2,
        //                     'price'=>(int)$item[2],
        //                     'created_at'=>$item[5],
        //                 ]);
        //             }
                    
        //         }
                
        //     }
            
        // }

    }
}
