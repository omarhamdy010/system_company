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
                                <form method="post" action="{{route('presence.store')}}" id="prence">
                                    @method('POST')

                                    <input type="hidden" name="_token" id="token1" value="{{csrf_token()}}">
                                    <input type="hidden" name="type" value="presence">
                                    <input type="hidden" name="id" value="{{auth()->user()->id}}">
                                    <button type="submit" class="btn btn-success btn-sm presence"
                                            data-type="presence"
                                            data-id="{{auth()->user()->id}}"
                                    >حضور
                                    </button>
                                </form>
                                <form method="post" action="{{route('presence.save')}}" id="abrence">
                                    @method('POST')
                                    <input type="hidden" name="_token" id="token2" value="{{csrf_token()}}">
                                    <input type="hidden" name="type" value="absence">
                                    <input type="hidden" name="id" value="{{auth()->user()->id}}">
                                    <button type="submit" class="btn btn-danger btn-sm absence"
                                            data-type="absence"
                                            data-id="{{auth()->user()->id}}"
                                    >انصراف
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection
