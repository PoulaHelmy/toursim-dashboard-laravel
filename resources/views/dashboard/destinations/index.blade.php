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
            </ol>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center align-items-center">
                    <div class="col-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-12 col-md-4">
                                        <h3 class="card-title {{ app()->getLocale() == 'ar' ? 'float-left text-right' : '' }}">@lang('site.destinations')</h3>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <form action="{{ route('destinations.index') }}" method="get">
                                            <div class="row justify-content-end align-items-center">
                                                <div class="col-md-4">
                                                    <input type="text" name="search" class="form-control"
                                                           placeholder="@lang('site.search')"
                                                           value="{{ request()->search }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-search"></i> @lang('site.search')</button>
                                                    @if (auth()->user()->hasPermission('create_destination'))
                                                        <a href="{{ route('destinations.create') }}"
                                                           class="btn btn-primary"><i
                                                                class="fa fa-plus"></i> @lang('site.add')</a>
                                                    @else
                                                        <a href="#" class="btn btn-primary disabled"><i
                                                                class="fa fa-plus"></i> @lang('site.add')</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </form><!-- end of form -->
                                    </div>
                                </div>
                            </div>

                            @if ($finalResults->count() > 0)

                                <table class="table table-hover">

                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('site.name')</th>
                                        <th>@lang('site.slug')</th>
                                        @if (auth()->user()->hasPermission('update_destination','delete_destination'))
                                            <th>@lang('site.action')</th>
                                        @endif
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($finalResults as $index => $row)
                                        <tr>
                                            <td>{{ $index + 1+(($finalResults->currentPage()-1) * $finalResults->perPage()) }}</td>
                                            <td>{{$row->name}}</td>
                                            <td>
                                                {{$row->slug}}
                                            </td>
                                            <td>
                                                {{--                                                @if (auth()->user()->hasPermission('read_destinations'))--}}
                                                {{--                                                    <a href="{{ route('destinations.show',  $row->id) }}"--}}
                                                {{--                                                       class="btn btn-info btn-sm">@lang('site.show')</a>--}}
                                                {{--                                                @endif--}}
                                                @if (auth()->user()->hasPermission('update_destination'))
                                                    <a href="{{ route('destinations.edit', $row->id) }}"
                                                       class="btn btn-info btn-sm"><i
                                                            class="fa fa-edit"></i> @lang('site.edit')
                                                    </a>
                                                @else
                                                    <a href="#" class="btn btn-info btn-sm disabled"><i
                                                            class="fa fa-edit"></i> @lang('site.edit')</a>
                                                @endif
                                                @if (auth()->user()->hasPermission('delete_destination'))
                                                    <form action="{{ route('destinations.destroy', $row->id) }}"
                                                          method="post"
                                                          style="display: inline-block">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        <button type="submit"
                                                                class="btn btn-danger delete btn-sm swalDefaultErrorCheck">
                                                            <i
                                                                class="fa fa-trash"></i> @lang('site.delete')</button>
                                                    </form><!-- end of form -->
                                                @else
                                                    <button class="btn btn-danger btn-sm disabled"><i
                                                            class="fa fa-trash"></i> @lang('site.delete')</button>
                                                @endif
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>

                                </table><!-- end of table -->

                                {{ $finalResults->appends(request()->query())->links() }}

                            @else

                                <div class="error-content text-center my-4">
                                    <h3><i class="fas fa-exclamation-triangle text-warning"></i>
                                        Oops! @lang('site.no_data_found')</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- end of content -->
    </div><!-- end of content wrapper -->
@endsection
