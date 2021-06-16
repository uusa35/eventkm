@extends('backend.layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                create new campaign
            </div>
            <div class="panel-body">
                {{ Form::open(['route' => 'backend.newsletter.campaign.send', 'method' => 'post','class' => 'form-horizontal','files' => true]) }}
                        <!-- Text input https://getbootstrap.com/css/#forms -->
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="name" class="control-label">title</label>
                        <input type="text" class="form-control" name="title" placeholder="title"
                               required="">

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="control-label" for="body">body</label>
                            <textarea class="form-control" name="body" rows="6"></textarea>

                    </div>
                </div>

                <!-- Button https://getbootstrap.com/css/#buttons -->
                <div class="form-group">
                    <div class="text-right col-sm-10">
                        <button type="submit" class="btn btn-primary">
                            submit
                        </button>

                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
