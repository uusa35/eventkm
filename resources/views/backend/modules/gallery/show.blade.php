@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                @include('backend.partials.forms.form_title')
                <div class="portlet-body">
                    <div class="m-heading-1 border-green m-bordered">
                        <h3>Important Information</h3>
                        <p>
                            Roles are very important for the application.
                        </p>
                        <p> Some Information about roles.
                            <a class="btn red btn-outline" href="https://datatables.net/" target="_blank">the official
                                documentation</a>
                        </p>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                @foreach($element->images as $img)
                                    <div class="col-lg-2">
                                        <img src="{{ asset('storage/uploads/images/thumbnail/'.$img->name) }}" class="img-sm img-thumbnail">
                                        <form method="post"
                                              action="{{ route('backend.image.destroy',$img->id) }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="delete"/>
                                            <button type="submit" class="btn btn-outline btn-sm red">
                                                <i class="fa fa-remove"></i>Delete Image
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
