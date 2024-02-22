
<!DOCTYPE html>
<html>
<head>
	<title>dplayer播放器</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=11" />
	<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" id="viewport" name="viewport">
	<style type="text/css">
	html,body{width:100%;height:100%; padding:0; margin:0;}
	#playerCnt{width:100%;height:100%;}
	</style>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/ysgccc/css/DPlayer.min.css">
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/hls.js/dist/hls.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/dplayer/dist/DPlayer.min.js"></script>
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