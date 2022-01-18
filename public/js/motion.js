const jquery = require("jquery");

var direction = "up";
var dir = document.getElementById('direction');
var lat = 0, lon = 0;
var flg; //グータッチ:0 , ハイタッチ:1
getGeo();
function getFakeDate(){
    flg=0;
    timeStamp = Date.now();
    var json = {
        "flg":flg,
        "lat":lat,
        "lon":lon,
        "timeStamp":timeStamp
    };
    
    json = JSON.stringify(json);
    jQuery.ajax({
        //POST通信
        type: "post",
        //ここでデータの送信先URLを指定します。
        url: "/get_motion",
        dataType: "json",
        processData: false,
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
    // return makeFlickrCall( { data: json });
    // console.log(json);
    // alert(json);
}
function test(){
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
        // han
        console.log(typeof DeviceOrientationEvent)
    }
}
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
            timeStamp = Date.now();
            var json = {
                "flg":flg,
                "lat":lat,
                "lon":lon,
                "timeStamp":timeStamp
            };
            json = JSON.stringify(json);
            console.log(json);
            alert(json);
        }else if(direction=="front" && (z_acc>20 || z_acc<-20)){
            motion.innerHTML = "ハイタッチ";
            flg = 1;
            timeStamp = Date.now();
            var json = {
                "flg":flg,
                "lat":lat,
                "lon":lon,
                "timeStamp":timeStamp
            };
            json = JSON.stringify(json);
            return json;
            // console.log(json);
            // alert(json);
        }
        x.innerHTML = x_acc.toFixed(1);
        y.innerHTML = y_acc.toFixed(1);
        z.innerHTML = z_acc.toFixed(1);

    }, false);
} else {
    document.getElementById('acc-error-message').innerHTML = '加速度センサーのデータを取得できません';
}

$("#bt2").click(function () {
    $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });
    $.ajax({
      //POST通信
      type: "post",
      //ここでデータの送信先URLを指定します。
      url: "/get_motion",
      dataType: "json",
      data: {
        uid: 100,
        subject: "テストタイトル",
        from: "テストfrom",
        body: "テストbody",
      },
  
    })
      //通信が成功したとき
      .then((res) => {
        console.log(res);
      })
      //通信が失敗したとき
      .fail((error) => {
        console.log(error.statusText);
      });
  });


