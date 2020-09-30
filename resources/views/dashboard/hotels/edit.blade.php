@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <!-- BREADCRUMBS -->
        <section class="content-header">
            <h1>@lang('site.hotels')</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('hotels.index') }}"> @lang('site.hotels')</a></li>
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
                                <h3 class="card-title {{ app()->getLocale() == 'ar' ? 'float-left text-right' : '' }}">@lang('site.addhotel')</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('partials._error')
                            <form action="{{ route('hotels.update',$hotel->id) }}" method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>@lang('site.name')</label>
                                        <input type="text" name="name" class="form-control"
                                               placeholder="@lang('site.nameplaceholder')" value="{{$hotel->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.sitelink')</label>
                                        <input type="text" name="website_link" class="form-control"
                                               placeholder="@lang('site.sitelinkplaceholder')"
                                               value="{{$hotel->website_link}}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.hotelstars')</label>
                                        <select class="custom-select" name="stars"
                                                placeholder="@lang('site.starsplaceholder')">
                                            {{ $hotel->stars == 1 ? 'selected'  :'' }}
                                            <option value="1" {{ $hotel->stars == 1 ? 'selected'  :'' }}>
                                                1 @lang('site.star')</option>
                                            <option value="2" {{ $hotel->stars == 2 ? 'selected'  :'' }}>
                                                2 @lang('site.star')</option>
                                            <option value="3" {{ $hotel->stars == 3 ? 'selected'  :'' }}>
                                                3 @lang('site.star')</option>
                                            <option value="4" {{ $hotel->stars == 4 ? 'selected'  :'' }}>
                                                4 @lang('site.star')</option>
                                            <option value="5" {{ $hotel->stars == 5 ? 'selected'  :'' }}>
                                                5 @lang('site.star')</option>
                                        </select>
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
