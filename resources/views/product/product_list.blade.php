@extends("layout.master")
@section("content")
    <div class="p-2 align-middle">

        <div class="card-title d-flex justify-content-between">

            <a class="btn text-info border-0" href="{{ url("orders") }}">
                <h4>
                    <i>
                        <img class="text-info" src="{{ asset("image/icon/chevron-left.svg") }}">
                    </i>
                    หน้าจัดการออเดอร์
                </h4>
            </a>

            <a class="btn bg-success-subtle btn-outline-success" href="{{ url("AddProduct") }}">
                <h5>
                    <i class="bi bi-patch-plus">
                        <img class="text-success" src="{{ asset("image/icon/patch-plus.svg") }}"
                            style="font-size: 4rem; color: cornflowerblue;">
                    </i>

                    เพิ่มสินค้า
                </h5>
            </a>

        </div>

    </div>
    <div class="container-fluid table-responsive">
        <table class="table-striped dataTable display table" id="productlist">
            <thead class="bg-lightgray table-secondary">
                <tr>

                    <th class="fw-100 text-center align-middle" scope="col">#</th>
                    <th class="fw-100 text-center align-middle" scope="col">ลำดับที่</th>
                    <th class="fw-400 text-center align-middle" scope="col">แบรนด์</th>
                    <th class="fw-400 text-center align-middle" scope="col">ชื่อสินค้า</th>
                    <th class="fw-300 text-center align-middle" scope="col">สี</th>
                    <th class="fw-200 text-center align-middle" scope="col">ความจุ</th>
                    <th class="fw-200 text-center align-middle" scope="col">ราคาตลาด</th>
                    <th class="fw-400 text-center align-middle" scope="col">จัดการ</th>

                </tr>
            </thead>
            <tbody id="datalist">

                @foreach ($data ?? [] as $no => $datalist)
                    <tr class="">
                        <td class="hidden align-middle" type="hidden">{{ $no + 1 }}</td>
                        <td class="hidden align-middle" type="hidden">{{ $datalist->row_num ?? "" }}</td>
                        <td class="text-wrap wtgheading fw-300 align-middle">{{ $datalist->pd_brand ?? "" }}</td>
                        <td class="text-wrap align-middle text-black" width="400px">{{ $datalist->pd_model ?? "" }}
                        <td class="fw-300 align-middle">{{ $datalist->pd_color ?? "" }}</td>

                        </td>
                        <td class="fw-300 text-center align-middle">{{ $datalist->pd_storage_capacity ?? "" }}</td>
                        <td class="fw-300 text-center align-middle">{{ number_format($datalist->pd_price) ?? "" }}</td>
                        <td class="fw-300 text-center align-middle">
                            <a class="btn btn-outline-info"
                                href="{{ url("/EditProduct") }}?id={{ base64_encode($datalist->pd_id ?? "") }}">
                                จัดการ<i>
                                    <img src="{{ asset("image/icon/arrow-right.svg") }}">
                                </i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- <div>
                                                                                                                                                            <button class="btn btn-danger" id="test" data-seller="04ee97f9-7ef1-404c-935a-6f0cbfc6c44c">
                                                                                                                                                                Test API
                                                                                                                                                            </button>
                                                                                                                                                        </div> -->
@endsection
@section("script")
    <script>
        $(document).ready(function() {

            var table = $('#productlist').DataTable({
                // order: [ [0, 'desc'] ],
                "iDisplayLength": 10,
                "pageLength": 10,
                colReorder: {
                    realtime: true
                }
            });

            $('#product_filter').hide();

            $('#search').click('input', (e) => {
                var search = e.currentTarget.value;
                table.columns([2, 5]).every(function() {
                    $('input', this.header()).val(search).keyup();
                    table_chang(search)
                });
            })

            function table_chang(search) {
                table.search(search).draw();
            };


            $('#test').click(function() {
                $.ajax({
                    type: "GET",
                    dataType: 'JSON',
                    cache: false,
                    url: 'https://orca-app-egvcl.ondigitalocean.app/v1/api/sms/send',
                    data: {
                        userId: $(this).attr('data-seller'),
                    },
                    headers: {
                        "Accept": "application/json",
                        'X-CSRF-TOKEN': $(
                                'meta[name="csrf-token"]'
                            )
                            .attr(
                                'content')
                    },
                    success: function(sms) {
                        // alert(sms);
                        console.log(sms);
                        if (sms.message === 'success') {
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
                            // Swal.fire({
                            //     title: 'Are you sure?',
                            //     text: "You won't be able to revert this!",
                            //     icon: 'warning',
                            //     showCancelButton: true,
                            //     confirmButtonColor: '#3085d6',
                            //     cancelButtonColor: '#d33',
                            //     confirmButtonText: 'Yes, delete it!'
                            // }).then((result) => {
                            //     if (result.isConfirmed) {
                            //         Swal.fire(
                            //             'Deleted!',
                            //             'Your file has been deleted.',
                            //             'success'
                            //         )
                            //     }
                            // })
                        } else {
                            // Swal.fire({
                            //     icon: 'error',
                            //     title: 'Oops...',
                            //     text: 'Something went wrong!',
                            //     footer: '<a href="">Why do I have this issue?</a>'
                            // })
                            Swal.fire({
                                    icon: 'success',
                                    title: 'สำเร็จ',
                                    footer: '<div class=" text-danger">ส่ง SMS ไม่สำเร็จ Error:' +
                                        res
                                        .status_code +
                                        '</div>',
                                    showConfirmButton: true,
                                    timer: 5000
                                })
                                .then(() => {
                                    location
                                        .reload();
                                });
                        }

                    }
                });
            })

        });
    </script>
@endsection
