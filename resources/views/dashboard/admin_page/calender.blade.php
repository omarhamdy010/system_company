@extends('dashboard.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1></h1>
                </div>
                <div class="col-sm-6">
                    {{--                        <ol class="breadcrumb float-sm-right">--}}
                    {{--                            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                    {{--                            <li class="breadcrumb-item"><a href="#">Layout</a></li>--}}
                    {{--                            <li class="breadcrumb-item active">Collapsed Sidebar</li>--}}
                    {{--                        </ol>--}}
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-center mb-4">
                <i class="fas px-2 fa-arrow-alt-circle-left fa-5x before"></i>
                <i class="fas px-2 fa-arrow-alt-circle-right fa-5x after"></i>
            </div>

            <p class="card-text"
               style="text-align: center;border: #0c84ff 1px; background: #1fc8e3;color: white">{{$month_name}}</p>
            <div class="row">
                @foreach($pickup_dates as $day )
                    <div class="col-sm-3">
                        <div class="card {{in_array($day,$history) ? 'attend': 'absent'}}" id="card111"
                             style="color: red">
                            <div class="card-body ">
                                <h5 class="card-title">{{$day}}</h5>
                                <p class="card-text">{{\Carbon\Carbon::parse($day)->format("l")}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        if ($('.card').hasClass('attend')) {
            $('.attend').css("color", "green");
        }

        $('.before').on('click',function () {

        })

    </script>

@endsection

