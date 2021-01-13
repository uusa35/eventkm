@extends('backend.layouts.app')


@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.product.index') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                @include('backend.partials.forms.form_title',['title' => trans('general.index_product')])
                <div class="portlet-body">
                    @include('backend.partials._admin_instructions',['title' => trans('general.products') ,'message' => trans('message.index_product')])
                    <table id="dataTable" class="table table-striped table-bordered table-hover" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th class="all">{{ trans('general.id') }}</th>
                            <th>{{ trans('general.sku') }}</th>
                            <th>{{ trans('general.name') }}</th>
                            <th>{{ trans('general.price') }}</th>
                            <th class="none">{{ trans('general.on_sale') }}</th>
                            <th class="none">{{ trans('general.sale_price') }}</th>
                            <th class="none">{{ trans('general.weight') }}</th>
                            <th>{{ trans('general.image') }}</th>
                            <th class="none">{{ trans('general.end_sale') }}</th>
                            <th>{{ trans('general.active') }}</th>
                            <th class="none">{{ trans('general.company') }}</th>
                            <th class="none">{{ trans('general.created_at') }}</th>
                            <th class="none">{{ trans('general.barcode') }}</th>
                            <th>{{ trans('general.attributes') }} x/clr/qty</th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th class="all">{{ trans('general.id') }}</th>
                            <th>{{ trans('general.sku') }}</th>
                            <th>{{ trans('general.name') }}</th>
                            <th>{{ trans('general.price') }}</th>
                            <th class="none">{{ trans('general.on_sale') }}</th>
                            <th class="none">{{ trans('general.sale_price') }}</th>
                            <th class="none">{{ trans('general.weight') }}</th>
                            <th>{{ trans('general.image') }}</th>
                            <th class="none">{{ trans('general.end_sale') }}</th>
                            <th>{{ trans('general.active') }}</th>
                            <th class="none">{{ trans('general.company') }}</th>
                            <th class="none">{{ trans('general.created_at') }}</th>
                            <th class="none">{{ trans('general.barcode') }}</th>
                            <th>{{ trans('general.attributes') }} x/clr/qty</th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($elements as $element)
                            <tr>
                                <td>{{ $element->id }}</td>
                                <td>{{ $element->sku }}</td>
                                <td>{{ str_limit($element->name,25) }}</td>
                                {{--<td>--}}
                                {{--<span class="label {{ activeLabel($element->home_delivery_availability) }}">{{ activeText($element->home_delivery_availability,'Yes') }}</span>--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                {{--<span class="label {{ activeLabel($element->shipment_availability) }}">{{ activeText($element->shipment_availability,'Yes') }}</span>--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                {{--<span class="label {{ activeLabel($element->on_sale) }}">{{ activeText($element->on_sale,'OnSale') }}</span>--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                {{--<span class="label {{ activeLabel($element->on_home) }}">{{ activeText($element->on_home,'onHome') }}</span>--}}
                                {{--</td>--}}
                                <td>
                                    {{ $element->price }}
                                </td>
                                <td>
                                    <label class="label {{ $element->isOnSale ? 'label-success' : 'label-warning'}}"><b>{{ $element->isOnSale ? 'Yes' : 'No'}}</b></label>
                                </td>
                                <td>
                                    {!! $element->sale_price ? $element->sale_price : '<label class="label label-warning"><b>N/A</b></label>'!!}
                                </td>
                                <td>
                                    {{ $element->weight }} {{ trans('general.kg') }}
                                </td>
                                <td>
                                    <img class="img-xs" src="{{ $element->getCurrentImageAttribute() }}" alt="">
                                </td>
                                <td>{{ !is_null($element->end_sale) ? $element->end_sale->format('Y-m-d') : null }}</td>
                                <td>
                                    <span class="label {{ activeLabel($element->active) }}">{{ activeText($element->active) }}</span>
                                </td>
                                <td>{{ $element->user ?  str_limit($element->user->slug,20) : '<label class="label label-warning"><b>N/A</b></label>' }}</td>
                                <td>{{ $element->created_at }}</td>
                                <td>{!! $element->barcode ? DNS2D::getBarcodeHTML($element->barcode, env('BARCODE_TYPE'),2,1) : '<label class="label label-warning"><b>N/A</b></label>' !!}</td>
                                <td>
                                    @if($element->product_attributes->isNotEmpty())
                                        @foreach($element->product_attributes as $attribute)
                                            <div class="btn-group">
                                                <button type="button"
                                                        style="background-color: white; color : black; font-weight: bolder"
                                                        class="btn green btn-sm btn-outline"
                                                        data-toggle="dropdown"> {{ $attribute->color->name_en }}
                                                    - {{ $attribute->size->name_en }} - {{ $attribute->qty }}
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="{{ route('backend.attribute.edit',['attribute' => $attribute->id , 'product_id' => $attribute->product_id]) }}">
                                                            <i class="fa fa-fw fa-edit"></i> {{ trans('general.edit') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="modal" href="#" data-target="#basic"
                                                           data-title="Delete"
                                                           data-content="Are you sure you want to delete attribute ? "
                                                           data-form_id="delete-attribute_id-{{ $attribute->id }}">
                                                            <i class="fa fa-fw fa-recycle"></i> {{ trans('general.delete') }}
                                                        </a>
                                                        <form method="post" id="delete-attribute_id-{{ $attribute->id }}"
                                                              action="{{ route('backend.attribute.destroy',$attribute->id) }}">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="delete"/>
                                                            <button type="submit" class="btn btn-del hidden">
                                                                <i class="fa fa-fw fa-times-circle"></i> {{ trans('general.delete') }}
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                            <br>
                                            <br>
                                        @endforeach
                                    @else
                                        <span class="label label-danger">{{ trans('general.not_available') }}/A</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn green btn-xs btn-outline dropdown-toggle"
                                                data-toggle="dropdown"> {{ trans('general.actions') }}
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        @if(!$element->trashed())
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li>
                                                    <a href="{{ route('backend.product.edit',$element->id) }}">
                                                        <i class="fa fa-fw fa-edit"></i> {{ trans('general.edit') }}</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('backend.activate',['model' => 'product','id' => $element->id]) }}">
                                                        <i class="fa fa-fw fa-check-circle"></i> {{ trans('general.toggle_active') }}
                                                    </a>
                                                </li>
                                                @if($element->has_attributes)
                                                    <li>
                                                        <a href="{{ route('backend.attribute.create',['product_id' => $element->id]) }}">
                                                            <i class="fa fa-fw fa-plus-square"></i> {{ trans('general.assign_new_attribute') }}
                                                        </a>
                                                    </li>
                                                @endif
                                                @can('isAdminOrAbove')
                                                    @can('index','slide')
                                                        <li>
                                                            <a href="{{ route('backend.slide.create',['slidable_id' => $element->id, 'slidable_type' => 'product']) }}">
                                                                <i class="fa fa-fw fa-edit"></i> {{ trans('general.new_slide') }}
                                                            </a>
                                                        </li>
                                                        @if($element->slides->isNotEmpty())
                                                            <li>
                                                                <a href="{{ route('backend.slide.index',['slidable_id' => $element->id, 'slidable_type' => 'product']) }}">
                                                                    <i class="fa fa-fw fa-edit"></i> {{ trans('general.list_of_slides') }}
                                                                </a>
                                                            </li>
                                                        @endif
                                                    @endcan
                                                @else
                                                    @can('slide.create')
                                                        <li>
                                                            <a href="{{ route('backend.slide.create',['slidable_id' => $element->id, 'slidable_type' => 'product']) }}">
                                                                <i class="fa fa-fw fa-edit"></i> {{ trans('general.new_slide') }}
                                                            </a>
                                                        </li>
                                                    @endcan
                                                    @if($element->slides->isNotEmpty())
                                                        @can('index','slide')
                                                            <li>
                                                                <a href="{{ route('backend.slide.index',['slidable_id' => $element->id, 'slidable_type' => 'product']) }}">
                                                                    <i class="fa fa-fw fa-edit"></i> {{ trans('general.list_of_slides') }}
                                                                </a>
                                                            </li>
                                                        @endcan
                                                    @endif
                                                @endcan
                                                @if(!$element->trashed())
                                                    <li>
                                                        <a data-toggle="modal" href="#" data-target="#basic"
                                                           data-title="Delete"
                                                           data-content="Are you sure you want to delete {{ $element->name  }}? "
                                                           data-form_id="delete-{{ $element->id }}">
                                                            <i class="fa fa-fw fa-recycle"></i> {{ trans('general.delete') }}
                                                        </a>
                                                        <form method="post" id="delete-{{ $element->id }}"
                                                              action="{{ route('backend.product.destroy',$element->id) }}">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="delete"/>
                                                            <button type="submit" class="btn btn-del hidden">
                                                                <i class="fa fa-fw fa-times-circle"></i> {{ trans('general.delete') }}
                                                            </button>
                                                        </form>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ route('backend.product.restore',$element->id) }}">
                                                            <i class="fa fa-fw fa-window-restore"></i> {{ trans('general.restore') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        @else
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li>
                                                    <a href="{{ route('backend.product.restore',$element->id) }}">
                                                        <i class="fa fa-fw fa-edit"></i> {{ trans('general.restore') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
{{--                    {{ $elements->render('pagination::bootstrap-4') }}--}}
                    {{ $elements->appends($_GET)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
