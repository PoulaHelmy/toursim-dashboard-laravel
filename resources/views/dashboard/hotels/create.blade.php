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
                            <form action="{{ route('hotels.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('post') }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>@lang('site.name')</label>
                                        <input type="text" name="name" class="form-control"
                                               placeholder="@lang('site.nameplaceholder')">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.sitelink')</label>
                                        <input type="text" name="website_link" class="form-control"
                                               placeholder="@lang('site.sitelinkplaceholder')">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.hotelstars')</label>
                                        <select class="custom-select" name="stars"
                                                placeholder="@lang('site.starsplaceholder')">
                                            <option value="1">1 @lang('site.star')</option>
                                            <option value="2">2 @lang('site.star')</option>
                                            <option value="3">3 @lang('site.star')</option>
                                            <option value="4">4 @lang('site.star')</option>
                                            <option value="5">5 @lang('site.star')</option>
                                        </select>
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
{{--@foreach (config('translatable.locales') as $locale)--}}
{{--    <div class="form-group">--}}
{{--        @if(count(config('translatable.locales'))>1)--}}
{{--            <label>@lang('site.' . $locale . '.name')</label>--}}
{{--        @else--}}
{{--            <label>@lang('site.title')</label>--}}
{{--        @endif--}}
{{--        <input type="text" name="{{ $locale }}[title]" class="form-control"--}}
{{--               value="{{ old($locale . '.title') }}">--}}
{{--    </div>--}}

{{--    <div class="form-group">--}}
{{--        @if(count(config('translatable.locales'))>1)--}}
{{--            <label>@lang('site.' . $locale . '.description')</label>--}}
{{--        @else--}}
{{--            <label>@lang('site.description')</label>--}}
{{--        @endif--}}
{{--        <textarea name="{{ $locale }}[description]"--}}
{{--                  class="form-control ckeditor">{{ old($locale . '.description') }}</textarea>--}}
{{--    </div>--}}

{{--@endforeach--}}
