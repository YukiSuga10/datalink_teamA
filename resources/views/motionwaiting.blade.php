<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.83.1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>motionOK</title>

  <link rel="canonical" href="https://getbootstrap.jp/docs/5.0/examples/sign-in/">

  <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css rel="stylesheet">

  <link href="motionOKandNO.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>

<body class="text-center">

  <main class="form-signin">

    <h1 class="h1 mb-3 fw-normal">
      <span1>モーションを入力してください！</span1>
    </h1>

    <button style="background-color: #38b6a5;" class="btn" type="submit"
      onclick="document.location='camera.html';return false;" target="_blank">
      <span2>戻る</span2>
    </button>

  </main>
</body>
<script>
    window.onload = function(){
    var lat = 0, lon = 0;
    flg=0;
    timeStamp = new Date();
    var year  = timeStamp.getFullYear();
    var month = timeStamp.getMonth() + 1;
    var day   = timeStamp.getDate();
    var hour  = ( timeStamp.getHours()   < 10 ) ? '0' + timeStamp.getHours()   : timeStamp.getHours();
    var min   = ( timeStamp.getMinutes() < 10 ) ? '0' + timeStamp.getMinutes() : timeStamp.getMinutes();
    var sec   = ( timeStamp.getSeconds() < 10 ) ? '0' + timeStamp.getSeconds() : timeStamp.getSeconds();
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
    // return makeFlickrCall( { data: json });
    // console.log(json);
    // alert(json);
}
</script>

</html>
