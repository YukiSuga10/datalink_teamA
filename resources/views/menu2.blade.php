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
                <input type="file" name="imgpath">
                <input type="submit" value="アップロードする">
                <img id="preview" style="height: 50%; width: 100%;">
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
        $('#myImage').on('change', function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#preview").attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    </script>

</body>

</html>
