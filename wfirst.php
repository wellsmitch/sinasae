<?php
error_reporting(E_ALL || ~E_NOTICE);
header("Content-type:text/html; charset=utf-8");
require_once "sdk/jssdk.php";
$jssdk = new JSSDK("wxf743a2bfc4db8a08", "2bfe44d8e9507bf46dc8759e705ea256");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
    <title>无标题文档</title>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script>
        wx.config({
            debug: true,// 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId: '<?php echo $signPackage["appId"];?>',
            timestamp: <?php echo $signPackage["timestamp"];?>,
            nonceStr: '<?php echo $signPackage["nonceStr"];?>',
            signature: '<?php echo $signPackage["signature"];?>',
            jsApiList: [
                'checkJsApi',
                'onMenuShareTimeline',
                'onMenuShareAppMessage',
                'onMenuShareQQ',
                'onMenuShareWeibo',
                'hideMenuItems',
                'showMenuItems',
                'hideAllNonBaseMenuItem',
                'showAllNonBaseMenuItem',
                'translateVoice',
                'startRecord',
                'stopRecord',
                'onRecordEnd',
                'playVoice',
                'pauseVoice',
                'stopVoice',
                'uploadVoice',
                'downloadVoice',
                'chooseImage',
                'previewImage',
                'uploadImage',
                'downloadImage',
                'getNetworkType',
                'openLocation',
                'getLocation',
                'hideOptionMenu',
                'showOptionMenu',
                'closeWindow',
                'scanQRCode',
                'chooseWXPay',
                'openProductSpecificView',
                'addCard',
                'chooseCard',
                'openCard'
            ] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });


    </script>
</head>

<body>
<button id="getphone">拍照</button>
<button id="voiceStart">开始录音</button>
<button id="voiceStop">停止录音</button>
<button id="voiceOpen">播放录音</button>
<button id="net">网络状态</button>
<button id="scan">扫一扫</button>
<script>
    wx.ready(function () {
        //拍照
        var btn = document.getElementById("getphone");
        btn.onclick = function () {
            wx.chooseImage({
                success: function (res) {
                    var localIds = res.localIds;
                    // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                }
            })
        };
        //开始录音
        var localId;
        voiceStart.onclick = function () {
            wx.startRecord();
        };
        //停止录音
        voiceStop.onclick = function () {
            wx.stopRecord({
                success: function (res) {
                    localId = res.localId;
                }
            })
        };
        // 播放录音
        voiceOpen.onclick = function () {
            wx.playVoice({
                localId: localId // 需要播放的音频的本地ID，由stopRecord接口获得
            });
        };
        net.onclick = function () {
            wx.getNetworkType({
                success: function (res) {
                    var networkType = res.networkType; // 返回网络类型2g，3g，4g，wifi
                    alert(networkType)
                }
            })
        };
        scan.onclick = function () {
            wx.scanQRCode({
                needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                success: function (res) {
                    var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
                    alert(result)
                }
            });
        }
    })
</script>
</body>
</html>
