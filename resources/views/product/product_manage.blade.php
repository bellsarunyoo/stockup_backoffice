@extends("layout.master")
@section("content")
    <div class="p-2 align-middle">

        <div class="card-title d-flex justify-content-between">


            <a class="btn text-dark border-0" href="{{ url("Products") }}">
                <h4>
                    <i>
                        <img class="text-dark" src="{{ asset("image/icon/chevron-left.svg") }}">
                    </i>
                    สินค้าของ StockUp
                </h4>
            </a>

        </div>

    </div>

    <div class="container text-center">
        <div class="row align-items-start">
            <div class="col-1"></div>
            <div class="col">

                <row>
                    <h4 id="titles">{{ isset($pd[0]->id) ? "แก้ไขสินค้า" : "เพิ่มสินค้า" }}</h4>
                </row>
                <row>
                    <form class="form-floating mb-3" class="needs-validation" method="post"
                        action="{{ isset($pd[0]->id) ? route("EditPd") : route("AddPd") }}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input class="form-control" id="ProductBrand" name="ProductBrand" type="text"
                                value="{{ isset($pd[0]->brand) ? $pd[0]->brand : "" }}" placeholder="แบรนด์" required>
                            <label for="ProductBrand">แบรนด์</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="ProductName" name="ProductName" type="text"
                                value="{{ isset($pd[0]->model) ? $pd[0]->model : "" }}" placeholder="Model สินค้า" required>
                            <label for="ProductName">Model สินค้า</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="ProductColor" name="ProductColor" type="text"
                                value="{{ isset($pd[0]->color) ? $pd[0]->color : "" }}" placeholder="สี" required>
                            <label for="ProductColor">สี</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="ProductCapacity" name="ProductCapacity" type="text"
                                value="{{ isset($pd[0]->storage_capacity) ? $pd[0]->storage_capacity : "" }}"
                                placeholder="ความจุ(GB)" required>
                            <label for="ProductCapacity">ความจุ(GB)</label>
                        </div>
                        <div class="form-floating mb-5">
                            <input class="form-control" id="ProductPrice" name="ProductPrice" type="number"
                                value="{{ isset($pd[0]->price) ? $pd[0]->price : "" }}" step="0.01"
                                placeholder="ราคาขายของตลาด (บาท)" required>
                            <label for="ProductPrice">ราคาขายของตลาด (บาท)</label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a class="btn btn-outline-secondary" data-action="false" data-set="payment"
                                data-title="สินค้าของ StockUp" href="{{ url("Products") }}">ยกเลิก</a>


                            <button class="btn btn-outline-info confirm" id="submit" name="PdId" data-action="true"
                                data-set="payment" data-title="สินค้าของ StockUp" type="submit"
                                value="{{ isset($pd[0]->id) ? base64_encode($pd[0]->id) : "" }}">บันทึก</button>

                        </div>
                    </form>
                </row>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
@endsection
@section("script")
    <script>
        $(document).ready(function() {
            var status = "{{ session("action") }}";

            function clearSession() {
                $.ajax({
                    type: "GET",
                    dataType: 'JSON',
                    cache: false,
                    url: "{{ url("forget-session") }}",
                    data: {
                        key: "action",
                    },
                    headers: {
                        "Accept": "application/json",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },

                    success: function(res) {
                        console.log(res.message);

                    }
                });
            }


            if (status != '') {

                if (status == 'success') {
                    clearSession();
                    Swal.fire({
                        icon: 'success',
                        title: $('#titles').html() + ' สำเร็จ',
                        showConfirmButton: true,
                        // timer: 1800
                    }).then(() => {
                        clearSession();
                        return false;
                    });

                } else if (status == 'duplicated') {
                    // clearSession();
                    Swal.fire({
                        icon: 'error',
                        title: $('#titles').html() + ' ซ้ำกันในระบบ',
                        showConfirmButton: true,
                        // timer: 1800
                    }).then(() => {
                        clearSession();
                        return false;
                    });

                } else {
                    clearSession();
                    Swal.fire({
                        icon: 'error',
                        title: $('#titles').html() + ' ไม่สำเร็จ',
                        showConfirmButton: true,
                        // timer: 1800
                    }).then(() => {
                        clearSession();
                        return false;
                    });
                }

            } else {
                clearSession();
                return false;
            }

            // $.ajax({
            //     type: "GET",
            //     dataType: 'JSON',
            //     cache: false,
            //     url: '{{ route("AddPd") }}',
            //     data: {
            //         ProductBrand: $('#ProductBrand').val(),
            //         ProductName: $('#ProductName').val(),
            //         ProductColor: $('#ProductColor').val(),
            //         ProductCapacity: $('#ProductCapacity').val(),
            //         ProductPrice: $('#ProductPrice').val(),

            //     },
            //     headers: {
            //         "Accept": "application/json",
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
            //             'content')
            //     },
            //     success: function(res) {
            //         console.log(res);
            //         if (res.message === 'OK') {
            //             Swal.fire({
            //                 icon: 'success',
            //                 title: 'สำเร็จ',
            //                 showConfirmButton: false,
            //                 timer: 1800
            //             }).then(() => {
            //                 location.reload();
            //             });
            //         } else {
            //             Swal.fire({
            //                 icon: 'warning',
            //                 title: 'ไม่สำเร็จ',
            //                 showConfirmButton: false,
            //                 timer: 1800
            //             }).then(() => {
            //                 return false;
            //             });
            //         }

            //     },
            //     error: function(res) {
            //         Swal.fire({
            //             icon: 'error',
            //             title: res.message,
            //             showConfirmButton: true
            //         }).then(() => {
            //             return false;
            //         });
            //     }
            // });




            // Function to format the input value with decimal and thousand separators
            // var input = $('#ProductPrice');

            // function formatInput(input) {
            //     return parseFloat(input).toLocaleString('en-US', {
            //         minimumFractionDigits: 2,
            //         maximumFractionDigits: 2
            //     });
            // }

            // // Function to parse and clean the formatted input value
            // function parseFormattedInput(input) {
            //     return parseFloat(input.replace(/[^\d.-]/g, '')) || 0;
            // }

            // // Update the input value when it loses focus
            // $('#ProductPrice').blur(function() {
            //     var formattedValue = formatInput(this.value);
            //     $(this).val(formattedValue);
            // });

            // // Remove formatting and set the raw value when the input gains focus
            // $('#ProductPrice').focus(function() {
            //     var rawValue = parseFormattedInput(this.value);
            //     $(this).val(rawValue);
            // });


        });
    </script>
@endsection
