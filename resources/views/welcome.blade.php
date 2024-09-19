<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alexcont</title>
  <!--  Fontawesome && Bootstrap CSS files -->
  <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
  <script src="{{asset('js/all.min.js')}}"></script>
  <!-- Bootstrap -->
   <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
   <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <style>
    *{
      overflow-x:hidden;
    }
    .loginScreen{
    background-image: url({{asset('image/bk2.jpeg')}});
    /* background-image: url({{asset('image/4.jpg')}}); */
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    height: 100vh;
    }
    .loginScreen form{
      /* background-color: #f8f9fa; */
      background-color: rgb(248 249 250 / 90%);
      padding: 30px 50px;
      border-radius: 14px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%,-50%);
      width: 600px;
      z-index: 999;
      box-shadow: 10px 10px 5px 4px;
    }
    .loginScreen form button{
      font-weight: 700;
      font-size: 20px;
      letter-spacing: 2px;
      width: fit-content;
      align-self: center;
      padding: 8px 20px;
    }
    .loginScreen form div label{
      font-weight : 700;
      font-size: 20px;
      letter-spacing: 2px;
    }
    footer{
      position: absolute;
      bottom:8px;
      left: 50%;
      transform: translate(-50%,-50%);
      font-weight: 700;
      font-style: bold;
    }
    .info-toggler{
      position: absolute;
      bottom:8px;
      right: 1%;
      transform: translate(-50%,-50%);
      font-weight: 700;
      cursor: pointer;
    }
    .info-toggler svg{
      font-size:30px;
      /* width: 50px; */
    }
    #toggler{
      display:none;
    }
    .info{
      background: #f8f8ff;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 10px 10px;
    position: absolute;
    bottom: -40px;
    right: -400px;
    transform: translate(-50%, -50%);
    transition : 1s;
  }
  .info .v p{
    margin: 8px 0;
  }
  .info .icons svg{
    font-size: 30px;
    margin: 5px;
  }
  #toggler:checked ~ .info{
    right: -70px;
    }
    .icons a{
      text-decoration: none !important; 
    }
    </style>
</head>
<body>
  
  <div class="loginScreen">
  <div class="opacity">
    <form method="POST" action="{{ route('login.user') }}"  class="container  d-flex flex-column sign-in">
      @csrf
      <div class="mb-3">
        <label for="username" class="form-label color-light">Username</label>
        <input type="text" class="form-control" autocomplete='off' name="username" id="username" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="Password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="Password">
      </div>
      <button type="submit" class="btn mt-3 btn-primary">Login</button>
  @if(Session::has('Fail'))
  <div class="alert alert-danger container m-5" style="text-align: center; width: 75%">
    {{ Session::get('Fail') }}
  </div>
  @endif
  @if(Session::has('status'))
  <div class="alert alert-success container m-5" style="text-align: center; width: 75%">
    {{ Session::get('status') }}
  </div>
  @endif
</div>

</form>
</div>

    <label class='info-toggler' for="toggler">
      <i class="fa-solid fa-circle-info"></i>
    </label>
    <input type="checkbox" id="toggler">
    <div class="info">
      <div class="v">
        <p>V.1.0.0</p>
        <p>Developed by Ashraf Elgendy</p>
        <p>for more info, please contact :</p>
        <p>WhatsApp : 01550115569</p>
      </div>
      <div class="icons">
        <a target='_blank'  href="https://eg.linkedin.com/in/elgendyud">
          <i class="fa-brands fa-linkedin"></i>
        </a>
        <a target='_blank' href="https://wa.me/01550115569">
        <i class="fa-brands fa-whatsapp"></i>
        </a>
      </div>


</div>

<footer>Powered by IT-Team Dekheila</footer>
<!-- Login Script -->
</body>
</html>




