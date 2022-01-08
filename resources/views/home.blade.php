<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.83.1">
  <title>DataLink</title>

  <link rel="canonical" href="https://getbootstrap.jp/docs/5.0/examples/sign-in/">

  <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css rel="stylesheet">
  <link href="{{ asset('css/login.css') }}" rel="stylesheet">

</head>

<body class="text-center">

  <main class="form-Login">

    <h1 class="h1 mb-3 fw-normal">Welcome to <span1>DataLink</span1>
    </h1>
    <br>
    <img class="mb-4" src="images/img.png" alt="" width="220" height="113">
    <h1 class="h3 mb-3 fw-normal">Please Log in</h1>

    <form action="/signin" method="post">
      @csrf
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingText" placeholder="Text">
        <label for="floatingText">User ID</label>
      </div>
      <br>
      <button style="background-color: #38b6a5;" class="w-100 btn btn-lg" type="submit" 
        onclick="location.href='{{ URL('/signin') }}'">
        <span2>Log in</span2>
      </button>
      <p class="mt-5 mb-3 text-muted">&copy; 2021</p>


  
    </form>

  </main>


</body>

</html>
