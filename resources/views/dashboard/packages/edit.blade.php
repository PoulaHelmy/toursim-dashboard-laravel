@extends('layouts.dashboard.app')
@php
    $dayCounts=1;
    $seasonCounts=1;
@endphp
@section('content')

    <div class="content-wrapper">
        <!-- BREADCRUMBS -->
        <section class="content-header">
            <h1>@lang('site.packages')</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('packages.index') }}"> @lang('site.packages')</a></li>
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
                                <h3 class="card-title {{ app()->getLocale() == 'ar' ? 'float-left text-right' : '' }}">@lang('site.editpackages')</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('partials._error')
                            <form action="{{ route('packages.update',$package->id) }}" method="post"
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
                                                <!--        NAME AND SLUG AND DISCOUNT AND PLACES             -->
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
                                                                   value="{{ $package->translate($locale)->name}}">
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
                                                                   value="{{ $package->translate($locale)->slug}}">
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
                                                                   value="{{ $package->translate($locale)->run}}">
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
                                                                   value="{{ $package->translate($locale)->type}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--        ENGLISH INPUTS ONNLY              -->

                                            @if($locale == 'en')
                                                <!--       Start & DURATION & Discount And Places               -->
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>@lang('site.start')</label>
                                                                <input type="number" name="start"
                                                                       class="form-control"
                                                                       value="{{ $package->start}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>@lang('site.duration')</label>
                                                                <input type="number" name="duration"
                                                                       class="form-control"
                                                                       value="{{ $package->duration}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>@lang('site.discount')</label>
                                                                <input type="number" name="discount"
                                                                       class="form-control"
                                                                       value="{{ $package->discount}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>@lang('site.places')</label>
                                                                <input type="number" name="places"
                                                                       class="form-control"
                                                                       value="{{ $package->places}}">
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
                                                                       value="{{ $package->photos->banner_alt}}">
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
                                                                       value="{{ $package->photos->thumb_alt}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--  Images Preview --->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h4 class="display-5">Banner Image</h4>
                                                            <img
                                                                src="{{asset('uploads/'.$package->photos->banner_url)}}"
                                                                width="150px" height="150px"
                                                                class="img-thumbnail  ex_banner_image_preview">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h4 class="display-5">Thumb Image</h4>
                                                            <img src="{{asset('uploads/'.$package->photos->thumb_url)}}"
                                                                 width="150px" height="150px"
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
                                                                    @foreach ($allCategories as $category)
                                                                        <option
                                                                            value="{{ $category->id }}" {{ in_array( $category->id, $allSelectedCAtegories) ? 'selected' : '' }}>{{$category->name }}</option>
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
                                                                    @foreach ($allDestinations as $destination)
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
                                                        <div class="col-12">
                                                            <div class="card card-primary">
                                                                <div class="card-header">
                                                                    <div class="card-title">
                                                                        Slider Images
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        @foreach($package->gallary as $index => $image)
                                                                            <div class="col-sm-2">
                                                                                <img
                                                                                    src="{{asset('/uploads/'.$image->url)}}"
                                                                                    class="img-fluid mb-2"
                                                                                    alt="{{$image->alt}}"/>
                                                                            </div>
                                                                        @endforeach

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--        Frequently Booking              -->
                                                {{--                                                    <div class="row">--}}
                                                {{--                                                        <div class="col-md-12">--}}
                                                {{--                                                            <div class="form-group">--}}
                                                {{--                                                                <label>@lang('site.freqpackages')</label>--}}
                                                {{--                                                                <select class="select2" name="packages[]"--}}
                                                {{--                                                                        multiple="multiple"--}}
                                                {{--                                                                        data-placeholder="Select Packages"--}}
                                                {{--                                                                        data-dropdown-css-class="select2-purple"--}}
                                                {{--                                                                        style="width: 100%;">--}}
                                                {{--                                                                    @foreach ($allPackages as $pkg)--}}
                                                {{--                                                                        <option--}}
                                                {{--                                                                            value="{{ $pkg->id }}">{{$pkg->translate($locale)->name }}</option>--}}
                                                {{--                                                                    @endforeach--}}
                                                {{--                                                                </select>--}}
                                                {{--                                                            </div>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                    </div>--}}
                                                <!--        ALL HOTELS              -->


                                                    <div class="plan_all_hotels">
                                                        @foreach($plans as $index => $plan)
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>{{$plan->translate($locale)->name}}
                                                                            Hotels</label>
                                                                        <select class="select2"
                                                                                name="hotels[{{$index}}][hotels][]"
                                                                                multiple="multiple"
                                                                                data-placeholder="Select Hotels"
                                                                                data-dropdown-css-class="select2-purple"
                                                                                style="width: 100%;">
                                                                            @foreach ($allHotels as $hotel)
                                                                                <option
                                                                                    {{--                                                                                    @if($plan->pkgs_hotels)--}}
                                                                                    {{--                                                                                    selected--}}
                                                                                    {{--                                                                                    @endif {{in_array($hotel->id ,$plan->pkgs_hotels) ?'selected' : ''}}--}}
                                                                                    value="{{ $hotel->id }}">{{$hotel->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <input type="hidden" value="{{$plan->id}}"
                                                                               name="hotels[{{$index}}][plan_id]">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                            @endif

                                            @if($locale == 'en')
                                                <!--        DAY INPUTS             -->
                                                    <div class="days_inputs">
                                                        <div class="days_inputs_container">
                                                            @foreach($package->days as $index => $day)
                                                                <div class="card card-info">
                                                                    <div class="card-header">
                                                                        <h3 class="card-title {{ app()->getLocale() == 'ar' ? 'float-left text-right' : '' }}">
                                                                            DAY {{ $index+1 }} </h3>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('site.day_title')</label>
                                                                                    <input type="text"
                                                                                           name="days[{{$dayCounts}}][en][title]"
                                                                                           class="form-control"
                                                                                           value="{{$day->translate('en')->title}}"
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('site.day_summery')</label>
                                                                                    <textarea
                                                                                        name="days[{{$dayCounts}}][en][summery]"
                                                                                        class="form-control ckeditor">{{$day->translate('en')->summery}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                        <button class="btn btn-secondary float-right my-2" type="button"
                                                                id="add_day">Add Day
                                                        </button>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <!--      END  DAY INPUTS             -->
                                                    <!--        SEASONS INPUTS             -->
                                                    <div class="seasons_inputs">
                                                        <div class="seasons_container">
                                                            @foreach($package->seasons as $index => $season)
                                                                <div class="card card-info">
                                                                    <div class="card-header">
                                                                        <h3 class="card-title {{ app()->getLocale() == 'ar' ? 'float-left text-right' : '' }}">
                                                                            Season {{$index+1}} </h3>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>@lang('site.season_start')</label>
                                                                                    <input type="date"
                                                                                           value="{{$season->start}}"
                                                                                           name="seasons[{{$seasonCounts}}][start]"
                                                                                           class="form-control"
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>@lang('site.season_end')</label>
                                                                                    <input type="date"
                                                                                           value="{{$season->end}}"
                                                                                           name="seasons[{{$seasonCounts}}][end]"
                                                                                           class="form-control"
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="seasons_price_lists">
                                                                            <div
                                                                                class="row justify-content-center align-items-center">
                                                                                @foreach($season->price_lists as  $index => $price_list)

                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <label>{{$price_list->plan->translate($locale)->name }}
                                                                                                Price</label>
                                                                                            <input type="number"
                                                                                                   name="seasons[{{$seasonCounts}}][price_list][{{$index}}][price]"
                                                                                                   value="{{$price_list->price}}"
                                                                                                   class="form-control"
                                                                                            >
                                                                                            <input type="hidden"
                                                                                                   name="seasons[{{$seasonCounts}}][price_list][{{$index}}][plan_id]"
                                                                                                   class="form-control"
                                                                                                   value="{{$price_list->plan_id}}"
                                                                                            >
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <button class="btn btn-secondary float-right" type="button"
                                                                id="add_season">Add Season
                                                        </button>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <!--      END  SEASONS INPUTS             -->
                                            @endif
                                            @if($locale == 'ar')
                                                <!--        DAY INPUTS             -->
                                                    <div class="days_inputs">
                                                        <div class="days_inputs_container_ar">
                                                            @foreach($package->days as $index => $day)
                                                                <div class="card card-info">
                                                                    <div class="card-header">
                                                                        <h3 class="card-title {{ app()->getLocale() == 'ar' ? 'float-left text-right' : '' }}">
                                                                            DAY {{ $index+1 }} </h3>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('site.day_title')</label>
                                                                                    <input type="text"
                                                                                           name="days[{{$dayCounts}}][ar][title]"
                                                                                           value="{{$day->translate('ar')->title}}"
                                                                                           class="form-control"
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('site.day_summery')</label>
                                                                                    <textarea
                                                                                        name="days[{{$dayCounts}}][ar][summery]"
                                                                                        class="form-control ckeditor"> {{$day->translate('ar')->summery}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <button class="btn btn-secondary float-right my-2" type="button"
                                                                id="add_day">Add Day
                                                        </button>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <!--      END  DAY INPUTS             -->
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
                                                                      class="form-control ckeditor"> {{$package->translate($locale)->short_description}}</textarea>
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
                                                                      class="form-control ckeditor summernote">{{$package->translate($locale)->overview}}</textarea>

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
                                                                   class="form-control"
                                                                   value="{{$includes->translate($locale)->name}}">

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

                                                                   class="form-control"
                                                                   value="{{$excludes->translate($locale)->name}}">

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- SEO ATTRIBUTES --->
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
                                                                   value="{{$package->seoAttributes->translate($locale)->page_title}}">
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
                                                                      class="form-control ckeditor">{{$package->seoAttributes->translate($locale)->meta_description}}</textarea>
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
                                                                   class="form-control "
                                                                   value="{{$package->seoAttributes->translate($locale)->og_title}}">
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
                                                                      class="form-control ckeditor">{{$package->seoAttributes->translate($locale)->og_description}}</textarea>
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
                                                                   class="form-control"
                                                                   value="{{$package->seoAttributes->translate($locale)->meta_keywords}}">

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END SEO ATTRIBUTES --->


                                            </div>
                                        </div>
                                @endforeach
                                <!-- STATUS & FEATURES--->
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>@lang('site.status')</label>
                                                <input type="checkbox" name="status"
                                                       value="1"
                                                       data-bootstrap-switch
                                                       class="form-control" {{$package->status === 1 ? 'checked' :''}}>

                                            </div>

                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>@lang('site.featured')</label>
                                                <input type="checkbox" name="featured"
                                                       value="1"
                                                       data-bootstrap-switch
                                                       class="form-control" {{$package->featured === 1 ? 'checked' :''}}>

                                            </div>

                                        </div>
                                    </div>
                                    <!-- END STATUS & FEATURES--->

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
@push('scripts')
    <script>
        var daycounts = 1;
        var seasoncounts = 1;
        $('#add_day').click(function () {
            daycounts++;
            $('.days_inputs_container').append(
                `
                                                                        <div class="card card-info">
                                                            <div class="card-header">
                                                                <h3 class="card-title {{ app()->getLocale() == 'ar' ? 'float-left text-right' : '' }}">
                                                                    DAY ${daycounts} </h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            @if(count(config('translatable.locales'))>1)
                <label>@lang('site.en.day_title')</label>
                                                                            @else
                <label>@lang('site.day_title')</label>
                                                                            @endif
                <input type="text"

                       name="days[${daycounts}][en][title]"
                                                                                   class="form-control"
                                                                                   >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            @if(count(config('translatable.locales'))>1)
                <label>@lang('site.en.day_summery')</label>
                                                                            @else
                <label>@lang('site.day_summery')</label>
                                                                            @endif
                <textarea name="days[${daycounts}][en][summery]"
                                                                                      class="form-control ckeditor"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

              `
            );
            $('.days_inputs_container_ar').append(
                `
                                                                        <div class="card card-info">
                                                            <div class="card-header">
                                                                <h3 class="card-title {{ app()->getLocale() == 'ar' ? 'float-left text-right' : '' }}">
                                                                    DAY ${daycounts} </h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            @if(count(config('translatable.locales'))>1)
                <label>@lang('site.ar.day_title')</label>
                                                                            @else
                <label>@lang('site.day_title')</label>
                                                                            @endif
                <input type="text"
                       name="days[${daycounts}][ar][title]"
                                                                                   class="form-control"
                                                                                   >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            @if(count(config('translatable.locales'))>1)
                <label>@lang('site.ar.day_summery')</label>
                                                                            @else
                <label>@lang('site.day_summery')</label>
                                                                            @endif
                <textarea name="days[${daycounts}][ar][summery]"
                                                                                      class="form-control ckeditor"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

              `
            )
        })
        $('#add_season').click(function () {
            seasoncounts++;
            $('.seasons_container').append(`
              <div class="card card-info">
                                                                <div class="card-header">
                                                                    <h3 class="card-title {{ app()->getLocale() == 'ar' ? 'float-left text-right' : '' }}">
                                                                        Season ${seasoncounts}</h3>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>@lang('site.season_start')</label>
                                                                                <input type="date"
                                                                                       name="seasons[${seasoncounts}][start]"
                                                                                       class="form-control"
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>@lang('site.season_end')</label>
                                                                                <input type="date"
                                                                                       name="seasons[${seasoncounts}][end]"
                                                                                       class="form-control"
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="seasons_price_lists">
                                                                        <div
                                                                            class="row justify-content-center align-items-center">
                                                                            @foreach($plans as $index => $plan)
            <div class="col-md-3">
                <div class="form-group">
                    <label>{{$plan->translate()->name}} Price</label>

                                                                                          <input type="number"
                                                                                               name="seasons[${seasoncounts}][price_list][{{$index}}][price]"
                                                                                               class="form-control"
                                                                                        >
                                                                                        <input type="hidden"
                                                                                               name="seasons[${seasoncounts}][price_list][{{$index}}][plan_id]"
                                                                                               class="form-control"
                                                                                               value="{{$plan->id}}"
                                                                                        >
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
            </div>
        </div>
    </div>
</div>
`)
        })
    </script>
@endpush
