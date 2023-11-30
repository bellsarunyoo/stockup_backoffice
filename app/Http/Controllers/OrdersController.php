<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpClient\HttpClient;
use Aws\S3\S3Client;

class OrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = DB::table('order.tbl_orders')
            ->selectRaw('tbl_orders.updated_date as updated_date,tbl_orders.*')
            ->where('status', '<>', 'ออเดอร์สำเร็จ')
            ->orderByDesc('tbl_orders.updated_date')
            ->get();

        $UpDateDayMax = DB::table('order.tbl_orders')
            ->where('status', '<>', 'ออเดอร์สำเร็จ')
            ->max('updated_date');
        // dd(compact('UpDateDayMax'));
        return view('order.order_list', compact('data', 'UpDateDayMax'));
    }

    public function OrdersList()
    {
        $data = DB::table('order.tbl_orders')
            ->where('status', '<>', 'ออเดอร์สำเร็จ')
            ->max('updated_date');

        return response()->json(['data' => $data]);
    }

    public function getData()
    {
        $OrderId = base64_decode(request()->id);
        $data = DB::table('order.tbl_orders')
            ->selectRaw('tbl_orders.status')
            ->where('tbl_orders.id', '=', $OrderId)->first();
        return response()->json(['data' => $data]);
    }


    public function OrdersInfo()
    {

        function GetPatchImages($PathImageName)
        {

            $client = new S3Client([
                'version' => 'latest',
                'region'  => 'sgp1',
                'endpoint' => 'https://sgp1.digitaloceanspaces.com',
                'use_path_style_endpoint' => false, // Configures to use subdomain/virtual calling format.
                'credentials' => [
                    'key'    => 'DO002DPZZJCRP3ZWX9G8',
                    'secret' => 'I4P0Z5qq2CbfBcNb0/vzpnsSwZrMLqKxcOpLzT+A844',
                ],
            ]);


            $cmd = $client->getCommand('GetObject', [
                'Bucket' => 'stockup-storage',
                'Key'    =>  $PathImageName
            ]);

            $request = $client->createPresignedRequest($cmd, '+15 minutes');
            // dd($request->getUri());
            return (string) $request->getUri();
        }



        if (!empty(request()->id)) {
            $OrderId = base64_decode(request()->id);
            // dd($OrderId);
            $data = DB::table('order.tbl_orders')
                ->leftJoin('user.tbl_users', 'user.tbl_users.id', '=', 'order.tbl_orders.customer_id')
                ->leftJoin('user.tbl_merchants', 'user.tbl_merchants.user_id', '=', 'order.tbl_orders.buyer')
                ->selectRaw('tbl_orders.id as orders_id,tbl_orders.plus_code as buyer_plus_code,tbl_orders.*,tbl_users.*,tbl_merchants.*')
                ->where('order.tbl_orders.id', $OrderId)->first();
            if (!empty($data->payslip_path)) {
                $DataImages = GetPatchImages('pay-slip/' . $data->payslip_path);
            } else {
                $DataImages = '../public/image/No_picture_available.png';
            }

            if (!empty($data->payment_picture)) {
                $BuyerQRCode = GetPatchImages('qr-code/' . $data->payment_picture);
            } else {
                // $BuyerQRCode = "{{asset('image/No_picture_available.png')}}";
                $BuyerQRCode = '../public/image/No_picture_available.png';
            }



            $seller = DB::table('order.tbl_orders')
                ->leftJoin('user.tbl_users', 'user.tbl_users.id', '=', 'order.tbl_orders.seller')
                ->leftJoin('user.tbl_merchants', 'user.tbl_merchants.user_id', '=', 'order.tbl_orders.seller')
                ->selectRaw('tbl_orders.id as orders_id,tbl_orders.*,tbl_users.*,tbl_merchants.*')
                ->where('order.tbl_orders.id', $OrderId)->first();
            // dd($data);

            $orders_details = DB::table('order.tbl_orders')
                ->join('invoice.tbl_product_invoice', 'invoice.tbl_product_invoice.order_id', '=', 'order.tbl_orders.id')
                ->leftJoin('product.tbl_electronics', 'product.tbl_electronics.id', '=', 'invoice.tbl_product_invoice.product_id')
                // ->leftJoin('user.tbl_users', 'user.tbl_users.id', '=', 'order.tbl_orders.customer_id')
                ->leftJoin('user.tbl_merchants', 'user.tbl_merchants.user_id', '=', 'order.tbl_orders.buyer')
                ->selectRaw('tbl_orders.id as orders_id,tbl_orders.*,tbl_merchants.*,
        tbl_product_invoice.serial_number as serial_number,
        tbl_product_invoice.model_number as model_number,
        tbl_product_invoice.*,
        tbl_electronics.status as electronics_status,
        tbl_electronics.name as electronics_name

        ')
                ->where('invoice.tbl_product_invoice.order_id', $OrderId)->get();

            $orders_details2 = DB::table('order.tbl_orders')
                ->join('invoice.tbl_product_invoice', 'invoice.tbl_product_invoice.order_id', '=', 'order.tbl_orders.id')
                ->leftJoin('product.tbl_electronics', 'product.tbl_electronics.id', '=', 'invoice.tbl_product_invoice.product_id')
                ->selectRaw('tbl_orders.id as orders_id,tbl_orders.*,
        tbl_product_invoice.serial_number as serial_number,
        tbl_product_invoice.model_number as model_number,
        tbl_product_invoice.*,
        tbl_electronics.status as electronics_status,
        tbl_electronics.name as electronics_name

        ')
                ->where('invoice.tbl_product_invoice.order_id', $OrderId)->get();
            // dd($orders_details2);
            // dd(compact('data', 'seller'));
            // dd(compact('data', 'BuyerQRCode', 'seller', 'DataImages', 'orders_details'));
            // return response()->json(['data' => $data]);
            return view('order.order_manage', compact('data', 'BuyerQRCode', 'seller', 'DataImages', 'orders_details'));
        } else {
            return redirect()->route('orders_all');
        }
    }


    public function update()
    {
        $OrderId = base64_decode(request()->id);
        $route = request()->title;
        $action = request()->action;
        $reason = request()->reason;
        // dd(request()->all());
        DB::beginTransaction();
        try {

            if ($route == 'payment') {
                $order_status = 'ชำระไม่สำเร็จ';
                if ($action == 'true') {
                    $order_status = 'รอผู้ขายตอบรับ';
                }
            }
            if ($route == 'confirm-seller') {
                $order_status = 'ตรวจสอบไม่สำเร็จ';
                if ($action == 'true') {
                    $order_status = 'รอไรเดอร์รับสินค้า';
                }
            }

            // if ($route == 'CallRider') {
            //     $order_status = 'กำลังนำส่ง';
            // }

            if ($route == 'RiderSending') {
                $order_status = 'กำลังนำส่ง';
            }
            if ($route == 'RiderSendSuccess') {
                $order_status = 'ส่งสำเร็จ';
            }

            if (!$reason) {
                DB::table('order.tbl_orders')
                    ->where('id', $OrderId)
                    ->update([
                        'status' => $order_status,
                        'updated_date' => Carbon::now()
                    ]);
            } else {
                DB::table('order.tbl_orders')
                    ->where('id', $OrderId)
                    ->update([
                        'status' => $order_status,
                        'reason' => $reason,
                        'updated_date' => Carbon::now()
                    ]);

                $orders_details = DB::table('order.tbl_orders')
                    ->join('invoice.tbl_product_invoice', 'invoice.tbl_product_invoice.order_id', '=', 'order.tbl_orders.id')
                    ->leftJoin('product.tbl_electronics', 'product.tbl_electronics.id', '=', 'invoice.tbl_product_invoice.product_id')
                    ->selectRaw('tbl_orders.id as orders_id,tbl_orders.*,
            tbl_product_invoice.serial_number as serial_number,
            tbl_product_invoice.model_number as model_number,
            tbl_product_invoice.*,
            tbl_electronics.status as electronics_status,
            tbl_electronics.name as electronics_name

            ')->where('invoice.tbl_product_invoice.order_id', $OrderId)->get();
                if (!empty($orders_details)) {

                    foreach ($orders_details as $getData) {
                        $AmountStock =  DB::table('product.tbl_electronics')->selectRaw('stock')->where('id', $getData->product_id)->first();
                        DB::table('product.tbl_electronics')
                            ->where('id', $getData->product_id)
                            ->update([
                                'stock' => intval($AmountStock->stock) + intval($getData->amount),
                                'updated_date' => Carbon::now()
                            ]);
                        DB::commit();
                    }
                }
            }

            DB::commit();
            $message = 'OK';
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
        }
        return response()->json(['message' => $message]);
    }



    public function send_sms()
    {
        try {

            // $externalUrl = 'https://api.publicapis.org/entries';

            $externalUrl = 'https://orca-app-egvcl.ondigitalocean.app/v1/api/sms/send';
            $bearerToken = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJFbWFpbCI6Im5ld3Vzcl9mcm9tX0RPM0BleGFtcGxlLmNvbSIsImV4cCI6MjI5NjY4NjI5OCwiaXNzIjoiQXV0aFNlcnZpY2UifQ.t2QCjsyRBr9OjYQa9cWrdQUrOw2p_pqz67UdmyV8A-I';

            // $response = Http::withHeaders([
            //     'Authorization' => 'Bearer ' . $bearerToken,
            // ])->get($externalUrl, [
            //     'userId' => request()->userId,
            // ]);
            $response = Http::get($externalUrl, [
                'userId' => request()->userId,
            ]);
            dd($response);
            // $statusCode = $response->status();
            $responseData = $response->json();
            return response()->json($responseData);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e], $response->status());
            // return response()->json([
            //     'status' => $statusCode,
            //     'data' => $responseData,
            // ]);
        }
    }

    public function show()
    {
        $client = new S3Client([
            'version' => 'latest',
            'region'  => getenv('SPACES_REGION'),
            'endpoint' => getenv('SPACES_ENDPOINT'),
            'use_path_style_endpoint' => false, // Configures to use subdomain/virtual calling format.
            'credentials' => [
                'key'    => getenv('SPACES_KEY'),
                'secret' => getenv('SPACES_SECRET'),
            ],
        ]);

        $cmd = $client->getCommand('GetObject', [
            'Bucket' => 'stockup-storage',
            'Key'    => 'pay-slip/qr_codeTest'
        ]);

        $request = $client->createPresignedRequest($cmd, '+15 minutes');
        $presignedUrl = (string) $request->getUri();

        return view('show', compact('presignedUrl'));
    }
}
