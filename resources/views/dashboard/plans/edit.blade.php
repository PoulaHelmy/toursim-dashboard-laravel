@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <!-- BREADCRUMBS -->
        <section class="content-header">
            <h1>@lang('site.plans')</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('plans.index') }}"> @lang('site.plans')</a></li>
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
                                <h3 class="card-title {{ app()->getLocale() == 'ar' ? 'float-left text-right' : '' }}">@lang('site.editplans')</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('partials._error')
                            <form action="{{ route('plans.update') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <div class="card-body">
                                    @foreach (config('translatable.locales') as $locale)
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title {{ app()->getLocale() == 'ar' ? 'float-left text-right' : '' }}">{{$locale}}</h3>
                                            </div>
                                            <div class="card-body">
                                                <!--        NAME AND SLUG               -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            @if(count(config('translatable.locales'))>1)
                                                                <label>@lang('site.' . $locale . '.name')</label>
                                                            @else
                                                                <label>@lang('site.name')</label>
                                                            @endif
                                                            <input type="text" name="{{ $locale }}[name]"
                                                                   class="form-control"
                                                                   value="{{ $excursion->translate($locale)->name }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


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

