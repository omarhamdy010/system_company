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
        @if(auth()->user()->is_admin==1)
            <div>
                @foreach($users as $user)
                    <form action="{{route('getcalender',['id' =>$user->id])}}" method="get">
                        <select>
                            <option value="0">select user</option>
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        </select>
                        <button type="submit" >Go</button>
                    </form>
                @endforeach
            </div>
        @endif
        <p>attendance:{{$daynumberofattend}}</p>
        <p>Absence:{{$absence}}</p>
        <p>total day attend:{{$daysmustattend}}</p>
        <p>average work in month:{{$avarge_work_in_month}}</p>
        <p>total work in month:{{$time_diff_hours .":". $time_diff_minutes}}</p>

        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-center mb-4">
                <a class="fas px-2 fa-arrow-alt-circle-left fa-5x "
                   href="{{route('getcalender',['id'=>$id,'date'=>$current_month->subMonth(2)->toDateString()])}}"></a>
                <a class="fas px-2 fa-arrow-alt-circle-right fa-5x"
                   href="{{route('getcalender',['id'=>$id,'date'=>$current_month->addMonth(2)->toDateString()])}}"></a>
            </div>
            <?php $da = new \Illuminate\Support\Carbon($pickup_dates[0]);?>
            <p class="card-text" style="text-align: center;border: #0c84ff 1px;color: black">{{$month_name}}
                -20{{$da->format('y')}} </p>
            <div class="row" style="color: black ; margin:2px;padding: 2px ; text-align: center">
                @if($day_week_start!='')
                    @foreach($day_week_start as $day_start)
                        <h6 class="" style="width:14.12%;background: #9ab1c5;margin:1px">{{$day_start}}</h6>
                    @endforeach
                @endif
                @foreach($daynames as $key=>$day_name)
                    <h6 class="" style="width:14.12%;background: #9ab1c5;margin:1px">{{$day_name}}</h6>
                    <?php $index[] = $key?>
                @endforeach
            </div>
            <?php $day_S = $daynames[$index[] = $key] ?>
            <div class="row">
                @if($day_week_start!='')
                    @foreach($day_week_start as $day_start)
                        <div class="" style="width: 14.285714285714285714285714285714%;padding: 5px;">
                            <div class="card not_use">
                                <div class="card-header" style="background:#4dc9e41f"></div>
                                <div class="not_use" style="color: #ec4040 ">
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                @foreach($pickup_dates as $day)
                    <div class="" style="width: 14.285714285714285714285714285714%;padding: 5px;">
                        <div class="card">
                            <div class="card-header" style="background:#4dc9e41f">
                                <h6 style="background:#dae5ff;width:fit-content;padding:10px;margin:-10px;border-radius:50%;">{{\Carbon\Carbon::parse($day)->format("d")}}</h6>
                            </div>
                            <div class="card-body {{in_array($day,$history) ? 'attend': 'absent'}}" id="card111"
                                 style="color: #ec4040 ">
                                @foreach ($attends as $attend)
                                    <?php $att1 = $attend->where(['history' => $day, 'type' => 'presence', 'user_id' => $id])->first()?>
                                    @if($att1 !=null)
                                        <p class="card-text">{{ in_array($day,$history)?'attend ='.\Illuminate\Support\Carbon::parse($att1->time)->format('H:i'):'not attendance'}}</p>
                                    @endif
                                    <?php $att2 = $attend->where(['history' => $day, 'type' => 'leave', 'user_id' => $id])->first()?>
                                    @if($att2 !=null)
                                        <p class="card-text">{{ in_array($day,$history)?'leave ='.\Illuminate\Support\Carbon::parse($att2->time)->format('H:i'):''}}</p>
                                    @endif
                                    @break
                                    <?php $att1 = $attend->where(['history' => $day, 'type' => 'presence'])->first()?>
                                    <p class="card-text">{{ in_array($day,$history)?'attend ='.\Illuminate\Support\Carbon::parse($att1->time)->format('H:i'):'not attendance'}}</p>
                                    <?php $att2 = $attend->where(['history' => $day, 'type' => 'leave'])->first()?>
                                    <p class="card-text">{{ in_array($day,$history)?'leave ='.\Illuminate\Support\Carbon::parse($att2->time)->format('H:i'):''}}</p>
                                    @break
                                @endforeach
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
        $('.not_use').hide();
    </script>

@endsection

