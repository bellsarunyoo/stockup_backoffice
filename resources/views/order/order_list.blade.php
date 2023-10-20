@extends("layout.master")
@section("content")
    <nav class="navbar navbar-expand-lg">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <a class="btn text-dark border-0" href="{{ url("Products") }}">
                <h4>
                    <i>
                        <img class="text-dark" src="{{ asset("image/icon/chevron-left.svg") }}">
                    </i>
                    สินค้าของ Stockup
                </h4>
            </a>
        </div>
    </nav>
    <div class="container-fluid table-responsive">
        <table class="table-striped dataTable display table" id="orderlist">
            <thead class="bg-lightgray table-success">
                <tr>
                    <th class="text-center align-middle" scope="col">#</th>
                    <th class="fw-400 text-center align-middle" scope="col">Order No.</th>
                    <th class="wtgheading fw-400 text-center align-middle" scope="col">วันที่เวลา</th>
                    <th class="fw-100 text-center align-middle" scope="col">สินค้าแบรนด์</th>
                    <th class="fw-600 text-center align-middle text-black" scope="col">รายละเอียดสินค้า</th>
                    <th class="wtgheading fw-300 text-center align-middle" scope="col">สถานะ</th>
                    <th class="fw-300 text-center align-middle" scope="col">จำนวน</th>
                    <th class="fw-300 text-center align-middle" scope="col">ราคาสุทธิ</th>
                    <th class="fw-300 text-center align-middle" scope="col">จัดการ</th>

                </tr>
            </thead>
            <tbody id="datalist">

                @foreach ($data ?? [] as $no => $datalist)
                    <tr class="">
                        <td class="align-middle">{{ $no + 1 }}</td>
                        <td class="fw-400 align-middle">{{ $datalist->id ?? "" }}</td>
                        <td class="text-wrap wtgheading fw-300 align-middle">
                            {{ date("d-m-Y H:i:s", strtotime(str($datalist->created_date))) ?? "" }}
                        </td>
                        <td class="fw-300 align-middle">{{ $datalist->product ?? "" }}</td>
                        <td class="text-wrap align-middle text-black" width="400px">{{ $datalist->description ?? "" }}
                        </td>
                        <td class="wtgheading fw-400 align-middle">{{ $datalist->status ?? "" }}</td>
                        <td class="fw-300 text-center align-middle">{{ number_format($datalist->amount) ?? "" }}</td>
                        <td class="fw-400 text-end align-middle text-black">
                            {{ number_format($datalist->price) ?? "" }}
                        </td>
                        <td class="fw-300 text-center align-middle">
                            <a class="btn btn-outline-success"
                                href="{{ url("/order") }}?id={{ base64_encode($datalist->id ?? "") }}">
                                จัดการ<i>
                                    <img src="{{ asset("image/icon/arrow-right.svg") }}">
                                </i>
                            </a>
                        </td>
                    </tr>
                    @php
                        $updated_date = $datalist->updated_date;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- </div>
                                                            </section> -->

    <div class="container-fluid table-responsive">
        <table class="table-striped dataTable display table" id="orderlistTest">

        </table>
    </div>
@endsection
@section("script")
    <script>
        $(document).ready(function() {
            var getMaxDate = "{{ $UpDateDayMax }}";
            console.log("{{ $UpDateDayMax }}")

            var table = $('#orderlist').DataTable({
                // "aLengthMenu": [
                //     [10, 20, 50, -1],
                //     [10, 20, 50, "All"]
                // ],
                "iDisplayLength": 10,
                "pageLength": 10,
                colReorder: {
                    realtime: true
                }
            });
            $('#order_filter').hide();

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

            // Initial call to load data when the page is loaded
            function updateRealTime() {
                if (getMaxDate != '') {
                    $.ajax({
                        type: "GET",
                        dataType: 'JSON',
                        cache: false,
                        url: "{{ url("OrdersList") }}",
                        success: function(res) {
                            console.log(res.data);
                            if (res.data != getMaxDate) {

                                location.reload();
                            }
                        }
                    });
                }
            }


            // Update the data every 3 seconds
            setInterval(function() {
                updateRealTime();
            }, 3000);






        });
    </script>
@endsection
