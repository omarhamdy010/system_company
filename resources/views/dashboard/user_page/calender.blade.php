@extends('dashboard.layout.main')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>main page</h1>
                </div>
                <div class="col-sm-6">
                    {{--                        <ol class="breadcrumb float-sm-right">--}}
                    {{--                            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                    {{--                            <li class="breadcrumb-item"><a href="#">Layout</a></li>--}}
                    {{--                            <li class="breadcrumb-item active">Collapsed Sidebar</li>--}}
                    {{--                        </ol>--}}
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <section class="section">
                            <div class="row" id="table-contexual">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">presence and leave</h4>
                                        </div>
                                        <div class="card-content">
                                            <!-- table contextual / colored -->
                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th>النوع</th>
                                                        <th>وقت</th>
                                                        <th>التاريخ</th>
                                                        <th>حضور</th>
                                                        <th>انصراف</th>
                                                        <th>ساعات العمل</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="user_table">
                                                    @foreach($presence_users as $presence_user )
                                                        <?php
                                                            $presence = \App\Models\Attendance::where(['user_id'=>auth()->user()->id ,'history'=>$presence_user->history, 'type'=>'presence'])->first();
                                                            $leave = \App\Models\Attendance::where(['user_id'=>auth()->user()->id , 'history'=>$presence_user->history,'type'=>'leave'])->first();
                                                            if ($leave) $total = (new \Carbon\Carbon($presence->time))->diff(new \Carbon\Carbon($leave->time))->format('%h:%I:%s');
                                                        ?>
                                                        <tr class="table-info">
                                                            <td>{{$presence_user->type}}</td>
                                                            <td>{{$presence_user->time}}</td>
                                                            <td>{{$presence_user->history}}</td>
                                                            <td>{{$presence->time}}</td>
                                                            <td>{{$leave?$leave->time:'00:00:00'}}</td>
                                                            <td>{{$leave ? $total:'00:00:00' }}</td>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
