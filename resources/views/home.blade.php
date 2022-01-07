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



  <!-- CSS -->
  <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css rel="stylesheet">


  <!-- Custom styles for this template -->
  <link href="signin.css" rel="stylesheet">

</head>

<body class="text-center">

  <main class="form-Login">

    <h1 class="h1 mb-3 fw-normal">Welcome to <span1>DataLink</span1>
    </h1>
    <br>
    <img class="mb-4" src="img.png" alt="" width="220" height="113">
    <h1 class="h3 mb-3 fw-normal">Please Log in</h1>

    <form action="" method="get">
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingText" placeholder="Text">
        <label for="floatingText">User ID</label>
      </div>
      <br>
      <button style="background-color: #38b6a5;" class="w-100 btn btn-lg" type="submit" button herf="hogehoge.html"
        onclick="return Click()">
        <span2>Log in</span2>
      </button>
      <p class="mt-5 mb-3 text-muted">&copy; 2021</p>

      
      <script language="javascript" type="text/javascript">
        const userID = document.getElementById("floatingText")
        const value = userID.value

        function Click() {
          if (value == 123) {
            return true;
          }
          else {
            alert('ユーザーIDが違います');
            return false;
          }
        }
      </script>
    </form>

  </main>


</body>

</html>
