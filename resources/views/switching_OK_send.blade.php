<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.83.1">
  <title>switching_OK_send
  </title>

  <link rel="canonical" href="https://getbootstrap.jp/docs/5.0/examples/sign-in/">

  <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css rel="stylesheet">

  <link href="{{ asset('css/switching_OK.css') }}" rel="stylesheet">
  
</head>

<body class="text-center">

  <main class="form-signin">

    <h1 class="h1 mb-3 fw-normal">
      <span1>写真の交換が成功しました！</span1>
    </h1>

    <button style="background-color: #38b6a5;" class="btn" type="submit"
    onclick="location.href='{{ URL('/menu') }}'" target="_blank">
      <span2>メニューに戻る</span2>
    </button>

  </main>
</body>

</html>
