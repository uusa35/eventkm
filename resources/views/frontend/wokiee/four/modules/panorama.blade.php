@extends('frontend.wokiee.four.layouts.app')

@section('body')
    <div class="container-indent">
        <div class="container  container-fluid-mobile">
            <div class="row">

        </div>
    </div>
@endsection

@section('scripts')
    @parent
    @desktop
    <script type="text/javascript"
            src="https://platform-api.sharethis.com/js/sharethis.js#property=5c6ed2597056550011c4ab2a&product=inline-share-buttons"></script>
    @enddesktop
@endsection

