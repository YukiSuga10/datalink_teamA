<!DOCTYPE html>
<html lang="ja"> 

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Camera ON</title>

  <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css rel="stylesheet">

  <link href="{{ asset('css/cameraON.css') }}"rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body class="text-center">

  <main class="camera">

    <div id="app" v-cloak>

      <!-- ① スマホのカメラを起動する部分 -->
      <div class="p-3" v-if="isStatusReady">
        <label class="btn">
            <form action="/upload_image" enctype="multipart/form-data" method="post">
                @csrf
                <div id="result"></div>
                <img id="preview" style="height: 10%; width: 20%;">
                <p>アップロードするファイルを選択して下さい。</p>
                <p><input id="file" type="file"><input type="submit" value="アップロードする"></p>
                
            </form>
        </label>
        
      </div>

      <!-- ② 写真撮影後に表示する部分 -->
      

    </div>
  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.12/vue.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.9/cropper.min.js"></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/javascript-canvas-to-blob/3.28.0/js/canvas-to-blob.min.js"></script>
    <script>
        var file = document.getElementById('file');
        var result = document.getElementById('result');

        function loadLocalImage(e) {
            // ファイル情報を取得
            var fileData = e.target.files[0];

            // 画像ファイル以外は処理を止める
            if (!fileData.type.match('image.*')) {
                alert('画像を選択してください');
                return;
            }

            // FileReaderオブジェクトを使ってファイル読み込み
            var reader = new FileReader();
            // ファイル読み込みに成功したときの処理
            reader.onload = function () {
                // ブラウザ上に画像を表示する
                var img = document.createElement('img');
                var base64_string = reader.result;
                img.src = base64_string;
                result.appendChild(img);
                var input_hidden = document.createElement('input');
                input_hidden.type = 'hidden';
                input_hidden.name = 'imageBase64';
                input_hidden.value = base64_string;
                // input_hidden.value = base64_string.replace('data:image/jpeg;base64,', ''); // こっちでもいける。
                result.appendChild(input_hidden);
            }
            // ファイル読み込みを実行
            reader.readAsDataURL(fileData);
        }

        // ファイルが指定された時にloadLocalImage()を実行
        file.addEventListener('change', loadLocalImage, false);
    </script>

</body>

</html>
