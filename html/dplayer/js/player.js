var youqi = {
	'player': {
		'loaded': function() {
			player.addListener('loadedmetadata', ckdata);
			player.addListener('time', cktime);
			player.addListener('ended', ckended);
		},
		'aliplayer': function(auto, urls, jump) {
			var player = new Aliplayer({
				useFlashPrism: true,
				autoplay: auto,
				source: urls,
				id: 'video'
			});
			player.on('ended', function() {
				if(parent.MacPlayer.PlayLinkNext!=''){
				top.location.href = parent.MacPlayer.PlayLinkNext;
				}
				});
		},
		'ckplayer': function(auto, urls, jump) {
			var seek = youqi.cookie.get(cookie) ? youqi.cookie.get(cookie) : 0;
			player.newVideo({
				loaded: 'youqi.player.loaded',
				container: '#video',
				variable: 'player',
				autoplay: auto,
				video: urls,
				seek: seek
			});
		},
		'dplayer': function(auto, urls, jump) {
			var type = urls.indexOf('.m3u8') > -1 ? 'customHls' : 'auto';
			var player = new DPlayer({
				container: document.getElementById('video'),
				autoplay: auto,
                logo: 'https://lezhuiju.com/dplayer/img/logo.png',
				video: {
                    pic: 'https://lezhuiju.com/dplayer/img/jiazai.png',
					url: urls,
					type: type,
					customType: {
						'customHls': function(video, player) {
							var hls = new Hls();
							hls.loadSource(video.src);
							hls.attachMedia(video);
							var engine = new P2PEngine(hls, {
								wsSignalerAddr: 'wss://free.freesignal.net',
								maxBufSize: 1073741824
							});
							engine.on('peerId', function(peerId) {
								$('.load').text('加载0MB 共享20MB 加速50MB');
								$('.peer').text('P2P已开启');
								$('.line').text('在线0NP');
							});
							engine.on('peers', function(peers) {
								$('.line').text('在线' + peers.length + 'NP');
								$('.peer').text('P2P已开启');
							});
							engine.on('stats', function(data) {
								$('.load').text('加载' + Math.floor((data.totalHTTPDownloaded / 1024) * 100) / 100 + 'MB 共享' + Math.floor((data.totalP2PUploaded / 1024) * 100) / 100 + 'MB 加速' + Math.floor((data.totalP2PDownloaded / 1024) * 100) / 100 + 'MB');
								data.totalP2PDownloaded ? $('.peer').text('P2P加速中') : $('.peer').text('P2P已开启');
							});
						}
					}
				},
                 //danmaku: {
            //id: '优奇视频',
          //api: 'http://139.199.156.243:1207/' }
            });
			player.on('loadstart', function() {
				$('video').attr('playsinline', 'true');
				$('video').attr('x5-playsinline', 'true');
				$('video').attr('webkit-playsinline', 'true');
			});
			player.on('loadeddata', function() {
				youqi.cookie.get(cookie) ? player.seek(youqi.cookie.get(cookie)) : '';
				player.on('timeupdate', function() {
					if(cookie) youqi.cookie.set(cookie, player.video.currentTime, 30);
				});
			});
			player.on('ended', function() {
				if(parent.MacPlayer.PlayLinkNext!=''){
				top.location.href = parent.MacPlayer.PlayLinkNext;
				}
				});
			player.on('error', function() {
				youqi.player.vplayer(auto, urls, jump);
			});
		},
		'vplayer': function(auto, urls, jump) {
			var dp = new DPlayer({
				container: document.getElementById('video'),
				autoplay: auto,
				video: {
					url: urls
				}
			});
			dp.on('loadstart', function() {
				$('video').attr('playsinline', 'true');
				$('video').attr('x5-playsinline', 'true');
				$('video').attr('webkit-playsinline', 'true');
			});
			dp.on('loadeddata', function() {
				youqi.cookie.get(cookie) ? player.seek(youqi.cookie.get(cookie)) : '';
				dp.on('timeupdate', function() {
					if(cookie) youqi.cookie.set(cookie, player.video.currentTime, 30);
				});
			});
			dp.on('ended', function() {
				if(parent.MacPlayer.PlayLinkNext!=''){
				top.location.href = parent.MacPlayer.PlayLinkNext;
				}
				});
		}
	},
	'cookie': {
		'set': function(name, value, days) {
			var exp = new Date();
			exp.setTime(exp.getTime() + days * 24 * 60 * 60 * 1000);
			var arr = document.cookie.match(new RegExp('(^| )' + name + '=([^;]*)(;|$)'));
			document.cookie = name + '=' + escape(value) + ';path=/;expires=' + exp.toUTCString();
		},
		'get': function(name) {
			var arr = document.cookie.match(new RegExp('(^| )' + name + '=([^;]*)(;|$)'));
			if(arr != null) return unescape(arr[2]);
		},
		'put': function(urls) {
			var cookie = urls.replace(/[^a-z]+/ig, '');
			var cookie = cookie.substring(cookie.length - 32);
			return cookie;
		}
	}
};

function ckdata() {
	$('video').attr('playsinline', 'true');
	$('video').attr('x5-playsinline', 'true');
	$('video').attr('webkit-playsinline', 'true');
}

function cktime(time) {
	if(cookie) youqi.cookie.set(cookie, time, 30);
}

function ckended() {
	if(jump) top.location.href = jump;
}