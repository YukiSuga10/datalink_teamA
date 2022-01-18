<!doctype html>
<html lang="ja">

<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.83.1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>motionwaiting</title>

  <link rel="canonical" href="https://getbootstrap.jp/docs/5.0/examples/sign-in/">

  <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css rel="stylesheet">

  <link href="{{ asset('css/motionOKandNO.css') }}" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body class="text-center">

  <main class="form-signin">
    <input type="button" onclick="getPermission();" value="モーション開始">
    <h1 class="h1 mb-3 fw-normal">        
      <span1>モーションを入力してください！</span1>
    </h1>

    <button style="background-color: #38b6a5;" class="btn" type="submit"
      onclick="location.href='{{ URL('/menu') }}'"   target="_blank">
      <span2>戻る</span2>
    </button>

  </main>
</body>
<script>
    //ジャイロセンサーと加速度センサーの権限をもらう
    function getPermission(){
        if (typeof DeviceOrientationEvent.requestPermission === 'function') {
            DeviceOrientationEvent.requestPermission()
                .then(permissionState => {
                    if (permissionState === 'granted') {
                        // handle data
                    } else {
                        // handle denied
                    }
                })
                .catch((err) => {
                    console.log(err)
                });
        } else {
            console.log(typeof DeviceOrientationEvent)
        }
    }
    window.onload = function (){
      var direction = "up";
      var dir = document.getElementById('direction');
      var lat = 0, lon = 0;
      var flg; //グータッチ:0 , ハイタッチ:1
      getGeo();
      
      //位置情報の取得　経緯度
      function getGeo(){
          if(navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(
                  function (position) {
                      //返却
                      lat = position.coords.latitude;
                      lon = position.coords.longitude;
                  },
                  function (e) {
                      throw(e.message);
                  }
              )
          }
      }

      if (window.DeviceOrientationEvent) {
          window.addEventListener('deviceorientation', function (event) {
              var a = document.getElementById('alpha'),
                  b = document.getElementById('beta'),
                  g = document.getElementById('gamma'),
                  alpha = event.alpha,
                  beta = event.beta,
                  gamma = event.gamma;

              a.innerHTML = Math.round(alpha);
              b.innerHTML = Math.round(beta);
              g.innerHTML = Math.round(gamma);

              if(Math.abs(Math.round(beta)) > 135){
                  direction = "down";
                  getGeo();
              }else if(Math.abs(Math.round(beta)) > 45){
                  direction = "front";
                  getGeo();
              }else{
                  direction = "up";
              }
              dir.innerHTML = direction;
          }, false);
      } else {
          document.getElementById('gyro-error-message').innerHTML = 'ジャイロセンサーのデータを取得できません';
      }
      if (window.DeviceMotionEvent) {
          window.addEventListener( "devicemotion", function( event ){
              var motion = document.getElementById('motion'),
                  x = document.getElementById('x-acc'),
                  y = document.getElementById('y-acc'),
                  z = document.getElementById('z-acc'),
                  x_acc = event.accelerationIncludingGravity.x,
                  y_acc = event.accelerationIncludingGravity.y,
                  z_acc = event.accelerationIncludingGravity.z;

              if(direction=="down" && (x_acc>20 || x_acc<-20)){
                  motion.innerHTML = "グータッチ";
                  flg=0;
                  timeStamp = new Date();
                  var year  = timeStamp.getFullYear();
                  var month = timeStamp.getMonth() + 1;
                  var day   = timeStamp.getDate();
                  var hour  = ( timeStamp.getHours()   < 10 ) ? '0' + timeStamp.getHours()   :     timeStamp.getHours();
                  var min   = ( timeStamp.getMinutes() < 10 ) ? '0' + timeStamp.getMinutes() :     timeStamp.getMinutes();
                  var sec   = ( timeStamp.getSeconds() < 10 ) ? '0' + timeStamp.getSeconds() :     timeStamp.getSeconds();
                  timeStamp = year + '-' + month + '-' + day + ' ' + hour + ':' + min + ':' + sec;
                  var json = {
                      "flg":flg,
                      "lat":lat,
                      "lon":lon,
                      "timeStamp":timeStamp
                  };
                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
                  jQuery.ajax({
                      //POST通信
                      type: "post",
                      //ここでデータの送信先URLを指定します。
                      url: "/get_motion",
                      dataType: "json",
                      data: json,
                    })
                      //通信が成功したとき
                      .then((res) => {
                          console.log(res);
                      })
                      //通信が失敗したとき
                      .fail((error) => {
                          console.log(error.statusText);
                      });
              }else if(direction=="front" && (z_acc>20 || z_acc<-20)){
                  motion.innerHTML = "ハイタッチ";
                  flg = 1;
                  timeStamp = new Date();
                  var year  = timeStamp.getFullYear();
                  var month = timeStamp.getMonth() + 1;
                  var day   = timeStamp.getDate();
                  var hour  = ( timeStamp.getHours()   < 10 ) ? '0' + timeStamp.getHours()   :     timeStamp.getHours();
                  var min   = ( timeStamp.getMinutes() < 10 ) ? '0' + timeStamp.getMinutes() :     timeStamp.getMinutes();
                  var sec   = ( timeStamp.getSeconds() < 10 ) ? '0' + timeStamp.getSeconds() :     timeStamp.getSeconds();
                  timeStamp = year + '-' + month + '-' + day + ' ' + hour + ':' + min + ':' + sec;
                  var json = {
                      "flg":flg,
                      "lat":lat,
                      "lon":lon,
                      "timeStamp":timeStamp
                  };
                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
                  jQuery.ajax({
                      //POST通信
                      type: "post",
                      //ここでデータの送信先URLを指定します。
                      url: "/get_motion",
                      dataType: "json",
                      data: json,
                    })
                      //通信が成功したとき
                      .then((res) => {
                          console.log(res);
                      })
                      //通信が失敗したとき
                      .fail((error) => {
                          console.log(error.statusText);
                      });
              }
              x.innerHTML = x_acc.toFixed(1);
              y.innerHTML = y_acc.toFixed(1);
              z.innerHTML = z_acc.toFixed(1);

          }, false);
      } else {
          document.getElementById('acc-error-message').innerHTML = '加速度センサーのデータを取得できません';
      }
    }

   
}
</script>

</html>
