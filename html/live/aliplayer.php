<!--阿里云直连文件-播放器觅知制作20221-14-->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="IE=edge" >
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no"/>
<title>Aliplayer Online Settings</title>
<link rel="stylesheet" href="https://g.alicdn.com/de/prismplayer/2.9.17/skins/default/aliplayer-min.css" />
<script type="text/javascript" charset="utf-8" src="https://g.alicdn.com/de/prismplayer/2.9.17/aliplayer-min.js"></script>

<!--阿里云播放器自适应高宽度-->
<style>
    
            html,body{
                background-color:#000;
                padding: 0;
                margin: 0;
                height:100%;
                width:100%;
                color:#999;
                overflow:hidden;
            }
            #video{
                height:100%!important;
                width:100%!important;
            }
    
    
</style>

<!--阿里云播放器自适应高宽度-->


</head>
<body>
<div class="prism-player" id="player-con"></div>
<script>
var player = new Aliplayer({
  "id": "player-con",
  "source":'<?php echo ($_GET['url']); ?>',
  "width": "100%",
  "height": "100%",
  "autoplay": true,
  "isLive": false,
  "rePlay": false,
  "playsinline": true,
  "preload": true,
  "language": "zh-cn",
  "controlBarVisibility": "hover",
  "useH5Prism": true,
  "extraInfo": {
    "crossOrigin": "anonymous"
  },
  "skinLayout": [
    {
      "name": "bigPlayButton",
      "align": "blabs",
      "x": 30,
      "y": 80
    },
    {
      "name": "H5Loading",
      "align": "cc"
    },
    {
      "name": "errorDisplay",
      "align": "tlabs",
      "x": 0,
      "y": 0
    },
    {
      "name": "infoDisplay"
    },
    {
      "name": "tooltip",
      "align": "blabs",
      "x": 0,
      "y": 56
    },
    {
      "name": "thumbnail"
    },
    {
      "name": "controlBar",
      "align": "blabs",
      "x": 0,
      "y": 0,
      "children": [
        {
          "name": "progress",
          "align": "blabs",
          "x": 0,
          "y": 44
        },
        {
          "name": "playButton",
          "align": "tl",
          "x": 15,
          "y": 12
        },
        {
          "name": "timeDisplay",
          "align": "tl",
          "x": 10,
          "y": 7
        },
        {
          "name": "fullScreenButton",
          "align": "tr",
          "x": 10,
          "y": 12
        },
        {
          "name": "subtitle",
          "align": "tr",
          "x": 15,
          "y": 12
        },
        {
          "name": "setting",
          "align": "tr",
          "x": 15,
          "y": 12
        },
        {
          "name": "volume",
          "align": "tr",
          "x": 5,
          "y": 10
        },
        {
          "name": "snapshot",
          "align": "tr",
          "x": 10,
          "y": 12
        }
      ]
    }
  ]
}, function (player) {
    console.log("The player is created");
  }
);
/* h5截图按钮, 截图成功回调 */
player.on('snapshoted', function (data) {
  var pictureData = data.paramData.base64
  var downloadElement = document.createElement('a')
  downloadElement.setAttribute('href', pictureData)
  var fileName = 'Aliplayer' + Date.now() + '.png'
  downloadElement.setAttribute('download', fileName)
  downloadElement.click()
  pictureData = null
})
</script>
</body>