@extends('layout.master')
@section('content')
<nav class="navbar navbar-expand-lg ">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <a class="btn border-0 text-dark" href="{{url('Products')}}">
            <h4>
                <i>
                    <img class="text-dark" src="{{ asset('image/icon/chevron-left.svg') }}">
                </i>
                สินค้าของ Stockup
            </h4>
        </a>
    </div>
</nav>
<div class="container-fluid table-responsive">
    <table class="table table-striped dataTable display" id="orderlist">
        <thead class="bg-lightgray table-success">
            <tr>
                <th scope="col" class="align-middle text-center">#</th>
                <th scope="col" class="align-middle text-center fw-400">Order No.</th>
                <th scope="col" class="align-middle text-center wtgheading fw-400">วันที่เวลา</th>
                <th scope="col" class="align-middle text-center fw-100">สินค้าแบรนด์</th>
                <th scope="col" class="align-middle text-center text-black fw-600">รายละเอียดสินค้า</th>
                <th scope="col" class="align-middle text-center wtgheading fw-300">สถานะ</th>
                <th scope="col" class="align-middle text-center fw-300">จำนวน</th>
                <th scope="col" class="align-middle text-center fw-300">ราคาสุทธิ</th>
                <th scope="col" class="align-middle text-center fw-300">จัดการ</th>

            </tr>
        </thead>
        <tbody id="datalist">

            @foreach($data??array() as $no => $datalist)
            <tr class="">
                <td class="align-middle">{{$no+1}}</td>
                <td class="align-middle fw-400">{{$datalist->id??'' }}</td>
                <td class="align-middle text-wrap wtgheading fw-300">
                    {{ date('d-m-Y H:m', strtotime($datalist->created_date)) ?? '' }}
                </td>
                <td class="align-middle fw-300">{{ $datalist->product ?? '' }}</td>
                <td class="align-middle text-black text-wrap" width="400px">{{ $datalist->description ?? '' }}
                </td>
                <td class="align-middle wtgheading fw-400">{{ $datalist->status ?? '' }}</td>
                <td class="align-middle text-center fw-300">{{ number_format($datalist->amount) ?? '' }}</td>
                <td class="align-middle text-end text-black fw-400">
                    {{ number_format($datalist->price) ?? '' }}
                </td>
                <td class="align-middle text-center fw-300">
                    <a href="{{ url('/order')}}?id={{ base64_encode($datalist->id??'')  }}" class="btn btn-outline-success ">
                        จัดการ<i>
                            <img src="{{ asset('image/icon/arrow-right.svg') }}">
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
    <table class="table table-striped dataTable display" id="orderlistTest">

    </table>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function() {
        var getMaxDate = "{{$UpDateDayMax}}";
        console.log("{{$UpDateDayMax}}")

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
                    url: "{{url('OrdersList')}}",
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