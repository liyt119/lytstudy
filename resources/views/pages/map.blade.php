<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>基站位置展示</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link href="{{mix('css/app.css')}}" rel="stylesheet">
    <style>
        body,
        html,
        #container {
            overflow: hidden;
            width: 100%;
            height: 100%;
            margin: 0;
            font-family: "微软雅黑";
        }
    </style>
    <script src="//api.map.baidu.com/api?type=webgl&v=1.0&ak=1Xvsb5v2zjuVINWLRcPMzMMxmDnEAjwL"></script>
</head>

<body>
    @include('layouts._header')
    <div id="container"></div>
    @include('layouts._footer')
</body>

</html>
<script>
    var map = new BMapGL.Map('container');

    map.enableScrollWheelZoom(true);
    var data_info = {!!$jizhan_sum!!};
    //i<data_info.length
    for (var i = 0; i < 100; i++) {
        (function(x) {
            map.centerAndZoom(new BMapGL.Point(113.673024, 34.758452), 19);
            var marker = new BMapGL.Marker(new BMapGL.Point(data_info[i]['lon'], data_info[i]['lat'])); // 创建添加点标记
            //开始鼠标滚轮缩放
            map.enableScrollWheelZoom(true);
            map.setHeading(64.5);
	        map.setTilt(73);
            
            var opts = {
                width: 300,
                height: 100,
                title: '基站信息',
                enableMessage: true
            };
            // 创建图文信息窗口
            var sContent = '基站名称：' + data_info[i]['name'] + "<br/>" +
                '基站编号：' + data_info[i]['bh'] + "<br/>" +
                '所属分区：' + data_info[i]['region'] + "<br/>";
            var infoWindow = new BMapGL.InfoWindow(sContent, opts);
            marker.addEventListener('click', function(e) {
                this.openInfoWindow(infoWindow, marker);
                // 图片加载完毕重绘infoWindow
                document.getElementById('imgDemo').onload = function() {
                    infoWindow.redraw(); // 防止在网速较慢时生成的信息框高度比图片总高度小，导致图片部分被隐藏
                };
            });
            map.addOverlay(marker);
        })(i);
    }
</script>