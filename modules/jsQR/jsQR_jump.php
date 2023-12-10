<?php
  /*
  jsQR_jump.php　仕様注意点
  ・必ずhttps://で接続すること　http://接続ではQRが認識しません
  ・jsQR.jsも必ずhttps経由で接続すること
  */

  if(htmlspecialchars($_GET['cameraposition']) == 'rear'){
    $throwWord = 'rear';
    $cameraPosition = 'front';
  }else{
    $throwWord = 'front';
    $cameraPosition = 'rear';  
  }

  $urlheader = 'https://'.$_SERVER['HTTP_HOST'];//QRコードに当てるテキスト

?>
<html> 
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="shortcut icon" href="../../icon.png">
  <link rel="stylesheet" href="../../css/mainstyle/style.css">
  <title>QRコード読み取り</title>
</head>
<body>
  <?php include('../../root/header_footer/header_nk.php'); ?><!--hedder-->
 <div id="pagemain"> 
  <div style="text-align:center;margin-top:20px;margin-bottom:70px;">
    <h2>現品票のQRコードをカメラに読み込ませて下さい。<br>
          読み込んだQRコードのURLへジャンプします</h2>
          <input type="button" value="カメラ切替" onclick="location.href='jsQR_jump.php?cameraposition=<?php echo $throwWord;?>';">
    <div id="result">
      <video></video>
    </div>
  </div>    

  <audio id="audioElement" src="../../modules/camera/shutter.mp3"></audio>

  <button id="audioPlay"></button>

</body>
</html>
<script src="jsQR.js"></script>
<script>
    
  <?php
    switch($cameraPosition){
      case 'front':
        //リアカメラを使用する
        echo 'const constraints = { audio: false, video: {facingMode: "user", width: 500, height: 500 }};';
      break;
      case 'rear':
        //フロントカメラを使用する
        echo 'const constraints = { audio: false, video: {facingMode: "environment", width: 500, height: 500 }};';
      break;
    }
  ?>

  
  navigator.mediaDevices.getUserMedia(constraints).then((stream) => {
    const video = document.querySelector('video');
    video.srcObject = stream;

    video.play();

    const w = constraints.video.width, h = constraints.video.height;
    const canvas = document.createElement('canvas');
    canvas.width = w;
    canvas.height = h;
    const context = canvas.getContext('2d');

    const timer = setInterval(() => {
      context.drawImage(video, 0, 0, w, h);
      const imageData = context.getImageData(0, 0, w, h);
      const code = jsQR(imageData.data, imageData.width, imageData.height);
      if (code) {

        clearInterval(timer);
        //document.querySelector('#result').textContent = code.data;

        var url = code.data;
        //小さいほうのURLを読み込ませた時
        if(url.length < 9){
          url = "<?=$urlheader?>/nfsys/sozai/work/entry/work_entry?makeno=" + url;
        }

        location.href = url;

      }
    }, 500);
  }).catch((e) => {
    console.log('load error', e);
  });

/*シャッター音を鳴らす*/
document.getElementById("audioPlay").onclick = function(){
  document.getElementById("audioElement").play();
};




</script>