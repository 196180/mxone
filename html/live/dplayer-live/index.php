<!DOCTYPE html>
<html>
<head>
  <title>DPlayer直播源-播放器</title>
   <?php
    header('Content-Type: text/html;charset=utf-8');//utf-8格式
    header('Access-Control-Allow-Origin:*'); // *代表允许任何网址请求
    header('Access-Control-Allow-Methods:POST,GET,OPTIONS,DELETE'); // 允许请求的类型
    header('Access-Control-Allow-Credentials: true'); // 设置是否允许发送 cookies
    header('Access-Control-Allow-Headers: Content-Type,Content-Length,Accept-Encoding,X-Requested-with, Origin'); // 设置允许自定义请求头的字段
    ?>
    <meta name="referrer" content="always"> 
    <meta name="referrer" content="no-referrer" />	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=11" />
	<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" id="viewport" name="viewport">
	   <!--  新加 -->      
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><!-- IE内核 强制使用最新的引擎渲染网页 -->
    <meta name="referrer" content="no-referrer">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta http-equiv="Access-Control-Allow-Credentials" content="*"><!--解除跨域-->
    <meta name="renderer" content="webkit">  <!-- 启用360浏览器的极速模式(webkit) -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0 ,maximum-scale=1.0, user-scalable=no"><!-- 手机H5兼容模式 -->
    <meta name="x5-fullscreen" content="true" ><meta name="x5-page-mode" content="app" > <!-- X5  全屏处理 -->
    <meta name="full-screen" content="yes"><meta name="browsermode" content="application">  <!-- UC 全屏应用模式 -->
    <meta name="apple-mobile-web-app-capable" content="yes"> <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" /> <!--  苹果全屏应用模式 -->      
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="referrer" content="never">
	<!--  新加 --> 
	<style type="text/css">
	html,body{width:100%;height:100%; padding:0; margin:0;}
	#playerCnt{width:100%;height:100%;}
	</style>
	<link rel="stylesheet" href="./css/DPlayer.min.css">
	<script type="text/javascript" src="./js/hls.min.js"></script>
	<script type="text/javascript" src="./js/DPlayer.min.js"></script>
	<script src="/template/mxone/mxstatic/js/script.js"></script>
	<script language="javascript">
      function getSearch() {
        try {
          var url = location.search.replace(/&amp;/g, '#'),
          i;
          var lss = url.substr(url.indexOf('?') + 1).split('&');
          for (i = 0; i < lss.length; i++) if (lss[i].toLowerCase().indexOf(arguments[0].toLowerCase() + '=') == 0) return decodeURIComponent(lss[i].substr(lss[i].indexOf('=') + 1).replace(/\#/g, '&amp;'));
        } catch(e) {}
        return '';
      }
	  var tvurl = getSearch("url");
    </script>
</head>
<body marginwidth="0" marginheight="0">
<div id="dplayer"></div>
<script type="text/javascript">
    
    const dp = new DPlayer({
    container: document.getElementById('dplayer'),
    live: true,
    autoplay: true,
    
    apiBackend: {
        read: function (options) {
            console.log('Pretend to connect WebSocket');
            callback();
        },
        send: function (options) {
            console.log('Pretend to send danmaku via WebSocket', options.data);
            callback();
        },
    },
    video: {
        url: tvurl,
        type: 'hls',
    },
});
</script>
</body>
</html>