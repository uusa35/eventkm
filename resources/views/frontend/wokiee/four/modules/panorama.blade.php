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
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div id="panoramaTour">
    </div>
</div>
</body>

<script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.4/build/pannellum.js"></script>
<script src="https://vjs.zencdn.net/5.4.6/video.js"></script>
<script src="https://pannellum.org/js/videojs-pannellum-plugin.js"></script>
<script>

    pannellum.viewer('panoramaTour', {
        "default": {
            "firstScene": "{{ $element->id }}",
            "author": "{{ $element->name }}",
            "sceneFadeDuration": 1000,
            "autoLoad": true,
            "compass": true,
        },
        "scenes": {
            "{{ $element->id }}": {
                "title": "{{ $element->name }}",
                "hfov": 110,
                "yaw": 5,
                "type": "equirectangular",
                "panorama": 'https://demo.sirv.com/panoramas/civic.jpg',
                "autoRotate": "-6",
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
</script>
</html>

