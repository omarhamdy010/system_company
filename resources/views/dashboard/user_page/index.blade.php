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
                                <form method="post" action="{{route('presence.store')}}">
                                    @method('POST')
                                    @csrf

                                    <input type="hidden" name="name" value="{{auth()->user()->name}}">
                                    <input type="hidden" name="phone" value="{{auth()->user()->phone}}">
                                    <input type="hidden" name="status" value="{{auth()->user()->status}}">
                                    <input type="hidden" name="id" value="{{auth()->user()->id}}">
                                    <input type="hidden" name="email" value="{{auth()->user()->email}}">
                                    <button type="submit" class="btn btn-success btn-sm prense"
                                        {{--                                        data-name="{{auth()->user()->name}}"--}}
                                        {{--                                        data-phone="{{auth()->user()->phone}}"--}}
                                        {{--                                        data-email="{{auth()->user()->email}}"--}}
                                        {{--                                        data-id="{{auth()->user()->id}}"--}}
                                    >حضور
                                    </button>
                                </form>
                                <form method="post" action="{{route('presence.save')}}">
                                    @method('POST')
                                    @csrf
                                    <input type="hidden" name="name" value="{{auth()->user()->name}}">
                                    <input type="hidden" name="phone" value="{{auth()->user()->phone}}">
                                    <input type="hidden" name="status" value="{{auth()->user()->status}}">
                                    <input type="hidden" name="id" value="{{auth()->user()->id}}">
                                    <input type="hidden" name="email" value="{{auth()->user()->email}}">
                                    <button type="submit" class="btn btn-danger btn-sm " id="abence"
                                        {{--                                   data-name="{{auth()->user()->name}}"--}}
                                        {{--                                   data-phone="{{auth()->user()->phone}}"--}}
                                        {{--                                   data-email="{{auth()->user()->email}}"--}}
                                        {{--                                   data-id="{{auth()->user()->id}}"--}}
                                    >انصراف
                                    </button>
                                </form>
                            @endif

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
                                                        <th>الاسم</th>
                                                        <th>الايميل</th>
                                                        <th>رقم الهاتف</th>
                                                        <th>وقت الحضور</th>
                                                        <th>وقت الانصراف</th>
                                                        <th>اليوم</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody
                                                        {{--                                                                class="user_table"--}}
                                                    >
                                                    @foreach($presence_users as $presence_user )
                                                        <tr class="table-info" id="presence_add_${id}">
                                                            <td class="text-bold-500">{{$presence_user->username}}</td>
                                                            <td>{{$presence_user->email}}</td>
                                                            <td class="text-bold-500">{{$presence_user->phone}}</td>
                                                            <td>{{$presence_user->presence_time}}</td>
                                                            <td>{{$presence_user->absence_time}}</td>
                                                            <td>{{\Illuminate\Support\Carbon::tomorrow()->format('l')}}</td>
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
    <!-- /.content -->

@endsection
@section('js')
    <script>

    </script>
@endsection
