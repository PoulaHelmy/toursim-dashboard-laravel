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
                <li class=" breadcrumb-item active">@lang('site.edit')</li>
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
                                <h3 class="card-title {{ app()->getLocale() == 'ar' ? 'float-left text-right' : '' }}">@lang('site.editusers')</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('partials._error')
                            <form action="{{ route('users.update',$user->id) }}" method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>@lang('site.name')</label>
                                        <input type="text" name="name" class="form-control"
                                               value="{{ $user->name }}"
                                               placeholder="@lang('site.nameplaceholder')">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.email')</label>
                                        <input type="text" name="email" class="form-control"
                                               value="{{ $user->email }}"
                                               placeholder="@lang('site.email')">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.role')</label>
                                        <select name="role" class="form-control">
                                            @foreach ($roles as $role)
                                                <option
                                                    value="{{ $role->id }}" {{ isset($user) && $user->id == $role->id ? 'selected' : '' }}>{{$role->name }}</option>
                                            @endforeach
                                        </select>

                                    </div><!-- end of form-group -->

                                    <!-- ./row -->
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
                                        {{--                                        {{ $user->image_path }}--}}
                                        <div class="col-md-6">
                                            <div class="float-right">
                                                <h4 class="display-5">User Image</h4>

                                                <img src="{{ $user->image_path }}" width="150px"
                                                     height="150px"
                                                     class="img-thumbnail  user_banner_image_preview">
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">@lang('site.edit')</button>
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

