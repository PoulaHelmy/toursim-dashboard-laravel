@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <!-- BREADCRUMBS -->
        <section class="content-header">
            <h1>@lang('site.users')</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}"> @lang('site.users')</a></li>
                <li class=" breadcrumb-item active">@lang('site.add')</li>
            </ol>
        </section>
        <!-- END BREADCRUMBS -->

        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center align-items-center">
                    <div class="col-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title {{ app()->getLocale() == 'ar' ? 'float-left text-right' : '' }}">@lang('site.addusers')</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('partials._error')
                            <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('post') }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>@lang('site.name')</label>
                                        <input type="text" name="name" class="form-control"
                                               placeholder="@lang('site.nameplaceholder')">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.email')</label>
                                        <input type="text" name="email" class="form-control"
                                               placeholder="@lang('site.email')">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.password')</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.password_confirmation')</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('site.role')</label>
                                        <select name="role" class="form-control">
                                            @foreach ($roles as $role)
                                                <option
                                                    value="{{ $role->id }}" {{ isset($row) && $row->id == $role->id ? 'selected' : '' }}>{{$role->name }}</option>
                                            @endforeach
                                        </select>

                                    </div><!-- end of form-group -->

                                    <div class="form-group">
                                        <span class="h3">User Permissions</span>
                                        @php
                                            $models = ['roles', 'users','packages','excursions','hotels','destinations','plans','categories' ];$maps = ['create', 'read', 'update', 'delete'];
                                        @endphp
                                        <ul class="nav ">
                                            <table class="table table-hover table-bordered">
                                                @foreach ($models as $index => $model)
                                                    <tr>
                                                        <td>
                                                            <li class="form-group {{ $index == 0 ? 'active' : '' }}">@lang('site.' . $model)</li>
                                                        </td>
                                                        <td>
                                                            <div
                                                                class="form-group {{ $index == 0 ? 'active' : '' }}"
                                                                id="{{ $model }}">
                                                                @foreach ($maps as $map)
                                                                    <label><input type="checkbox"
                                                                                  name="permissions[]"
                                                                                  value="{{ $map}}_{{$model }}"> @lang('site.'.$map)
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </ul>

                                        <div class="tab-content">

                                            @foreach ($models as $index=>$model)


                                            @endforeach
                                        </div><!-- end of tab content -->
                                    </div><!-- end of nav tabs -->
                                    <!-- ./row -->
                                {{--                                    <div class="row">--}}
                                {{--                                        @php--}}
                                {{--                                            $models = ['roles', 'users','packages','excursions','hotels','destinations','plans','categories' ];$maps = ['create', 'read', 'update', 'delete'];--}}
                                {{--                                        @endphp--}}
                                {{--                                        <div class="col-12 ">--}}
                                {{--                                            <div class="card card-primary card-tabs">--}}
                                {{--                                                <div class="card-header p-0 pt-1">--}}
                                {{--                                                    <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">--}}
                                {{--                                                        <li class="pt-2 px-3"><h3 class="card-title">User--}}
                                {{--                                                                Permissions</h3>--}}
                                {{--                                                        </li>--}}
                                {{--                                                        @foreach ($models as $index => $model)--}}
                                {{--                                                            <li class="nav-item">--}}
                                {{--                                                                <a class="nav-link {{ $index == 0 ? 'active' : '' }}"--}}
                                {{--                                                                   id="{{ $index}}"--}}
                                {{--                                                                   data-toggle="pill" href="#{{ $index}}"--}}
                                {{--                                                                   role="tab" aria-controls="{{ $index}}"--}}
                                {{--                                                                   aria-selected="true">@lang('site.' . $model)</a>--}}
                                {{--                                                            </li>--}}
                                {{--                                                        @endforeach--}}

                                {{--                                                    </ul>--}}
                                {{--                                                </div>--}}
                                {{--                                                <div class="card-body">--}}

                                {{--                                                    <div class="tab-content" id="custom-tabs-two-tabContent">--}}
                                {{--                                                        @foreach ($models as $index => $model)--}}
                                {{--                                                            <div--}}
                                {{--                                                                class="tab-pane fade  {{ $index == 0 ? 'active show' : '' }}"--}}
                                {{--                                                                id="{{ $index}}"--}}
                                {{--                                                                role="tabpanel"--}}
                                {{--                                                                aria-labelledby="{{ $index}}">--}}
                                {{--                                                                @foreach ($maps as $map)--}}
                                {{--                                                                    <label><input type="checkbox"--}}
                                {{--                                                                                  name="permissions[]"--}}
                                {{--                                                                                  value="{{ $map}}_{{$model }}"> @lang('site.'.$map)--}}
                                {{--                                                                        {{$index}}--}}
                                {{--                                                                    </label>--}}
                                {{--                                                                @endforeach--}}
                                {{--                                                            </div>--}}
                                {{--                                                        @endforeach--}}
                                {{--                                                    </div>--}}

                                {{--                                                </div>--}}
                                {{--                                                <!-- /.card -->--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                <!-- /USER IMAGE -->
                                    <div class="row justify-content-between align-items-start">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputFile">User Image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file"
                                                               class="custom-file-input user_banner_image"
                                                               id="exampleInputFile" name="image">
                                                        <label class="custom-file-label"
                                                               for="exampleInputFile">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!--  Images Preview --->

                                        <div class="col-md-6">
                                            <div class="float-right">
                                                <h4 class="display-5">User Image</h4>
                                                <img src="{{asset('/uploads/user_images/default.png')}}" width="150px"
                                                     height="150px"
                                                     class="img-thumbnail  user_banner_image_preview">
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">@lang('site.add')</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div><!-- end of content wrapper -->

@endsection

