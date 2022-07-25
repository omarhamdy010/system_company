

@extends('dashboard.layout.main')
@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
{{--                    <h1>attendance {{$user_attend->name}}</h1>--}}
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
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                attendance
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>phone</th>
                                    <th>presence</th>
                                    <th>leave</th>
                                    <th>total</th>
                                    <th>history</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userdata as $data)
                                    <tr>
                                        <?php
                                        $presence = \App\Models\Attendance::where(['user_id'=>$user_attend->id ,'history'=>$data->history, 'type'=>'presence'])->first();
                                        $leave = \App\Models\Attendance::where(['user_id'=>$user_attend->id , 'history'=>$data->history,'type'=>'leave'])->first();
                                        if ($leave) $total = (new \Carbon\Carbon($presence->time))->diff(new \Carbon\Carbon($leave->time))->format('%h:%I:%s');
                                        ?>
                                        <td>{{$user_attend->name}}</td>
                                        <td>{{$user_attend->email}}</td>
                                        <td>{{$user_attend->phone}}</td>
                                        <td>{{$presence->time}}</td>
                                        <td>{{$leave?$leave->time:'-:-:-'}}</td>
                                        <td>{{$leave ? $total:'-:-:-' }}</td>
                                        <td>{{$data->history}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
