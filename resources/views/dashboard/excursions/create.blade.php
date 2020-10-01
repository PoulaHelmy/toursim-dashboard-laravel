@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <!-- BREADCRUMBS -->
        <section class="content-header">
            <h1>@lang('site.excursions')</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('excursions.index') }}"> @lang('site.excursions')</a></li>
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
                                <h3 class="card-title {{ app()->getLocale() == 'ar' ? 'float-left text-right' : '' }}">@lang('site.addexcursions')</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('partials._error')
                            <form action="{{ route('excursions.store') }}" method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('post') }}
                                <div class="card-body">
                                    @foreach (config('translatable.locales') as $locale)
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title {{ app()->getLocale() == 'ar' ? 'float-left text-right' : '' }}">{{$locale}}</h3>
                                            </div>
                                            <div class="card-body">
                                                <!--        NAME AND SLUG               -->
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
                                                                   value="{{ old($locale . '.name') }}">
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
                                                                   value="{{ old($locale . '.slug') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--        RUN AND TYPE               -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            @if(count(config('translatable.locales'))>1)
                                                                <label>@lang('site.' . $locale . '.run')</label>
                                                            @else
                                                                <label>@lang('site.run')</label>
                                                            @endif
                                                            <input type="text" name="{{ $locale }}[run]"
                                                                   class="form-control"
                                                                   value="{{ old($locale . '.run') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            @if(count(config('translatable.locales'))>1)
                                                                <label>@lang('site.' . $locale . '.type')</label>
                                                            @else
                                                                <label>@lang('site.type')</label>
                                                            @endif
                                                            <input type="text" name="{{ $locale }}[type]"
                                                                   class="form-control"
                                                                   value="{{ old($locale . '.type') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--        ENGLISH INPUTS ONNLY              -->
                                            @if($locale == 'en')
                                                <!--       Start & DURATION               -->
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>@lang('site.start')</label>
                                                                <input type="number" name="start"
                                                                       class="form-control"
                                                                       value="{{ old($locale . '.start') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>@lang('site.duration')</label>
                                                                <input type="number" name="duration"
                                                                       class="form-control"
                                                                       value="{{ old($locale . '.duration') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>@lang('site.discount')</label>
                                                                <input type="number" name="discount"
                                                                       class="form-control"
                                                                       value="{{ old($locale . '.discount') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!----Banner  --->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputFile">Banner Image</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                        <input type="file"
                                                                               class="custom-file-input ex_banner_image"
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
                                                                       value="{{ old('banner_alt') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!---- Thumb --->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputFile">Thumb Image</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                        <input type="file"
                                                                               class="custom-file-input ex_thumb_image"
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
                                                                       value="{{ old('thumb_alt') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--  Images Preview --->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h4 class="display-5">Banner Image</h4>
                                                            <img src="" width="150px" height="150px"
                                                                 class="img-thumbnail  ex_banner_image_preview">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h4 class="display-5">Thumb Image</h4>
                                                            <img src="" width="150px" height="150px"
                                                                 class="img-thumbnail  ex_thumb_image_preview">
                                                        </div>
                                                    </div>
                                                    <!--        CATEGORIES && DESTINATIONS              -->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                @if(count(config('translatable.locales'))>1)
                                                                    <label>@lang('site.' . $locale . '.categories')</label>
                                                                @else
                                                                    <label>@lang('site.categories')</label>
                                                                @endif
                                                                <select class="select2" name="categories[]"
                                                                        multiple="multiple"
                                                                        data-placeholder="Select a Categories"
                                                                        data-dropdown-css-class="select2-purple"
                                                                        style="width: 100%;">
                                                                    @foreach ($categories as $category)
                                                                        <option
                                                                            value="{{ $category->id }}">{{$category->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                @if(count(config('translatable.locales'))>1)
                                                                    <label>@lang('site.' . $locale . '.destinations')</label>
                                                                @else
                                                                    <label>@lang('site.destinations')</label>
                                                                @endif
                                                                <select name="destination_id" class="form-control">
                                                                    @foreach ($destinations as $destination)
                                                                        <option
                                                                            value="{{ $destination->id }}">{{$destination->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--        SLIDER              -->
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputFile">Silder Images</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                        <input type="file"
                                                                               class="custom-file-input"
                                                                               id="exampleInputFile" name="slider[]"
                                                                               multiple accept="image/png, image/jpeg">
                                                                        <label class="custom-file-label"
                                                                               for="exampleInputFile">Choose
                                                                            filea</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            @endif

                                            <!--     SHORT DESCRIPTION       -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            @if(count(config('translatable.locales'))>1)
                                                                <label>@lang('site.' . $locale . '.short_description')</label>
                                                            @else
                                                                <label>@lang('site.short_description')</label>
                                                            @endif
                                                            <textarea name="{{ $locale }}[short_description]"
                                                                      class="form-control ckeditor">{{ old($locale . '.short_description') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--        OverView              -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-3 ">
                                                            @if(count(config('translatable.locales'))>1)
                                                                <label>@lang('site.' . $locale . '.overview')</label>
                                                            @else
                                                                <label>@lang('site.overview')</label>
                                                            @endif
                                                            <textarea name="{{ $locale }}[overview]"
                                                                      class="form-control ckeditor summernote">{{ old($locale . '.overview') }}</textarea>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!--        INCLUDED              -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            @if(count(config('translatable.locales'))>1)
                                                                <label>@lang('site.' . $locale . '.includes')</label>
                                                            @else
                                                                <label>@lang('site.includes')</label>
                                                            @endif
                                                            <input name="{{ $locale }}[includes]"
                                                                   data-role="tagsinput"
                                                                   type="text"
                                                                   placeholder="includes +"
                                                                   class="form-control" {{ old($locale . '.includes') }}>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!--        EXCLUDED              -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            @if(count(config('translatable.locales'))>1)
                                                                <label>@lang('site.' . $locale . '.excludes')</label>
                                                            @else
                                                                <label>@lang('site.excludes')</label>
                                                            @endif
                                                            <input name="{{ $locale }}[excludes]"
                                                                   data-role="tagsinput"
                                                                   type="text"
                                                                   placeholder="excludes +"

                                                                   class="form-control" {{ old($locale . '.excludes') }}>

                                                        </div>
                                                    </div>
                                                </div>


                                                <span class="h3 my-4">Search Engine Optimization (SEO):</span>
                                                <!-- PAGE TITLE & META DESCRIPTION--->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            @if(count(config('translatable.locales'))>1)
                                                                <label>@lang('site.' . $locale . '.page_title')</label>
                                                            @else
                                                                <label>@lang('site.page_title')</label>
                                                            @endif
                                                            <input type="text" name="{{ $locale }}[page_title]"
                                                                   class="form-control"
                                                                   value="{{ old($locale . '.page_title') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            @if(count(config('translatable.locales'))>1)
                                                                <label>@lang('site.' . $locale . '.meta_description')</label>
                                                            @else
                                                                <label>@lang('site.meta_description')</label>
                                                            @endif
                                                            <textarea name="{{ $locale }}[meta_description]"
                                                                      class="form-control ckeditor">{{ old($locale . '.meta_description') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- og_title & og_image-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            @if(count(config('translatable.locales'))>1)
                                                                <label>@lang('site.' . $locale . '.og_title')</label>
                                                            @else
                                                                <label>@lang('site.og_title')</label>
                                                            @endif
                                                            <input name="{{ $locale }}[og_title]"
                                                                   class="form-control ">{{ old($locale . '.og_title') }}
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
                                                <!-- OG:META DESCRIPTION && META KEYWORDS--->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            @if(count(config('translatable.locales'))>1)
                                                                <label>@lang('site.' . $locale . '.og_description')</label>
                                                            @else
                                                                <label>@lang('site.og_description')</label>
                                                            @endif
                                                            <textarea name="{{ $locale }}[og_description]"
                                                                      class="form-control ckeditor">{{ old($locale . '.og_description') }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            @if(count(config('translatable.locales'))>1)
                                                                <label>@lang('site.' . $locale . '.meta_keywords')</label>
                                                            @else
                                                                <label>@lang('site.meta_keywords')</label>
                                                            @endif
                                                            <input name="{{ $locale }}[meta_keywords]"
                                                                   data-role="tagsinput"
                                                                   type="text"
                                                                   class="form-control" {{ old($locale . '.meta_keywords') }}>

                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>@lang('site.status')</label>
                                                <input type="checkbox" name="status"
                                                       value="1"
                                                       data-bootstrap-switch
                                                       class="form-control" {{ old($locale . '.status') }}>

                                            </div>

                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>@lang('site.featured')</label>
                                                <input type="checkbox" name="featured"
                                                       value="1"
                                                       data-bootstrap-switch
                                                       class="form-control" {{ old($locale . '.featured') }}>

                                            </div>

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
