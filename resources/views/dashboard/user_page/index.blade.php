@extends('dashboard.layout.main')

@section('content')
        <!-- Content Header (Page header) -->
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

        <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        @if(auth()->user()->status==0)
                                            waiting....
                                            @else
                                        main system page
                                        @endif
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
                                    @if(auth()->user()->status==0)
                                        <span style="background: red ;color: white ;text-align: center"> wait until admin accept you......</span>
                                    @else
                                        <button href="" class="btn btn-success btn-sm presence">حضور</button>
                                        <a href="" class="btn btn-secondary btn-sm disabled absence">انصراف</a>
                                    @endif
                                </div>
                                <!-- /.card-body -->
{{--                                <div class="card-footer">--}}
{{--                                    Footer--}}
{{--                                </div>--}}
                                <!-- /.card-footer-->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </section>
    <!-- /.content -->

@endsection
