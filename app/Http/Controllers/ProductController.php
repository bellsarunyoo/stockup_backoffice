<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Product::query('id')->get());
        $data = DB::table('config.tbl_products')->selectRaw(
            'ROW_NUMBER() OVER (ORDER BY id ASC) AS row_num,
            id as pd_id,
            name as pd_name,
            brand as pd_brand,
            model as pd_model,
            description as pd_description,
            storage_capacity as pd_storage_capacity,
            color as pd_color,
            unit as pd_unit,
            price as pd_price,
            pre_tax as pd_pre_tax,
            release_date as pd_release_date,
            created_date as pd_created_date,
            updated_date as pd_updated_date'
        )->orderByDesc('release_date')->get();
        // )->orderByDesc('release_date')->get();

        // dd(compact('data'));
        return view('product.product_list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(Carbon::now()->format('ymdHiss'));
        if (request()->all()) {
            $CheckDuplicate = DB::table('config.tbl_products')
                ->where([
                    ['brand', request()->ProductBrand],
                    ['model',  request()->ProductName],
                    ['color',  request()->ProductColor],
                    ['storage_capacity',  request()->ProductCapacity],
                    ['price',  request()->ProductPrice]
                ])->first();
        }

        if (empty($CheckDuplicate)) {

            DB::beginTransaction();
            try {
                DB::insert(
                    'insert into config.tbl_products (id,brand,model,color,storage_capacity,price,release_date,created_date) values (?,?,?,?,?,?,?,?)',
                    [
                        Carbon::now()->format('ymdHiss'),
                        request()->ProductBrand,
                        request()->ProductName,
                        request()->ProductColor,
                        request()->ProductCapacity,
                        request()->ProductPrice,
                        Carbon::now(),
                        Carbon::now()
                    ],

                );

                DB::commit();
                $message = 'OK';
                // $data = DB::table('config.tbl_products')->where('id', '=', Carbon::now()->format('ymdHiss'))->get();
                // foreach ($data as $key => $value) {
                //     $pd = [$key => $value];
                // }
                // session(['action' => 'success']);

                // return redirect()->action(
                //     [ProductController::class, 'store'],
                //     ['id' => base64_encode($pd[0]->id)]
                // );
                return redirect()->action([ProductController::class, 'index']);
            } catch (\Exception $e) {
                DB::rollBack();
                $message = $e;
                session(['action' => 'action ' . $e]);
                return view('product.product_manage');
            }
        } else {
            $message = 'duplicated';
            session(['action' => 'duplicated']);
            return view('product.product_manage');
        }
        // return response()->json(['message' => $message]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // dd(request()->id);

        if (request()->id) {
            $data = DB::table('config.tbl_products')
                ->where('id', '=', base64_decode(request()->id))->get();
            foreach ($data as $key => $value) {
                $pd = [$key => $value];
            }
            // dd(compact('pd'));
            // return response()->json(['data' => $data]);
            return view('product.product_manage', compact('pd'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function update()
    {
        $ProductId = base64_decode(request()->PdId);

        // dd($ProductId);
        DB::beginTransaction();
        try {
            if (!empty($ProductId)) {
                DB::table('config.tbl_products')
                    ->where('id', $ProductId)
                    ->update([
                        'brand' => request()->ProductBrand,
                        'model' => request()->ProductName,
                        'storage_capacity' => request()->ProductCapacity,
                        'color' => request()->ProductColor,
                        'price' => request()->ProductPrice,
                        'release_date' => Carbon::now(),
                        'updated_date' => Carbon::now()
                    ]);
                DB::commit();
                $message = 'OK';
                // session(['action' => 'success']);
                // return redirect()->action(
                //     [ProductController::class, 'store'],
                //     ['id' => base64_encode($ProductId)]
                // );
                return redirect()->action([ProductController::class, 'index']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e;
            session(['action' => 'error']);
            return redirect()->action(
                [ProductController::class, 'store'],
                ['id' => base64_encode($ProductId)]
            );
        }
        // return response()->json(['message' => $message]);
    }

    public function forgetSession()
    {
        // dd(request()->key);
        session()->forget(request()->key);
        return response()->json(['message' => 'OK']);
    }


    /* Update model Database */
    public function update_model()
    {
        // dd(Product::query('id')->get());
        $data = DB::table('config.tbl_products')->selectRaw(
            'id,
            name,
            brand,
            model'
        )->get();
        // )->orderByDesc('release_date')->get();
        // dd(Count($data));

        DB::beginTransaction();
        try {
            if (!empty($data)) {
                $i = 0;
                foreach ($data as $getData) {
                    DB::table('config.tbl_products')
                        ->where('id', $getData->id)
                        ->update([
                            'model' => $getData->name,
                        ]);

                    $i += 1;
                    DB::commit();
                }

                $message = 'OK = ' . $i;
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
        }

        return $message;
    }
}