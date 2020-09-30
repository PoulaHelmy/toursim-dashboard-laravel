@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <!-- BREADCRUMBS -->
        <section class="content-header">
            <h1>@lang('site.categories')</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}"> @lang('site.categories')</a>
                </li>
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
                                <h3 class="card-title {{ app()->getLocale() == 'ar' ? 'float-left text-right' : '' }}">@lang('site.editcategory')</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('partials._error')
                            <form action="{{ route('categories.update',$category->id) }}" method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <div class="card-body">
                                    @foreach (config('translatable.locales') as $locale)
                                        <div class="form-group">
                                            @if(count(config('translatable.locales'))>1)
                                                <label>@lang('site.' . $locale . '.name')</label>
                                            @else
                                                <label>@lang('site.name')</label>
                                            @endif
                                            <input type="text" name="{{ $locale }}[name]"
                                                   value="{{ $category->translate($locale)->name }}"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            @if(count(config('translatable.locales'))>1)
                                                <label>@lang('site.' . $locale . '.slug')</label>
                                            @else
                                                <label>@lang('site.slug')</label>
                                            @endif
                                            <input type="text" name="{{ $locale }}[slug]" class="form-control"
                                                   value="{{ $category->translate($locale)->slug }}">
                                        </div>
                                        <div class="form-group">
                                            @if(count(config('translatable.locales'))>1)
                                                <label>@lang('site.' . $locale . '.description')</label>
                                            @else
                                                <label>@lang('site.description')</label>
                                            @endif
                                            <textarea name="{{ $locale }}[description]"
                                                      class="form-control ckeditor">{{ $category->translate($locale)->description }}"</textarea>
                                        </div>
                                        <div class="form-group">
                                            @if(count(config('translatable.locales'))>1)
                                                <label>@lang('site.' . $locale . '.page_title')</label>
                                            @else
                                                <label>@lang('site.page_title')</label>
                                            @endif
                                            <input type="text" name="{{ $locale }}[page_title]" class="form-control"
                                                   value="{{ $seoAttrbutes->translate($locale)->page_title  }}">
                                        </div>
                                        <div class="form-group">
                                            @if(count(config('translatable.locales'))>1)
                                                <label>@lang('site.' . $locale . '.meta_description')</label>
                                            @else
                                                <label>@lang('site.meta_description')</label>
                                            @endif
                                            <textarea name="{{ $locale }}[meta_description]"
                                                      class="form-control ckeditor">{{  $seoAttrbutes->translate($locale)->meta_description }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            @if(count(config('translatable.locales'))>1)
                                                <label>@lang('site.' . $locale . '.og_description')</label>
                                            @else
                                                <label>@lang('site.og_description')</label>
                                            @endif
                                            <textarea name="{{ $locale }}[og_description]"
                                                      class="form-control ckeditor">{{  $seoAttrbutes->translate($locale)->og_description }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            @if(count(config('translatable.locales'))>1)
                                                <label>@lang('site.' . $locale . '.og_title')</label>
                                            @else
                                                <label>@lang('site.og_title')</label>
                                            @endif
                                            <input name="{{ $locale }}[og_title]"
                                                   class="form-control "
                                                   value="{{  $seoAttrbutes->translate($locale)->og_title }}">
                                        </div>
                                        <div class="form-group">
                                            @if(count(config('translatable.locales'))>1)
                                                <label>@lang('site.' . $locale . '.og_image')</label>
                                            @else
                                                <label>@lang('site.og_image')</label>
                                            @endif
                                            <input name="{{ $locale }}[og_image]"
                                                   class="form-control "
                                                   value="{{  $seoAttrbutes->translate($locale)->og_image }}">
                                        </div>
                                        <div class="form-group">
                                            @if(count(config('translatable.locales'))>1)
                                                <label>@lang('site.' . $locale . '.meta_keywords')</label>
                                            @else
                                                <label>@lang('site.meta_keywords')</label>
                                            @endif
                                            <input name="{{ $locale }}[meta_keywords]"
                                                   class="form-control "
                                                   value="{{  $seoAttrbutes->translate($locale)->meta_keywords }}">
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
