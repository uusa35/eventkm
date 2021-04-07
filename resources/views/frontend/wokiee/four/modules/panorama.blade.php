<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.4/build/pannellum.css">
    <link href="https://vjs.zencdn.net/5.4.6/video-js.css" rel="stylesheet" type="text/css">
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        #panoramaTour {
            width: 100%;
            height: 100%;
        }
        #controls {
            position: absolute;
            bottom: 0;
            z-index: 2;
            text-align: center;
            width: 100%;
            padding-bottom: 3px;
        }
        .ctrl {
            padding: 8px 5px;
            width: 30px;
            text-align: center;
            background: rgba(200, 200, 200, 0.8);
            display: inline-block;
            cursor: pointer;
        }
        .ctrl:hover {
            background: rgba(200, 200, 200, 1);
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div id="panoramaTour">
        <div id="controls">
            <div class="ctrl" id="pan-up">&#9650;</div>
            <div class="ctrl" id="pan-down">&#9660;</div>
            <div class="ctrl" id="pan-left">&#9664;</div>
            <div class="ctrl" id="pan-right">&#9654;</div>
            <div class="ctrl" id="zoom-in">&plus;</div>
            <div class="ctrl" id="zoom-out">&minus;</div>
{{--            <div class="ctrl" id="fullscreen">&#x2922;</div>--}}
        </div>
    </div>
</div>
</body>

<script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.4/build/pannellum.js"></script>
<script src="https://vjs.zencdn.net/5.4.6/video.js"></script>
<script src="https://pannellum.org/js/videojs-pannellum-plugin.js"></script>
<script>

    viewer = pannellum.viewer('panoramaTour', {
        "default": {
            "firstScene": "{{ $element->id }}",
            "author": "{{ $element->name }}",
            "sceneFadeDuration": 1000,
            "preview" : "{!! $element->imageThumbLink !!}",
            "autoLoad" : true,
            "showControls" : false
        },
        "scenes": {
            "{{ $element->id }}": {
                "title": "{{ $element->name }}",
                "hfov": 110,
                "yaw": 5,
                "type": "equirectangular",
                "panorama": 'https://demo.sirv.com/panoramas/civic.jpg',
                "autoRotate": "-2",
                "autoLoad": true,
                "hotSpots": [
                    {
                        "pitch": -2.1,
                        "yaw": 1.9,
                        "type": "scene",
                        "text": "{{ $element->user->name }}",
                        "sceneId": "{{ $element->user->id }}",
                        "targetYaw": -23,
                        "targetPitch": 2
                    },
                    {
                        "pitch": -2.1,
                        "yaw": 25.1,
                        "type": "scene",
                        "text": "Hotel",
                        "sceneId": "100",
                        "targetYaw": -23,
                        "targetPitch": 2
                    },
                    {
                        "pitch": 14.1,
                        "yaw": 1.9,
                        "type": "info",
                        "text": "<div style='width: 250; height: 100'><h6>{!! $element->name !!}</h6><h6>{!! $element->finalPrice .' '. trans('general.kd')!!}</h6><img src='{!! $element->imageThumbLink !!}' style='width : 100px; height: 100px;'/></div>",
                        "URL": "{!! env('APP_URL') !!}"
                    },
                ]
            },
            "{{ $element->user->id }}": {
                "title": "{{ $element->user->name }}",
                "hfov": 110,
                "pitch": -3,
                "yaw": 117,
                "type": "equirectangular",
                "panorama": 'https://cdn.eso.org/images/screen/ESO_Paranal_360_Marcio_Cabral_Chile_07-CC.jpg',
                "autoLoad": true,
                "hotSpots": [
                    {
                        "pitch": -2.1,
                        "yaw": 20.9,
                        "type": "scene",
                        "text": "{{ $element->name }}",
                        "sceneId": "{{ $element->id }}",
                        "targetYaw": -23,
                        "targetPitch": 2
                    },
                    {
                        "pitch": -0.1,
                        "yaw": 10.1,
                        "type": "scene",
                        "text": "Hotel",
                        "sceneId": "100",
                        "targetYaw": -23,
                        "targetPitch": 2
                    },
                ]
            },
            "100": {
                "title": "Hotel",
                "hfov": 110,
                "yaw": 5,
                "type": "equirectangular",
                "panorama": 'https://cdn.eso.org/images/screen/ESO_Hotel_Paranal_360_Marcio_Cabral_Chile_011-CC.jpg',
                "autoLoad": true,
                "hotSpots": [
                    {
                        "pitch": -0.6,
                        "yaw": 20.1,
                        "type": "scene",
                        "text": "{{ $element->user->name }}",
                        "sceneId": {{ $element->user->id }},
                        "targetYaw": -23,
                        "targetPitch": 2
                    },
                    {
                        "pitch": -0.10,
                        "yaw": 10.1,
                        "type": "scene",
                        "text": "{{ $element->name }}",
                        "sceneId": {{ $element->id }},
                        "targetYaw": -23,
                        "targetPitch": 2
                    }
                ]
            },
        }
    });
    // Make buttons work
    document.getElementById('pan-up').addEventListener('click', function(e) {
        viewer.setPitch(viewer.getPitch() + 10);
    });
    document.getElementById('pan-down').addEventListener('click', function(e) {
        viewer.setPitch(viewer.getPitch() - 10);
    });
    document.getElementById('pan-left').addEventListener('click', function(e) {
        viewer.setYaw(viewer.getYaw() - 10);
    });
    document.getElementById('pan-right').addEventListener('click', function(e) {
        viewer.setYaw(viewer.getYaw() + 10);
    });
    document.getElementById('zoom-in').addEventListener('click', function(e) {
        viewer.setHfov(viewer.getHfov() - 10);
    });
    document.getElementById('zoom-out').addEventListener('click', function(e) {
        viewer.setHfov(viewer.getHfov() + 10);
    });
    document.getElementById('fullscreen').addEventListener('click', function(e) {
        viewer.toggleFullscreen();
    });
</script>
</html>

