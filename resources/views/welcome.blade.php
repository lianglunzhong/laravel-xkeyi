<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>xkeyi</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 60px;
            background: #1b1c1d;
            width: 100%;
            overflow: hidden;
        }
        .content-box {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }
        .content-info p {
            font-size: 16px;
        }
        .content-img img {
            width: 250px;
            height: 250px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        xkeyi
                    </a>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="content-box">
                        <div class="content-info">
                            <p>本人太懒，还没有写完... </p>
                            <P>不过，可以扫码体验小程序，效果更棒哦</P>
                        </div>
                        <div class="content-img">
                            <img src="{{ asset('images/static/xiaochengxu.jpg') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <div style="margin:0 auto; padding:20px 0;">
                    <a target="_blank" href="http://www.beianbeian.com/s?keytype=0&q=xkeyi.top" style="display:inline-block;text-decoration:none;height:20px;line-height:20px; vertical-align: middle;margin-right: 20px;"><p style="float:left;height:20px;line-height:20px;margin: 0px 0px 0px 5px; color:#939393;">苏ICP备18045827号-1</p></a>
                    <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=32010202010482" style="display:inline-block;text-decoration:none;height:20px;line-height:20px; vertical-align: middle;"><img src="" style="float:left;"/><p style="float:left;height:20px;line-height:20px;margin: 0px 0px 0px 5px; color:#939393;"><img src="/images/static/beian.png"> 苏公网安备 32010202010482号</p></a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
