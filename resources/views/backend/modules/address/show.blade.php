@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                @include('backend.partials.forms.form_title')

                <div class="portlet-body">
                    <table id="dataTable" class="table table-striped table-bordered table-hover" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>flag</th>
                            <th>bg</th>
                            <th>code</th>
                            <th>active</th>
                            <th>abbreviation</th>
                            <th>order</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>flag</th>
                            <th>bg</th>
                            <th>code</th>
                            <th>active</th>
                            <th>abbreviation</th>
                            <th>order</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <tr>
                            <td>{{ $element->id }}</td>
                            <td>{{ $element->name }}</td>
                            <td>
                                <img src="{{ asset('storage/uploads/images/thumbnail/'.$element->flag) }}"
                                     class="img-xs"
                                     alt="">
                            </td>
                            <td>
                                <img src="{{ asset('storage/uploads/images/thumbnail/'.$element->bg) }}" class="img-xs"
                                     alt="">
                            </td>
                            <td>{{ $element->code }}</td>
                            <td>
                                <span class="label {{ activeLabel($element->active) }}">{{ activeText($element->active) }}</span>
                            </td>
                            <td>{{ $element->abbreviation }}</td>
                            <td>{{ $element->order }}</td>
                            <td>
                                <div class="btn-group pull-right">
                                    <button type="button" class="btn green btn-sm btn-outline dropdown-toggle"
                                            data-toggle="dropdown"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="{{ route('backend.country.edit',$element->id) }}">
                                                <i class="fa fa-fw fa-edit"></i>edit</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('backend.governate.create',['country_id' => $element->id]) }}">
                                                <i class="fa fa-fw fa-edit"></i>add new governate</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('backend.activation',['model' => 'country','id' => $element->id]) }}">
                                                <i class="fa fa-fw fa-check-circle"></i> toggle active</a>
                                        </li>
                                        @if($element->governates->isEmpty())
                                            <li>
                                                <form method="post"
                                                      action="{{ route('backend.country.destroy',$element->id) }}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="delete"/>
                                                    <button type="submit" class="btn btn-outline btn-sm red">
                                                        <i class="fa fa-remove"></i>delete
                                                    </button>
                                                </form>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                {{--Governates --}}
                <div class="portlet-body">
                    <h1>{{ $element->name }} Governates</h1>
                    <hr>
                    <table id="secondDataTable" class="table table-striped table-bordered table-hover" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>order</th>
                            <th>active</th>
                            <th>country_id</th>
                            <th>areas</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>order</th>
                            <th>active</th>
                            <th>country_id</th>
                            <th>areas</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($element->governates as $governate)
                            <tr>
                                <td>{{ $governate->id }}</td>
                                <td>{{ $governate->name }}</td>
                                <td>{{ $governate->order }}</td>
                                <td>
                                    <span class="label {{ activeLabel($governate->active) }}">{{ activeText($governate->active) }}</span>
                                </td>
                                <td>{{ $governate->country->name }}</td>
                                <td>
                                    @if(!$governate->areas->isEmpty())
                                        @foreach($governate->areas as $area)
                                            <div class="keep-open btn-group" title="Columns">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown"
                                                        aria-expanded="false">
                                                    {{ $area->name }}
                                                </button>
                                                <ul class="dropdown-menu pull-right" role="menu">
                                                    <li>
                                                        <a href="{{ route('backend.area.edit',$area->id) }}">
                                                            <i class="fa fa-fw fa-edit"></i>edit</a>
                                                    </li>
                                                    <li>
                                                        <form method="post"
                                                              action="{{ route('backend.area.destroy',$area->id) }}"
                                                              class="col-lg-12">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="_method" value="delete"/>
                                                            <button type="submit" class="btn btn-sm red">
                                                                <i class="fa fa-remove"></i>Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="label {{ activeLabel($governate->active) }}">{{ activeText($governate->active,'Empty')}}</span>
                                    @endif
                                </td>


                                <td>
                                    <div class="btn-group pull-right">
                                        <button type="button" class="btn green btn-sm btn-outline dropdown-toggle"
                                                data-toggle="dropdown"> Actions
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li>
                                                <a href="{{ route('backend.governate.edit',$governate->id) }}">
                                                    <i class="fa fa-fw fa-edit"></i>edit</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('backend.activation',['model' => 'governate','id' => $governate->id]) }}">
                                                    <i class="fa fa-fw fa-check-circle"></i> toggle active</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('backend.area.store',['governate_id' => $governate->id]) }}">
                                                    <i class="fa fa-fw fa-plus-circle"></i>add new area</a>
                                            </li>
                                            @if($governate->areas->isEmpty())
                                                <li>
                                                    <form method="post"
                                                          action="{{ route('backend.governate.destroy',$governate->id) }}">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="delete"/>
                                                        <button type="submit" class="btn btn-outline btn-sm red">
                                                            <i class="fa fa-remove"></i>delete
                                                        </button>
                                                    </form>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection