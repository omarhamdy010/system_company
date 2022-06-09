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
                <a class="fas px-2 fa-arrow-alt-circle-left fa-5x "
                   href="{{route('getcalender',['date'=>$current_month->subMonth(2)->toDateString()])}}"></a>
                <a class="fas px-2 fa-arrow-alt-circle-right fa-5x"
                   href="{{route('getcalender',['date'=>$current_month->addMonth(2)->toDateString()])}}"></a>
            </div>
{{--@dd($daysfirstweek)--}}
            <?php $da = new \Illuminate\Support\Carbon($pickup_dates[0]);
            foreach($attends as $attend ){
                $history[] = $attend->history;
            }
            ?>

            <p class="card-text" style="text-align: center;border: #0c84ff 1px;color: black">{{$month_name}}-20{{$da->format('y')}} </p>
            <div class="row" style="color: black ; margin:2px;padding: 2px ; text-align: center">
                @foreach($daynames as $day_name)
                                <h6 class=""style="width:14.12%;background: #9ab1c5;margin:1px">{{$day_name}}</h6>
                @endforeach
            </div>

            <div class="row">

                @foreach($pickup_dates as $day)
                    <div class="" style="width: 14.285714285714285714285714285714%;padding: 5px;">
                        <div class="card">
                            <div class="card-header" style="background: #4dc9e41f">
                                <h6 style="    background: #dae5ff; width: fit-content;padding: 10px;margin: -10px;border-radius: 50%;"> {{\Carbon\Carbon::parse($day)->format("d")}}</h6>
                            </div>
                            <div class="card-body {{in_array($day,$history) ? 'attend': 'absent'}}" id="card111"
                                 style="color: #ec4040 ">
                                <p class="card-text">{{\Carbon\Carbon::parse($day)->format("l")}}</p>
                                <?php $att=$attends->where(['history'=>$day,'type'=>'presence'])->first()?>
                                <p class="card-text">{{ in_array($day,$history)?$att->time:''}}</p>
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

