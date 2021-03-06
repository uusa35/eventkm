@extends('backend.layouts.app')


@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.product.index') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                @include('backend.partials.forms.form_title',['title' => trans('general.product_attributes_index')])
                <div class="portlet-body">
                    @include('backend.partials._admin_instructions',['title' => trans('general.products') ,'message' => trans('message.product_attributes_index')])
                    <table id="dataTable" class="table table-striped table-bordered table-hover" cellspacing="0">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>{{ trans('general.id') }}</th>
                            <th>{{ trans('general.product_name') }}</th>
                            <th>{{ trans('general.size') }}</th>
                            <th>{{ trans('general.color') }}</th>
                            <th>{{ trans('general.qty') }}</th>
                            <th>{{ trans('general.notes_ar') }}</th>
                            <th>{{ trans('general.notes_en') }}</th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>{{ trans('general.id') }}</th>
                            <th>{{ trans('general.product_id') }}</th>
                            <th>{{ trans('general.product_name') }}</th>
                            <th>{{ trans('general.size') }}</th>
                            <th>{{ trans('general.color') }}</th>
                            <th>{{ trans('general.qty') }}</th>
                            <th>{{ trans('general.notes_ar') }}</th>
                            <th>{{ trans('general.notes_en') }}</th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($elements as $element)
                            <tr>
                                <td>{{ $element->id }}</td>
                                <td>{{ $element->product_id }}</td>
                                <td>{{ $element->product->name }}</td>
                                <td>{{ $element->size->name }}</td>
                                <td>
                                    <span class="btn btn-info">{{ $element->color->name }}</span>
                                </td>
                                <td>
                                    {{ $element->qty }}
                                </td>
                                <td>
                                    {{ $element->notes_ar }}
                                </td>
                                <td>
                                    {{ $element->notes_en }}
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button"
                                                style="background-color: white; color : black; font-weight: bolder"
                                                class="btn green btn-sm btn-outline"
                                                data-toggle="dropdown"> {{ $element->color->name_en }}
                                            - {{ $element->size->name_en }} - {{ $element->qty }}
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{ route('backend.attribute.edit',['attribute' => $element->id , 'product_id' => $element->product_id]) }}">
                                                    <i class="fa fa-fw fa-edit"></i> {{ trans('general.edit') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a data-toggle="modal" href="#" data-target="#basic"
                                                   data-title="Delete"
                                                   data-content="Are you sure you want to delete attribute ? "
                                                   data-form_id="delete-{{ $element->id }}">
                                                    <i class="fa fa-fw fa-recycle"></i> {{ trans('general.delete') }}
                                                </a>
                                                <form method="post" id="delete-{{ $element->id }}"
                                                      action="{{ route('backend.attribute.destroy',$element->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="delete"/>
                                                    <button type="submit" class="btn btn-del hidden">
                                                        <i class="fa fa-fw fa-times-circle"></i> {{ trans('general.delete') }}
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>

                                </td>
                                {{--                                <td>--}}
                                {{--                                    <div class="btn-group">--}}
                                {{--                                        <button type="button" class="btn green btn-xs btn-outline dropdown-toggle"--}}
                                {{--                                                data-toggle="dropdown"> Actions--}}
                                {{--                                            <i class="fa fa-angle-down"></i>--}}
                                {{--                                        </button>--}}
                                {{--                                        <ul class="dropdown-menu pull-right" role="menu">--}}
                                {{--                                            <li>--}}
                                {{--                                                <a href="{{ route('backend.attribute.edit',$element->id) }}">--}}
                                {{--                                                    <i class="fa fa-fw fa-edit"></i> Edit</a>--}}
                                {{--                                            </li>--}}
                                {{--                                            <li>--}}
                                {{--                                                <a href="{{ route('backend.activate',['model' => 'ProductAttribute','id' => $element->id]) }}">--}}
                                {{--                                                    <i class="fa fa-fw fa-check-circle"></i> toggle active</a>--}}
                                {{--                                            </li>--}}
                                {{--                                            <li>--}}
                                {{--                                                <a data-toggle="modal" href="#" data-target="#basic"--}}
                                {{--                                                   data-title="Delete"--}}
                                {{--                                                   data-content="Are you sure you want to delete {{ $element->name  }}? "--}}
                                {{--                                                   data-form_id="delete-{{ $element->id }}"--}}
                                {{--                                                >--}}
                                {{--                                                    <i class="fa fa-fw fa-recycle"></i> delete</a>--}}
                                {{--                                                <form method="post" id="delete-{{ $element->id }}"--}}
                                {{--                                                      action="{{ route('backend.attribute.destroy',$element->id) }}">--}}
                                {{--                                                    @csrf--}}
                                {{--                                                    <input type="hidden" name="_method" value="delete"/>--}}
                                {{--                                                    <button type="submit" class="btn btn-del hidden">--}}
                                {{--                                                        <i class="fa fa-fw fa-times-circle"></i> delete--}}
                                {{--                                                    </button>--}}
                                {{--                                                </form>--}}
                                {{--                                            </li>--}}
                                {{--                                        </ul>--}}
                                {{--                                    </div>--}}
                                {{--                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
