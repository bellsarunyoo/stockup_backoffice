@extends("layout.master")
@section("content")
    <nav class="navbar navbar-expand-lg">
        <!-- Container wrapper -->
        <div class="container-fluid">

            <a class="btn text-info border-0" href="{{ url("orders") }}">
                <h4>
                    <i>
                        <img class="text-info" src="{{ asset("image/icon/chevron-left.svg") }}">
                    </i>
                    หน้าจัดการออเดอร์
                </h4>
            </a>

        </div>
    </nav>

    <div class="container-fluid">
        <div class="embed-responsive from-control">
            <!-- Section1 -->
            <div class="row p-lg-2">
                <div class="col">
                    <h5>กระบวนการทั่วไป</h5>

                    <div class="card card-body bg-dark-subtle bg-opacity-8 align-middle">

                        <div class="card-title d-flex justify-content-between">

                            <h5>1.การชำระเงิน</h5>
                            @if ($data->status == "รอตรวจสอบการชำระ")
                                <a class="btn text-warning bg-warning-subtle">
                                    <h5>กำลังดำเนินการ</h5>
                                </a>
                            @elseif (
                                $data->status == "ชำระสำเร็จ" or
                                    $data->status == "รอผู้ขายตอบรับ" or
                                    $data->status == "ตอบรับ" or
                                    $data->status == "รอผู้ขายยืนยัน" or
                                    $data->status == "ตรวจสอบสำเร็จ" or
                                    $data->status == "รอไรเดอร์รับสินค้า" or
                                    $data->status == "กำลังนำส่ง" or
                                    $data->status == "ส่งสำเร็จ" or
                                    $data->status == "รอผู้ซื้อตรวจสอบสินค้า" or
                                    $data->status == "ออเดอร์สำเร็จ" or
                                    $data->status == "อยู่ระหว่างการนำส่ง" or
                                    $data->status == "ปฏิเสธคำสั่งซื้อ" or
                                    $data->status == "ตรวจสอบไม่สำเร็จ" or
                                    $data->status == "ออเดอร์ไม่สำเร็จ" or
                                    $data->status == "ผู้ขายปฏิเสธ" or
                                    $data->status == "ตรวจสอบไม่สำเร็จ" or
                                    $data->status == "รอยืนยันข้อมูล")
                                <a class="btn text-success bg-success-subtle">
                                    <h5>สำเร็จ</h5>
                                </a>
                            @elseif ($data->status == "ชำระไม่สำเร็จ")
                                <a class="btn text-dark bg-danger-subtle">
                                    <h5>{{ $data->status }}</h5>
                                </a>
                            @endif
                        </div>

                        @if ($data->status == "รอตรวจสอบการชำระ")
                            <div class="card-subtitle">รายละเอียดการโอนเงิน</div>
                            <div class="embed-responsive-16by9">
                                <div class="row">
                                    <div class="col align-items-start">
                                        <div class="row mb-1">
                                            <label class="col-sm-2 col-form-label" for="shopname">ชื่อร้าน</label>
                                            <div class="col-sm-8">
                                                <input class="form-control-plaintext text-info" id="shopname"
                                                    type="text" value="{{ $data->shop_name ?? "" }}" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <label class="col-sm-2 col-form-label" for="ownershop">ชื่อเจ้าของร้าน</label>
                                            <div class="col-sm-8">
                                                <input class="form-control-plaintext text-info" id="ownershop"
                                                    type="text"
                                                    value="{{ $data->prefix . " " . $data->first_name . "   " . $data->last_name ?? "" }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <label class="col-sm-2 col-form-label" for="paymentAmount">ยอดโอนสุทธิ</label>
                                            <div class="col-sm-8">
                                                <input class="form-control-plaintext text-info" id="paymentAmount"
                                                    type="text" value="{{ number_format($data->price) ?? "" }}" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <label class="col-sm-2 col-form-label" for="ownershop">เบอร์โทรศัพท์</label>
                                            <div class="col-sm-8">
                                                <input class="form-control-plaintext text-info" id="saller_mobile"
                                                    type="text" value="{{ $data->phone_no ?? "" }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label" for="slip">สลิปการโอนเงิน</label>

                                        </div>
                                        <div class="row">
                                            <picture>

                                                <img class="border-1" src="{{ $DataImages ?? "" }}" alt="slip"
                                                    max-width="50%">
                                            </picture>
                                        </div>

                                        <div class="float-end d-flex justify-content-between col-sm-4 p-2">
                                            <button class="btn btn-outline-secondary confirm" data-action="false"
                                                data-set="payment" data-title="สลิปการโอนเงิน" type="button"
                                                value="{{ base64_encode($data->orders_id ?? "") }}">ไม่ถูกต้อง</button>
                                            <button type="button" class="btn btn-outline-success confirm"
                                                data-seller="@isset($orders_details){{ $orders_details[0]->seller ?? "" }}@endif"
                                        data-action="true" data-set="payment" data-title="สลิปการโอนเงิน"
                                        value="{{ base64_encode($data->orders_id ?? "") }}">ถูกต้อง</button>

                                </div>


                            </div>

                        </div>

                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Section2 -->
        <div class="row p-lg-2">
            <div class="col">
                <div class="align-middle card card-body">
                    <div class="d-flex justify-content-between">
                        <h5>2.พิจารณาคำสั่งซื้อ</h5>

                        @if ($data->status == "ชำระสำเร็จ" or $data->status == "รอผู้ขายยืนยัน" or $data->status == "รอผู้ขายตอบรับ")
                        <a class="btn text-warning bg-warning-subtle">
                            <h5>กำลังดำเนินการ</h5>
                        </a>
                        @elseif (
                            $data->status == "ตอบรับ" or
                                $data->status == "ตรวจสอบสำเร็จ" or
                                $data->status == "รอไรเดอร์รับสินค้า" or
                                $data->status == "กำลังนำส่ง" or
                                $data->status == "ส่งสำเร็จ" or
                                $data->status == "รอผู้ซื้อตรวจสอบสินค้า" or
                                $data->status == "ออเดอร์สำเร็จ" or
                                $data->status == "อยู่ระหว่างการนำส่ง" or
                                $data->status == "ตรวจสอบไม่สำเร็จ" or
                                $data->status == "ออเดอร์ไม่สำเร็จ" or
                                $data->status == "รอยืนยันข้อมูล")
                        <a class="btn text-success bg-success-subtle">
                            <h5>สำเร็จ</h5>
                        </a>
                        @elseif ($data->status == "ปฏิเสธคำสั่งซื้อ" or $data->status == "ผู้ขายปฏิเสธ")
                        <a class="btn text-dark bg-danger-subtle">
                            <h5>{{ $data->status }}</h5>
                        </a>
                        @endif
                    </div>

                </div>
            </div>
        </div>


        <!-- Section3 -->
        <div class="row p-lg-2">
            <div class="col">
                <div class="align-middle card card-body bg-dark-subtle">
                    <div class="d-flex justify-content-between">
                        <h5> 3.ยืนยันข้อมูล</h5>

                        @if ($data->status == "ยืนยันข้อมูล" or $data->status == "รอยืนยันข้อมูล")
                        <a class="btn text-warning bg-warning-subtle">
                            <h5>กำลังดำเนินการ</h5>
                        </a>
                        @elseif (
                            $data->status == "ตรวจสอบสำเร็จ" or
                                $data->status == "ตอบรับ" or
                                $data->status == "ตรวจสอบสำเร็จ" or
                                $data->status == "รอไรเดอร์รับสินค้า" or
                                $data->status == "กำลังนำส่ง" or
                                $data->status == "ส่งสำเร็จ" or
                                $data->status == "รอผู้ซื้อตรวจสอบสินค้า" or
                                $data->status == "ออเดอร์สำเร็จ" or
                                $data->status == "อยู่ระหว่างการนำส่ง" or
                                $data->status == "ออเดอร์ไม่สำเร็จ")
                        <a class="btn text-success bg-success-subtle">
                            <h5> สำเร็จ</h5>
                        </a>
                        @elseif ($data->status == "ตรวจสอบไม่ผ่าน" or $data->status == "ตรวจสอบไม่สำเร็จ")
                        <a class="btn text-dark btn-block bg-danger-subtle">
                            <h5>{{ $data->status }}</h5>
                        </a>
                        @endif
                    </div>
                    @if ($data->status == "ยืนยันข้อมูล" or $data->status == "รอยืนยันข้อมูล")

                    <div class="card card-body" >
                        <div class="embed-responsive-16by9">
                            <div class="row border-1">
                                <div class="card">
                                    <div class="card-body">
                                        <h6>ข้อมูลการติดต่อ</h6>
                                        <div class="container">
                                            <div class="row justify-content-start">
                                                <div class="col-4">
                                                    <div class="mb-1 row">
                                                        <label for="shopname"
                                                            class="col-sm-4 col-form-label">ชื่อร้านผู้ขาย</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" readonly
                                                                class="form-control-plaintext text-info"
                                                                id="saller_name" value="{{ $data->shop_name ?? "" }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-1 row">
                                                        <label for="ownershop"
                                                            class="col-sm-4 col-form-label">เบอร์โทรผู้ขาย</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" readonly
                                                                class="form-control-plaintext text-info"
                                                                id="saller_mobile" value="{{ $data->phone_no ?? "" }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-1 row">
                                                        <label for="shopname"
                                                            class="col-sm-4 col-form-label">ชื่อร้านผู้ซื้อ</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" readonly
                                                                class="form-control-plaintext text-info" id="buyer_name"
                                                                value="{{ $data->merchant_name ?? "" }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-1 row">
                                                        <label for="ownershop"
                                                            class="col-sm-4 col-form-label">เบอร์โทรผู้ซื้อ</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" readonly
                                                                class="form-control-plaintext text-info"
                                                                id="buyer_mobile"
                                                                value="{{ $data->merchant_phone ?? "" }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="confirm-seller" >
                                @isset($orders_details)
                                @foreach ($orders_details as $i => $data)
                                <div class="row p-md-2 border border-secondary rounded">
                                    <div class="row mb-2 fs-4">
                                        รายการที่ {{ $i + 1 }}/{{ count($orders_details) }}
                                    </div>
                                    <div class="col-2">
                                        {{-- <div class="align-middle">
                                            <picture>
                                                <img src="https://stockup-storage.sgp1.cdn.digitaloceanspaces.com/pay-slip/car.jpg"
                                                    class="border-1" max-width="50%" alt="demo1">
                                            </picture>
                                        </div> --}}
                                    </div>

                                    <div class="col-4">
                                        <div class="row mb-3">
                                            <div class="card-body">
                                                <h5 class="card-subtitle fs-4">
                                                    {{ $data->electronics_name ?? "" }}
                                                    @if ($data->electronics_status == "แท้มือ1")
                                                    <span class="badge rounded-pill bg-warning bg-opacity-10">
                                                        <span>
                                                            <img sizes="50" src="{{ asset("image/icon/1.svg") }}" alt="">
                                                        </span>
                                                        <span class="text-black font-weight-bold">
                                                            {{ $data->electronics_status }}
                                                        </span>
                                                    </span>
                                                    @elseif ($data->electronics_status == "แท้มือ2")
                                                    <span class="badge rounded-pill bg-success bg-opacity-10">
                                                        <span>
                                                            <img sizes="50" src="{{ asset("image/icon/2.svg") }}" alt="">
                                                        </span>
                                                        <span
                                                            class="text-black font-weight-bold">{{ $data->electronics_status }}</span>
                                                    </span>
                                                    @endif
                                                </h5>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="card rounded-pill" style="width: 20rem;">
                                                <div class="card-body">
                                                    <h6 class="card-title text-muted">Serial Number (12หลัก)</h6>
                                                    <h5 class="card-subtitle">{{ $data->serial_number ?? "-" }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="card rounded-pill" style="width: 20rem;">
                                                <div class="card-body">
                                                    <h6 class="card-title text-muted">Model Number (8หลัก)</h6>
                                                    <h5 class="card-subtitle">{{ $data->model_number ?? "-" }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md">
                                        <div class="row align-items-end">
                                            <div class="p-2 align-items-end d-flex justify-content-between col-sm-10">
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="radio" value="OK"
                                                        name="ConfirmProduct_{{ $i + 1 }}"
                                                        id="RadioConfirmProduct_{{ $i + 1 }}">
                                                    <label class="form-check-label" for="RadioConfirmProduct_{{ $i + 1 }}">
                                                        ถูกต้อง
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="NO"
                                                        name="ConfirmProduct_{{ $i + 1 }}" id="RadioCancelProduct_{{ $i + 1 }}"
                                                        checked>
                                                    <label class="form-check-label" for="RadioCancelProduct_{{ $i + 1 }}">
                                                        ไม่ถูกต้อง
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @endforeach


                                <div class="col ">
                                    <div class="p-2 float-end align-items-end d-flex justify-content-between col-sm-2">
                                        <button type="button" class="btn btn-outline-secondary confirm"
                                            data-action="false" data-set="confirm-seller" data-title="ข้อมูลการซื้อขาย"
                                            value="{{ base64_encode($data->orders_id ?? "") }}">ไม่ถูกต้อง</button>
                                        <button type="button" class="btn btn-outline-success confirm" data-action="true"
                                            data-set="confirm-seller" data-title="ข้อมูลการซื้อขาย"
                                            value="{{ base64_encode($data->orders_id ?? "") }}">ถูกต้อง</button>
                                    </div>

                                </div>
                                @endisset
                            </div>
                        </div>
                    </div>
@endif
                </div>
            </div>
        </div>

        <!-- Section4 -->
        <div class="row
                                                p-lg-2">
                                                <div class="col">
                                                    <div class="card card-body bg-dark-subtle align-middle">
                                                        <div class="d-flex justify-content-between">
                                                            <h5>4.เเพ็คสินค้า,เรียกไรเดอร์ไปรับของ</h5>
                                                            @if ($data->status == "ตรวจสอบสำเร็จ")
                                                                <a class="btn text-warning bg-warning-subtle">
                                                                    <h5>กำลังดำเนินการ</h5>
                                                                </a>
                                                            @elseif (
                                                                $data->status == "รอไรเดอร์รับสินค้า" or
                                                                    $data->status == "อยู่ระหว่างการนำส่ง" or
                                                                    $data->status == "กำลังนำส่ง" or
                                                                    $data->status == "ส่งสำเร็จ" or
                                                                    $data->status == "ออเดอร์สำเร็จ" or
                                                                    $data->status == "ออเดอร์ไม่สำเร็จ")
                                                                <a class="btn text-success bg-success-subtle">
                                                                    <h5> สำเร็จ</h5>
                                                                </a>
                                                            @elseif ($data->status == "ตรวจสอบไม่ผ่าน")
                                                                <!-- <a class="btn text-dark bg-danger-subtle">
                                                                                                                            <h5>{{ $data->status }}</h5>
                                                                                                                        </a> -->
                                                            @endif

                                                        </div>
                                                        @if ($data->status == "ตรวจสอบสำเร็จ")
                                                            <div class="row border-1">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h6>รายละเอียดการส่งของ</h6>
                                                                        <div class="container">
                                                                            <div class="row justify-content-start">
                                                                                <div class="col-4">
                                                                                    <h6>ผู้ส่ง(ผู้ขาย)</h6>
                                                                                    <div class="row mb-1">
                                                                                        <label
                                                                                            class="col-sm-4 col-form-label"
                                                                                            for="shopname">ชื่อร้านผู้ขาย</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input
                                                                                                class="form-control-plaintext text-info"
                                                                                                id="saller_name"
                                                                                                type="text"
                                                                                                value="{{ $data->shop_name ?? "" }}"
                                                                                                readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mb-1">
                                                                                        <label
                                                                                            class="col-sm-4 col-form-label"
                                                                                            for="ownershop">เบอร์โทรผู้ขาย</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input
                                                                                                class="form-control-plaintext text-info"
                                                                                                id="saller_mobile"
                                                                                                type="text"
                                                                                                value="{{ $data->phone_no ?? "" }}"
                                                                                                readonly>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row mb-1">
                                                                                        <label
                                                                                            class="col-sm-4 col-form-label"
                                                                                            for="ownershop">ที่อยู่</label>
                                                                                        <div class="col-sm-8 fs-4">
                                                                                            <a href="https://maps.app.goo.gl/yP5Ln8twGVsV3ihS6"
                                                                                                target="_blank">
                                                                                                <i>
                                                                                                    <img class="text-info btn btn-outline-info"
                                                                                                        src="{{ asset("image/icon/geo-alt-fill.svg") }}">
                                                                                                </i>
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-4">
                                                                                    <h6>ผู้รับ(ผู้ซื้อ)</h6>
                                                                                    <div class="row mb-1">
                                                                                        <label
                                                                                            class="col-sm-4 col-form-label"
                                                                                            for="shopname">ชื่อร้านผู้ซื้อ</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input
                                                                                                class="form-control-plaintext text-info"
                                                                                                id="buyer_name"
                                                                                                type="text"
                                                                                                value="{{ $data->merchant_name ?? "" }}"
                                                                                                readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mb-1">
                                                                                        <label
                                                                                            class="col-sm-4 col-form-label"
                                                                                            for="ownershop">เบอร์โทรผู้ซื้อ</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input
                                                                                                class="form-control-plaintext text-info"
                                                                                                id="buyer_mobile"
                                                                                                type="text"
                                                                                                value="{{ $data->merchant_phone ?? "" }}"
                                                                                                readonly>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row mb-1">
                                                                                        <label
                                                                                            class="col-sm-4 col-form-label"
                                                                                            for="buyer_map">ที่อยู่</label>
                                                                                        <div class="col-sm-8 fs-4">
                                                                                            <a href="https://www.google.com/maps/@18.0648224,99.2475564,3a,75y,335.91h,65.18t/data=!3m9!1e1!3m7!1s16iZ3PxBPCSquHC2vU090A!2e0!7i16384!8i8192!9m2!1b1!2i39?entry=ttu"
                                                                                                target="_blank">
                                                                                                <i>
                                                                                                    <img class="text-info btn btn-outline-info"
                                                                                                        src="{{ asset("image/icon/geo-alt-fill.svg") }}">
                                                                                                </i>
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col">
                                                                                    <div
                                                                                        class="row align-items-end float-end col-sm-6 p-2">
                                                                                        <button
                                                                                            class="btn btn-outline-success confirm"
                                                                                            data-action="true"
                                                                                            data-set="CallRider"
                                                                                            data-title="" type="button"
                                                                                            value="{{ base64_encode($data->orders_id ?? "") }}">เรียกไรเดอร์เรียบร้อย</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                        </div>

                                        <!-- Section5 -->
                                        <div class="row p-lg-2">
                                            <div class="col">
                                                <div class="card card-body bg-dark-subtle align-middle">
                                                    <div class="d-flex justify-content-between">
                                                        <h5> 5.ไรเดอร์รับสินค้าแล้ว</h5>

                                                        @if ($data->status == "รอไรเดอร์รับสินค้า")
                                                            <a class="btn text-warning bg-warning-subtle">
                                                                <h5>กำลังดำเนินการ</h5>
                                                            </a>
                                                        @elseif (
                                                            $data->status == "กำลังนำส่ง" or
                                                                $data->status == "ส่งสำเร็จ" or
                                                                $data->status == "อยู่ระหว่างการนำส่ง" or
                                                                $data->status == "ออเดอร์ไม่สำเร็จ")
                                                            <a class="btn text-success bg-success-subtle">
                                                                <h5> สำเร็จ</h5>
                                                            </a>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        @if ($data->status == "รอไรเดอร์รับสินค้า")
                                                            <div class="row border-1">
                                                                <div class="col">
                                                                    <div class="float-end col-sm-2">
                                                                        <button class="btn btn-outline-success confirm"
                                                                            data-action="true" data-set="RiderSending"
                                                                            data-title="ไรเดอร์" type="button"
                                                                            value="{{ base64_encode($data->orders_id ?? "") }}">รับสินค้าแล้ว</button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Section6 -->
                                        <div class="row p-lg-2">
                                            <div class="col">
                                                <div class="card card-body bg-dark-subtle align-middle">
                                                    <div class="d-flex justify-content-between">
                                                        <h5> 6.ส่งสินค้าสำเร็จ</h5>
                                                        @if ($data->status == "กำลังนำส่ง" or $data->status == "อยู่ระหว่างการนำส่ง")
                                                            <a class="btn text-warning bg-warning-subtle">
                                                                <h5>กำลังดำเนินการ</h5>
                                                            </a>
                                                        @elseif ($data->status == "ส่งสำเร็จ" or $data->status == "ออเดอร์ไม่สำเร็จ")
                                                            <a class="btn text-success bg-success-subtle">
                                                                <h5> สำเร็จ</h5>
                                                            </a>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        @if ($data->status == "กำลังนำส่ง" or $data->status == "อยู่ระหว่างการนำส่ง")
                                                            <div class="row border-1">
                                                                <div class="col">
                                                                    <div class="float-end col-sm-2">
                                                                        <button class="btn btn-outline-success confirm"
                                                                            data-action="true" data-set="RiderSendSuccess"
                                                                            data-title="ไรเดอร์" type="button"
                                                                            value="{{ base64_encode($data->orders_id ?? "") }}">ส่งสำเร็จ</button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Section7 -->
                                        <div class="row p-lg-2">
                                            <div class="col">
                                                <div class="card card-body align-middle">
                                                    <div class="d-flex justify-content-between">
                                                        <h5> 7.ตรวจสอบสินค้า</h5>
                                                        @if ($data->status == "ส่งสำเร็จ")
                                                            <a class="btn text-warning bg-warning-subtle">
                                                                <h5>กำลังดำเนินการ</h5>
                                                            </a>
                                                        @elseif ($data->status == "ส่งสำเร็จ")
                                                            <a class="btn text-success bg-success-subtle">
                                                                <h5> สำเร็จ</h5>
                                                            </a>
                                                        @elseif ($data->status == "ออเดอร์ไม่สำเร็จ")
                                                            <a class="btn text-dark bg-danger-subtle">
                                                                <h5>{{ $data->status }}</h5>
                                                            </a>
                                                        @endif
                                                    </div>
                                                    <!-- รอผู้ซื้อตรวจสอบสินค้า -->

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Section Cancal -->
                                        <div class="bg-secondary bg-gradient">
                                            <!-- Section Cancal 1-->
                                            <div class="row p-lg-2 bg-gradient">
                                                <div class="">
                                                    <h5> กรณีที่ไม่สำเร็จ</h5>
                                                </div>
                                                <div class="col">
                                                    <div class="card card-body align-middle">
                                                        <div class="d-flex justify-content-between">
                                                            <h5> 1.ชำระไม่สำเร็จ</h5>
                                                            <div class="card-title d-flex justify-content-between">
                                                                @if ($data->status == "ชำระไม่สำเร็จ")
                                                                    <a class="btn text-dark bg-danger-subtle">
                                                                        <h5>{{ $data->status }}</h5>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @if ($data->status == "ชำระไม่สำเร็จ")
                                                            <div class="card card-body align-middle">

                                                                <div class="card-subtitle">รายละเอียดผู้ซื้อ</div>
                                                                <div class="embed-responsive-16by9">
                                                                    <div class="row">
                                                                        <div class="col align-items-start">
                                                                            <div class="row mb-1">
                                                                                <label class="col-sm-2 col-form-label"
                                                                                    for="shopname">ชื่อร้าน</label>
                                                                                <div class="col-sm-8">
                                                                                    <input
                                                                                        class="form-control-plaintext text-info"
                                                                                        id="shopname" type="text"
                                                                                        value="{{ $data->shop_name ?? "" }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-1">
                                                                                <label class="col-sm-2 col-form-label"
                                                                                    for="ownershop">ชื่อเจ้าของร้าน</label>
                                                                                <div class="col-sm-8">
                                                                                    <input
                                                                                        class="form-control-plaintext text-info"
                                                                                        id="ownershop" type="text"
                                                                                        value="{{ $data->prefix . " " . $data->first_name . "   " . $data->last_name ?? "" }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-1">
                                                                                <label class="col-sm-2 col-form-label"
                                                                                    for="paymentAmount">ยอดโอนสุทธิ</label>
                                                                                <div class="col-sm-8">
                                                                                    <input
                                                                                        class="form-control-plaintext text-info"
                                                                                        id="paymentAmount" type="text"
                                                                                        value="{{ number_format($data->price) ?? "" }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-1">
                                                                                <label class="col-sm-2 col-form-label"
                                                                                    for="ownershop">เบอร์โทรศัพท์</label>
                                                                                <div class="col-sm-8">
                                                                                    <input
                                                                                        class="form-control-plaintext text-info"
                                                                                        id="saller_mobile" type="text"
                                                                                        value="{{ $data->phone_no ?? "" }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="row mb-3">
                                                                                <label class="col-sm-3 col-form-label"
                                                                                    for="slip">Qr-code ผู้ซื้อ</label>

                                                                            </div>
                                                                            <div class="row">
                                                                                <picture>
                                                                                    <img class="border-1"
                                                                                        src="{{ $DataImages ?? "" }}"
                                                                                        alt="slip" max-width="50%">
                                                                                </picture>
                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Section Cancal 2-->
                                            <div class="row p-lg-2">
                                                <div class="col">
                                                    <div class="card card-body align-middle">
                                                        <div class="d-flex justify-content-between">
                                                            <h5> 2.ผู้ขายปฏิเสธ</h5>
                                                            <div class="card-title d-flex justify-content-between">
                                                                @if ($data->status == "ปฏิเสธคำสั่งซื้อ" or $data->status == "ผู้ขายปฏิเสธ")
                                                                    <a class="btn text-dark bg-danger-subtle">
                                                                        <h5>{{ $data->status }}</h5>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @if ($data->status == "ปฏิเสธคำสั่งซื้อ" or $data->status == "ผู้ขายปฏิเสธ")
                                                            <div class="card card-body align-middle">
                                                                <div class="card-subtitle">รายละเอียดผู้ซื้อ</div>
                                                                <div class="embed-responsive-16by9">
                                                                    <div class="row">
                                                                        <div class="col align-items-start">
                                                                            <div class="row mb-1">
                                                                                <label class="col-sm-2 col-form-label"
                                                                                    for="shopname">ชื่อร้าน</label>
                                                                                <div class="col-sm-8">
                                                                                    <input
                                                                                        class="form-control-plaintext text-info"
                                                                                        id="shopname" type="text"
                                                                                        value="{{ $data->shop_name ?? "" }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-1">
                                                                                <label class="col-sm-2 col-form-label"
                                                                                    for="ownershop">ชื่อเจ้าของร้าน</label>
                                                                                <div class="col-sm-8">
                                                                                    <input
                                                                                        class="form-control-plaintext text-info"
                                                                                        id="ownershop" type="text"
                                                                                        value="{{ $data->prefix . " " . $data->first_name . "   " . $data->last_name ?? "" }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-1">
                                                                                <label class="col-sm-2 col-form-label"
                                                                                    for="paymentAmount">ยอดโอนสุทธิ</label>
                                                                                <div class="col-sm-8">
                                                                                    <input
                                                                                        class="form-control-plaintext text-info"
                                                                                        id="paymentAmount" type="text"
                                                                                        value="{{ number_format($data->price) ?? "" }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-1">
                                                                                <label class="col-sm-2 col-form-label"
                                                                                    for="ownershop">เบอร์โทรศัพท์</label>
                                                                                <div class="col-sm-8">
                                                                                    <input
                                                                                        class="form-control-plaintext text-info"
                                                                                        id="saller_mobile" type="text"
                                                                                        value="{{ $data->phone_no ?? "" }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="row mb-3">
                                                                                <label class="col-sm-3 col-form-label"
                                                                                    for="slip">Qr-code ผู้ซื้อ</label>

                                                                            </div>
                                                                            <div class="row">
                                                                                <picture>
                                                                                    <img class="border-1"
                                                                                        src="{{ $DataImages ?? "" }}"
                                                                                        alt="slip" max-width="50%">
                                                                                </picture>
                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Section Cancal 3-->
                                            <div class="row p-lg-2">
                                                <div class="col">
                                                    <div class="card card-body align-middle">
                                                        <div class="d-flex justify-content-between">
                                                            <h5> 3.ตรวจสอบไม่สำเร็จ</h5>
                                                            <div class="card-title d-flex justify-content-between">
                                                                @if ($data->status == "ตรวจสอบไม่สำเร็จ")
                                                                    <a class="btn text-dark bg-danger-subtle">
                                                                        <h5>{{ $data->status }}</h5>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @if ($data->status == "ตรวจสอบไม่สำเร็จ")
                                                            <div class="card card-body align-middle">
                                                                <div class="card-subtitle">รายละเอียดผู้ซื้อ</div>
                                                                <div class="embed-responsive-16by9">
                                                                    <div class="row">
                                                                        <div class="col align-items-start">
                                                                            <div class="row mb-1">
                                                                                <label class="col-sm-2 col-form-label"
                                                                                    for="shopname">ชื่อร้าน</label>
                                                                                <div class="col-sm-8">
                                                                                    <input
                                                                                        class="form-control-plaintext text-info"
                                                                                        id="shopname" type="text"
                                                                                        value="{{ $data->shop_name ?? "" }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-1">
                                                                                <label class="col-sm-2 col-form-label"
                                                                                    for="ownershop">ชื่อเจ้าของร้าน</label>
                                                                                <div class="col-sm-8">
                                                                                    <input
                                                                                        class="form-control-plaintext text-info"
                                                                                        id="ownershop" type="text"
                                                                                        value="{{ $data->prefix . " " . $data->first_name . "   " . $data->last_name ?? "" }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-1">
                                                                                <label class="col-sm-2 col-form-label"
                                                                                    for="paymentAmount">ยอดโอนสุทธิ</label>
                                                                                <div class="col-sm-8">
                                                                                    <input
                                                                                        class="form-control-plaintext text-info"
                                                                                        id="paymentAmount" type="text"
                                                                                        value="{{ number_format($data->price) ?? "" }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-1">
                                                                                <label class="col-sm-2 col-form-label"
                                                                                    for="ownershop">เบอร์โทรศัพท์</label>
                                                                                <div class="col-sm-8">
                                                                                    <input
                                                                                        class="form-control-plaintext text-info"
                                                                                        id="saller_mobile" type="text"
                                                                                        value="{{ $data->phone_no ?? "" }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="row mb-3">
                                                                                <label class="col-sm-3 col-form-label"
                                                                                    for="slip">Qr-code ผู้ซื้อ</label>

                                                                            </div>
                                                                            <div class="row">
                                                                                <picture>
                                                                                    <img class="border-1"
                                                                                        src="{{ $DataImages ?? "" }}"
                                                                                        alt="slip" max-width="50%">
                                                                                </picture>
                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Section Cancal 4-->
                                            <div class="row p-lg-2">
                                                <div class="col">
                                                    <div class="card card-body align-middle">
                                                        <div class="d-flex justify-content-between">
                                                            <h5>4.ส่งสินค้าไม่สำเร็จ</h5>
                                                            <div class="card-title d-flex justify-content-between">
                                                                @if ($data->status == "ส่งสินค้าไม่สำเร็จ")
                                                                    <a class="btn text-dark bg-danger-subtle">
                                                                        <h5>{{ $data->status }}</h5>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Section Cancal 5-->
                                            <div class="row p-lg-2">
                                                <div class="col">
                                                    <div class="card card-body align-middle">
                                                        <div class="d-flex justify-content-between">
                                                            <h5>5.ออเดอร์ไม่สำเร็จ</h5>
                                                            <div class="card-title d-flex justify-content-between">
                                                                @if ($data->status == "ออเดอร์ไม่สำเร็จ")
                                                                    <a class="btn text-dark bg-danger-subtle">
                                                                        <h5>{{ $data->status }}</h5>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @if ($data->status == "ออเดอร์ไม่สำเร็จ")
                                                            <div class="card card-body align-middle">
                                                                <div class="card-subtitle">
                                                                    <h5>รายละเอียดผู้ซื้อ</h5>
                                                                </div>
                                                                <div class="embed-responsive-16by9">
                                                                    <div class="row">
                                                                        <div class="col align-items-start">
                                                                            <div class="row mb-1">
                                                                                <label class="col-sm-2 col-form-label"
                                                                                    for="shopname">ชื่อร้าน</label>
                                                                                <div class="col-sm-8">
                                                                                    <input
                                                                                        class="form-control-plaintext text-info"
                                                                                        id="shopname" type="text"
                                                                                        value="{{ $data->shop_name ?? "" }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-1">
                                                                                <label class="col-sm-2 col-form-label"
                                                                                    for="ownershop">ชื่อเจ้าของร้าน</label>
                                                                                <div class="col-sm-8">
                                                                                    <input
                                                                                        class="form-control-plaintext text-info"
                                                                                        id="ownershop" type="text"
                                                                                        value="{{ $data->prefix . " " . $data->first_name . "   " . $data->last_name ?? "" }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-1">
                                                                                <label class="col-sm-2 col-form-label"
                                                                                    for="paymentAmount">ยอดโอนสุทธิ</label>
                                                                                <div class="col-sm-8">
                                                                                    <input
                                                                                        class="form-control-plaintext text-info"
                                                                                        id="paymentAmount" type="text"
                                                                                        value="{{ number_format($data->price) ?? "" }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-1">
                                                                                <label class="col-sm-2 col-form-label"
                                                                                    for="ownershop">เบอร์โทรศัพท์</label>
                                                                                <div class="col-sm-8">
                                                                                    <input
                                                                                        class="form-control-plaintext text-info"
                                                                                        id="saller_mobile" type="text"
                                                                                        value="{{ $data->phone_no ?? "" }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="row mb-3">
                                                                                <label class="col-sm-3 col-form-label"
                                                                                    for="slip">Qr-code ผู้ซื้อ</label>

                                                                            </div>
                                                                            <div class="row">
                                                                                <picture>
                                                                                    <img class="border-1"
                                                                                        src="{{ $DataImages ?? "" }}"
                                                                                        alt="slip" max-width="50%">
                                                                                </picture>
                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                    <hr>
                                                                    <div class="row border-1">
                                                                        <div class="row justify-content-end">
                                                                            <div class="col">
                                                                                <h5>รายละเอียดการส่งของ</h5>

                                                                            </div>
                                                                        </div>

                                                                        <div class="container">
                                                                            <div class="row justify-content-start">
                                                                                <div class="col">
                                                                                    <h6>ผู้ส่ง(ผู้ขาย)</h6>
                                                                                    <div class="row mb-1">
                                                                                        <label
                                                                                            class="col-sm-4 col-form-label"
                                                                                            for="shopname">ชื่อร้านผู้ขาย</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input
                                                                                                class="form-control-plaintext text-info"
                                                                                                id="saller_name"
                                                                                                type="text"
                                                                                                value="{{ $data->shop_name ?? "" }}"
                                                                                                readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mb-1">
                                                                                        <label
                                                                                            class="col-sm-4 col-form-label"
                                                                                            for="ownershop">เบอร์โทรผู้ขาย</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input
                                                                                                class="form-control-plaintext text-info"
                                                                                                id="saller_mobile"
                                                                                                type="text"
                                                                                                value="{{ $data->phone_no ?? "" }}"
                                                                                                readonly>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row mb-1">
                                                                                        <label
                                                                                            class="col-sm-4 col-form-label"
                                                                                            for="ownershop">ที่อยู่</label>
                                                                                        <div class="col-sm-8 fs-4">
                                                                                            <a
                                                                                                href="https://maps.app.goo.gl/yP5Ln8twGVsV3ihS6">
                                                                                                <i>
                                                                                                    <img class="text-info btn btn-outline-info"
                                                                                                        src="{{ asset("image/icon/geo-alt-fill.svg") }}"
                                                                                                        target="_blank">
                                                                                                </i>
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col">
                                                                                    <h6>ผู้รับ(ผู้ซื้อ)</h6>
                                                                                    <div class="row mb-1">
                                                                                        <label
                                                                                            class="col-sm-4 col-form-label"
                                                                                            for="shopname">ชื่อร้านผู้ซื้อ</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input
                                                                                                class="form-control-plaintext text-info"
                                                                                                id="buyer_name"
                                                                                                type="text"
                                                                                                value="{{ $data->merchant_name ?? "" }}"
                                                                                                readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mb-1">
                                                                                        <label
                                                                                            class="col-sm-4 col-form-label"
                                                                                            for="ownershop">เบอร์โทรผู้ซื้อ</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input
                                                                                                class="form-control-plaintext text-info"
                                                                                                id="buyer_mobile"
                                                                                                type="text"
                                                                                                value="{{ $data->merchant_phone ?? "" }}"
                                                                                                readonly>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row mb-1">
                                                                                        <label
                                                                                            class="col-sm-4 col-form-label"
                                                                                            for="buyer_map">ที่อยู่</label>
                                                                                        <div class="col-sm-8 fs-4">
                                                                                            <a
                                                                                                href="https://www.google.com/maps/@18.0648224,99.2475564,3a,75y,335.91h,65.18t/data=!3m9!1e1!3m7!1s16iZ3PxBPCSquHC2vU090A!2e0!7i16384!8i8192!9m2!1b1!2i39?entry=ttu">
                                                                                                <i>
                                                                                                    <img class="text-info btn btn-outline-info"
                                                                                                        src="{{ asset("image/icon/geo-alt-fill.svg") }}"
                                                                                                        target="_blank">
                                                                                                </i>
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>


                                        </div>


                                    </div>
                                </div>
                            @endsection
                            @section("script")
                                <script>
                                    $(document).ready(function() {
                                        var getSatatus = "{{ $data->status }}";
                                        // $('.align-middle').each(function() {
                                        //     console.log($(this).find('.btn').hasClass('text-warning'))
                                        //     if (!$(this).find('.btn').hasClass('text-warning')) {
                                        //         $(this).addClass('bg-dark-subtle')
                                        //     } else {
                                        //         $(this).removeClass('bg-dark-subtle')
                                        //     }
                                        // })

                                        // text-success
                                        $('.confirm').click(function(e) {
                                            var keyword = $(this).html();
                                            var action = $(this).attr('data-action');
                                            if ($(this).attr('data-set') === 'confirm-seller') {
                                                $("input:radio:checked").each(function() {
                                                    if ($(this).val() != 'OK') {
                                                        action = 'false';
                                                        keyword = 'ไม่ถูกต้อง';
                                                    }
                                                });
                                            }

                                            var reason = '';
                                            var cancel = ``;
                                            var cancelStatus = true;
                                            var preConfirm = ``;
                                            var payment = $(this).attr('data-set');
                                            var seller = $(this).attr('data-seller');
                                            if (action === 'false') {
                                                cancel =
                                                    `<textarea type="textarea" id="reason" class="swal2-input" style="height:120px;" placeholder="กรอกเหตุผล">`;
                                                cancelStatus = false;
                                                preConfirm = () => {
                                                    reason = Swal.getPopup().querySelector('#reason').value
                                                    console.log(reason)
                                                    if (!reason) {
                                                        Swal.showValidationMessage('โปรดกรอกเหตุผล')
                                                    }
                                                    return {
                                                        reason: reason
                                                    }
                                                };
                                            }

                                            Swal.fire({
                                                title: 'ยืนยัน ' + $(this).attr('data-title') + ' ' + keyword,
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'ยืนยัน',
                                                cancelButtonText: 'ยกเลิก',
                                                width: '40em',
                                                html: cancel,
                                                focusConfirm: false,
                                                preConfirm: preConfirm

                                            }).then((result) => {

                                                if (result.isConfirmed === true) {

                                                    if (action === 'true') {

                                                        $.ajax({
                                                            type: "GET",
                                                            dataType: 'JSON',
                                                            cache: false,
                                                            url: '{{ route("order_update") }}',
                                                            data: {
                                                                title: $(this).attr('data-set'),
                                                                id: $(this).val(),
                                                                action: $(this).attr('data-action'),
                                                                reason: reason,
                                                            },
                                                            headers: {
                                                                "Accept": "application/json",
                                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                                                    'content')
                                                            },
                                                            success: function(res) {
                                                                // console.log(payment);
                                                                if (res.message === 'OK') {
                                                                    if (payment === 'payment') {
                                                                        $.ajax({
                                                                            type: "GET",
                                                                            dataType: 'JSON',
                                                                            cache: false,
                                                                            url: 'https://orca-app-egvcl.ondigitalocean.app/v1/api/sms/send',
                                                                            data: {
                                                                                userId: seller,
                                                                            },
                                                                            headers: {
                                                                                "Accept": "application/json",
                                                                                'X-CSRF-TOKEN': $(
                                                                                        'meta[name="csrf-token"]'
                                                                                    )
                                                                                    .attr('content')
                                                                            },
                                                                            success: function(sms) {
                                                                                // alert(sms);
                                                                                console.log(sms);
                                                                                if (sms.message ===
                                                                                    'success') {
                                                                                    Swal.fire({
                                                                                        icon: 'success',
                                                                                        title: 'สำเร็จ',
                                                                                        footer: 'ส่ง SMS สำเร็จ',
                                                                                        showConfirmButton: false,
                                                                                        timer: 1800
                                                                                    }).then(() => {
                                                                                        location
                                                                                            .reload();
                                                                                    });

                                                                                } else {
                                                                                    Swal.fire({
                                                                                        icon: 'success',
                                                                                        title: 'สำเร็จ',
                                                                                        footer: '<div class="h4 text-danger">ส่ง SMS ไม่สำเร็จ Error:' +
                                                                                            res
                                                                                            .status_code +
                                                                                            '</div>',
                                                                                        showConfirmButton: fale,
                                                                                        timer: 5000
                                                                                    }).then(() => {
                                                                                        location
                                                                                            .reload();
                                                                                    });
                                                                                }

                                                                            },
                                                                            error: function(res) {
                                                                                Swal.fire({
                                                                                    icon: 'success',
                                                                                    title: 'สำเร็จ',
                                                                                    footer: '<div class="h4 text-danger">ส่ง SMS ไม่สำเร็จ Error:' +
                                                                                        res
                                                                                        .status_code +
                                                                                        '</div>',
                                                                                    showConfirmButton: false,
                                                                                    timer: 5000
                                                                                }).then(() => {
                                                                                    location
                                                                                        .reload();
                                                                                });
                                                                            }
                                                                        });
                                                                    } else {
                                                                        Swal.fire({
                                                                            icon: 'success',
                                                                            title: 'สำเร็จ',
                                                                            showConfirmButton: false,
                                                                            timer: 1800
                                                                        }).then(() => {
                                                                            location.reload();
                                                                        });
                                                                    }

                                                                } else {
                                                                    Swal.fire({
                                                                        icon: 'warning',
                                                                        title: 'ไม่สำเร็จ',
                                                                        showConfirmButton: false,
                                                                        timer: 1800
                                                                    }).then(() => {
                                                                        return false;
                                                                    });
                                                                }

                                                            },
                                                            error: function(res) {
                                                                Swal.fire({
                                                                    icon: 'error',
                                                                    title: res.message,
                                                                    showConfirmButton: true
                                                                }).then(() => {
                                                                    return false;
                                                                });
                                                            }
                                                        });

                                                    } else {

                                                        $.ajax({
                                                            type: "GET",
                                                            dataType: 'JSON',
                                                            cache: false,
                                                            url: '{{ route("order_update") }}',
                                                            data: {
                                                                title: $(this).attr('data-set'),
                                                                id: $(this).val(),
                                                                action: $(this).attr('data-action'),
                                                                reason: reason
                                                            },
                                                            headers: {
                                                                "Accept": "application/json",
                                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                                                    'content')
                                                            },
                                                            success: function(res) {
                                                                console.log(res);
                                                                if (res.message === 'OK') {
                                                                    Swal.fire({
                                                                        icon: 'success',
                                                                        title: 'สำเร็จ',
                                                                        showConfirmButton: false,
                                                                        timer: 1600
                                                                    }).then(() => {
                                                                        location.reload();
                                                                    });
                                                                } else {
                                                                    Swal.fire({
                                                                        icon: 'warning',
                                                                        title: 'ไม่สำเร็จ',
                                                                        showConfirmButton: false,
                                                                        timer: 1600
                                                                    }).then(() => {
                                                                        return false;
                                                                    });
                                                                }

                                                            },
                                                            error: function(res) {
                                                                Swal.fire({
                                                                    icon: 'error',
                                                                    title: res.message,
                                                                    showConfirmButton: true
                                                                }).then(() => {
                                                                    return false;
                                                                });
                                                            }
                                                        });
                                                    }
                                                } else {
                                                    return false
                                                }
                                            })
                                        })



                                        // Initial call to load data when the page is loaded
                                        function updateRealTimeStatus() {
                                            if (getSatatus != '') {
                                                $.ajax({
                                                    type: "GET",
                                                    dataType: 'JSON',
                                                    cache: false,
                                                    url: "{{ url("getStatus") }}",
                                                    data: {
                                                        id: "{{ base64_encode($data->orders_id) }}",
                                                    },
                                                    headers: {
                                                        "Accept": "application/json",
                                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                                            'content')
                                                    },

                                                    success: function(res) {
                                                        console.log(res.data.status);
                                                        if (res.data.status != getSatatus) {

                                                            location.reload();
                                                        }
                                                    }
                                                });
                                            }
                                        }


                                        // Update the data every 1 seconds
                                        setInterval(function() {
                                            updateRealTimeStatus();
                                        }, 3000);

                                    })
                                </script>
                            @endsection
