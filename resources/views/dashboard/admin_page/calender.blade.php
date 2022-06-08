@extends('dashboard.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1></h1>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-center mb-4">
                <a class="fas px-2 fa-arrow-alt-circle-left fa-5x " href="{{route('getcalender',['date'=>$current_month->subMonth(2)->toDateString()])}}" ></a>
                <a class="fas px-2 fa-arrow-alt-circle-right fa-5x" href="{{route('getcalender',['date'=>$current_month->addMonth(2)->toDateString()])}}" ></a>
            </div>
            <p class="card-text"
               style="text-align: center;border: #0c84ff 1px; background: #1fc8e3;color: white">{{$month_name}}</p>
            <div class="row">
                @foreach($pickup_dates as $day )
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-header" style="background: #0b1526">
                                <h6 style="    background: #dae5ff; width: fit-content;padding: 10px;margin: -10px;border-radius: 50%;" > {{\Carbon\Carbon::parse($day)->format("d")}}</h6>
                            </div>
                            <div class="card-body {{in_array($day,$history) ? 'attend': 'absent'}}" id="card111" style="color: #ec4040 ">
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
        if ($('.card-body').hasClass('attend')) {
            $('.attend').css("color", "green");
        }
    </script>

@endsection

