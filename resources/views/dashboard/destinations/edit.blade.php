@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <!-- BREADCRUMBS -->
        <section class="content-header">
            <h1>@lang('site.destinations')</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('destinations.index') }}"> @lang('site.destinations')</a>
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
                                <h3 class="card-title {{ app()->getLocale() == 'ar' ? 'float-left text-right' : '' }}">@lang('site.adddestination')</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('partials._error')
                            <form action="{{ route('destinations.update',$destination->id) }}" method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <div class="card-body">
                                    @foreach (config('translatable.locales') as $locale)
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title {{ app()->getLocale() == 'ar' ? 'float-left text-right' : '' }}">{{$locale}}</h3>

                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            @if(count(config('translatable.locales'))>1)
                                                                <label>@lang('site.' . $locale . '.name')</label>
                                                            @else
                                                                <label>@lang('site.name')</label>
                                                            @endif
                                                            <input type="text" name="{{ $locale }}[name]"
                                                                   class="form-control"
                                                                   value="{{ $destination->translate($locale)->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            @if(count(config('translatable.locales'))>1)
                                                                <label>@lang('site.' . $locale . '.slug')</label>
                                                            @else
                                                                <label>@lang('site.slug')</label>
                                                            @endif
                                                            <input type="text" name="{{ $locale }}[slug]"
                                                                   class="form-control"
                                                                   value="{{ $destination->translate($locale)->slug }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    @if(count(config('translatable.locales'))>1)
                                                        <label>@lang('site.' . $locale . '.description')</label>
                                                    @else
                                                        <label>@lang('site.description')</label>
                                                    @endif
                                                    <textarea name="{{ $locale }}[description]"
                                                              class="form-control ckeditor"> {{ $destination->translate($locale)->description }}"</textarea>
                                                </div>
                                                @if($locale == 'en')
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputFile">Banner Image</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                        <input type="file"
                                                                               class="custom-file-input dest_banner_image"
                                                                               id="exampleInputFile" name="banner_url">
                                                                        <label class="custom-file-label"
                                                                               for="exampleInputFile">Choose
                                                                            file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Banner Alt</label>
                                                                <input type="text" name="banner_alt"
                                                                       class="form-control"
                                                                       value="{{ $photos->banner_alt }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputFile">Thumb Image</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                        <input type="file"
                                                                               class="custom-file-input dest_thumb_image"
                                                                               id="exampleInputFile" name="thumb_url">
                                                                        <label class="custom-file-label"
                                                                               for="exampleInputFile">Choose
                                                                            file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Thumb Alt</label>
                                                                <input type="text" name="thumb_alt" class="form-control"
                                                                       value="{{ $photos->thumb_alt}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--  Images Preview --->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h4 class="display-5">Banner Image</h4>
                                                            <img src="{{asset('uploads/'.$photos->banner_url)}}"
                                                                 width="150px"
                                                                 height="150px"
                                                                 class="img-thumbnail  dest_banner_image_preview">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h4 class="display-5">Thumb Image</h4>
                                                            <img src="{{asset('uploads/'.$photos->thumb_url)}}"
                                                                 width="150px"
                                                                 height="150px"
                                                                 class="img-thumbnail  dest_thumb_image_preview">
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class=" from-group">
                                                    @if(count(config('translatable.locales'))>1)
                                                        <label>@lang('site.' . $locale . '.page_title')</label>
                                                    @else
                                                        <label>@lang('site.page_title')</label>
                                                    @endif
                                                    <input type=" text" name="{{ $locale }}[page_title]"
                                                           class="form-control"
                                                           value="{{ $seoAttrbutes->translate($locale)->page_title }}">
                                                </div>
                                                <div class="form-group">
                                                    @if(count(config('translatable.locales'))>1)
                                                        <label>@lang('site.' . $locale . '.meta_description')</label>
                                                    @else
                                                        <label>@lang('site.meta_description')</label>
                                                    @endif
                                                    <textarea name="{{ $locale }}[meta_description]"
                                                              class="form-control ckeditor"> {{ $seoAttrbutes->translate($locale)->meta_description }}"</textarea>
                                                </div>
                                                <div class="form-group">
                                                    @if(count(config('translatable.locales'))>1)
                                                        <label>@lang('site.' . $locale . '.og_description')</label>
                                                    @else
                                                        <label>@lang('site.og_description')</label>
                                                    @endif
                                                    <textarea name="{{ $locale }}[og_description]"
                                                              class="form-control ckeditor"> {{ $seoAttrbutes->translate($locale)->og_description }}"</textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            @if(count(config('translatable.locales'))>1)
                                                                <label>@lang('site.' . $locale . '.og_title')</label>
                                                            @else
                                                                <label>@lang('site.og_title')</label>
                                                            @endif
                                                            <input name="{{ $locale }}[og_title]"
                                                                   class="form-control "
                                                                   value="{{ $seoAttrbutes->translate($locale)->og_title }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            @if(count(config('translatable.locales'))>1)
                                                                <label>@lang('site.' . $locale . '.og_image')</label>
                                                            @else
                                                                <label>@lang('site.og_image')</label>
                                                            @endif
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                           id="exampleInputFile"
                                                                           name="{{ $locale }}[og_image]">
                                                                    <label class="custom-file-label"
                                                                           for="exampleInputFile">Choose
                                                                        file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    @if(count(config('translatable.locales'))>1)
                                                        <label>@lang('site.' . $locale . '.meta_keywords')</label>
                                                    @else
                                                        <label>@lang('site.meta_keywords')</label>
                                                    @endif
                                                    <input name="{{ $locale }}[meta_keywords]"
                                                           data-role="tagsinput"
                                                           type="text"
                                                           class="form-control"
                                                           value="{{  $seoAttrbutes->translate($locale)->meta_keywords }}">


                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit"
                                            class="btn btn-primary">@lang('site.edit')</button>
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
