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
                                            <h4 class="card-title">presence and absence</h4>
                                        </div>
                                        <div class="card-content">
                                            <!-- table contextual / colored -->
                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th>النوع</th>
                                                        <th>وقت</th>
                                                        <th>اليوم</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="user_table">
                                                    @foreach($presence_users as $presence_user )
                                                        <tr class="table-info">
                                                            <td>{{$presence_user->type}}</td>
                                                            <td>{{$presence_user->time}}</td>
                                                            <td>{{$presence_user->day}}</td>
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
