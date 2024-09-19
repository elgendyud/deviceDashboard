<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alexcont</title>
  <link rel="stylesheet" href="{{ asset('css/boxicons.min.css') }}">
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <style>
    * {
      font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
      font-size: large;
    }

    form.sign-in {
      width: 30%;
    }

    form.sign-in button[type="submit"] {
      width: 100px;
      align-self: center;
    }

    .cont-create {
      width: fit-content;
      text-align: center;
    }

    .disable-btn {
      pointer-events: none;
      cursor: not-allowed;
      color: gray;
      opacity: 0.6;
    }
    footer {
      bottom:5px;
      text-align: center;
      margin-top: 10px;
      width: 100%;
      color: white;
    }
    footer p {
      margin-right: -18px;
      padding: 10px 30px;
      background-color: #4723d9;
      margin-bottom: 0;
      display: inline;
      border-top-left-radius : 20px;
      border-top-right-radius : 20px;
    }

    .logo-img {
      width: 120px;
    }

    .loginScreen {
      height: 100vh;
      background-image: url({{asset('bk.jpg')}});
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      padding: inherit;
    }

    .loginScreen form {
      background-color: #f8f9fa;
      padding: 30px;
      border-radius: 14px;
      opacity: 0.8
    }

    .dashboard-view {
      display: flex;
      align-items: flex-start;
      justify-content: space-around;
      margin: 10px 0;
      width: 100%;
    }

    .dashboard-view .left {
      padding-top: 40px;
    }

  .dashboard-view .left , 
    .dashboard-view .right{
      width: 45%;
      position: relative;
    }

    .dashboard-view .right::after {
      content: '';
      position: absolute;
      left: -100px;
      top: 0;
      background-color: #0d6efd;
      height: 100%;
      width: 1px;

    }

    .credit {
      width: 40%;
    }

    .right-credit {
      margin-left: 250px;
    }


    select::-ms-expand {
      display: none;
    }
  </style>

</head>

<body id="body-pd" class="bg-light">
  <header class="header" id="header">
    <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    <img class="logo-img" src="{{ asset('image/loading.png') }}" alt="Logo Image">
  </header>
  <hr>
  <div class="l-navbar" id="nav-bar">
    <nav class="nav">
      <div> <a class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span
            class="nav_logo-name">Alexcont</span> </a>
        <div class="nav_list"> <a href="{{ route('dashboard') }}" class="nav_link  "> <i
              class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a>
          @auth
        @if (Auth::user()->username == 'admin')
      <a href="{{ route('index.user') }}" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span
        class="nav_name">Users</span> </a>
    @endif
      @endauth
          @auth
        <a href="{{ route('index.device') }}" class="nav_link"> <i class='bx bx-devices nav_icon'></i> <span
          class="nav_name">Devices</span> </a>
        <a href="{{ route('index.maintenance') }}" class="nav_link"> <i class='bx bx-cog nav_icon'></i> <span
          class="nav_name">Maintenances</span> </a>
        <a href="{{ route('credits.index') }}" class="nav_link"> <i class='bx bx-money nav_icon'></i> <span
          class="nav_name">Finance</span> </a>
        <a href="{{ route('change.user') }}" class="nav_link"> <i class='bx bx-key nav_icon'></i> <span
          class="nav_name">Change Password</span> </a>

      </div>
      <form id="logout-form" action="{{ route('logout.user') }}" method="POST" style="display: none;">
        @csrf
      </form>
      <a href="{{ route('logout.user') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav_link">
        <i class='bx bx-log-out nav_icon'></i>
        <span class="nav_name">Logout</span> </a>
    @endauth

    </nav>
  </div>
  <!--Container Main start-->
  <!-- <div class="height-100 app-body bg-light"> -->
  <div class="height-100 bg-light">
    <!-- <h4>Main Components</h4> -->
    @yield('content')
  </div>


  <!-- This webapp is developed by Ashraf Elgendy -->
  <!-- For Contact ==> Whatsapp : 01550115569 -->
  <!-- For Contact ==> Linkedin : linkedin.com/in/elgendyud -->








  <script>
    // Logout after a while of unactivity
    let timeout;
    const inactivityTimeout = 3000;

    function startInactivitTimer(){
      clearTimeout(timeout);
      timeout = setTimeout(() => {
        // window.location.href = '/logout';
      }, inactivityTimeout);
    }
    function resetInactivityTimer(){
      startInactivitTimer();
    }
    function setEventListeners(){
      document.addEventListener('mousemove', resetInactivityTimer);
      document.addEventListener('keydown', resetInactivityTimer);
      document.addEventListener('click', resetInactivityTimer);
      document.addEventListener('scroll', resetInactivityTimer);
    }
    window.onload = function(){
      setEventListeners();
      startInactivitTimer();
    }
    // logout section end





    document.addEventListener("DOMContentLoaded", function (event) {

      const showNavbar = (toggleId, navId, bodyId, headerId) => {
        const toggle = document.getElementById(toggleId),
          nav = document.getElementById(navId),
          bodypd = document.getElementById(bodyId),
          headerpd = document.getElementById(headerId)

        // Validate that all variables exist
        if (toggle && nav && bodypd && headerpd) {
          toggle.addEventListener('click', () => {
            // show navbar
            nav.classList.toggle('show')
            // change icon
            toggle.classList.toggle('bx-x')
            // add padding to body
            bodypd.classList.toggle('body-pd')
            // add padding to header
            headerpd.classList.toggle('body-pd')
          })
        }
      }

      showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

      // Add active class to current nav link
      const currentPage = window.location.href;

      // Get all nav links
      const linkColor = document.querySelectorAll('.nav_link');

      // Loop through each nav link
      linkColor.forEach((link) => {
        const linkHref = link.getAttribute('href');
        const linkText = link.textContent.trim();

        // Check if the current page matches the link href
        if (linkHref === currentPage) {
          // Add active class to the current link
          link.classList.add('active');
        }
      });

    });
  </script>







  <!-- <script src="{{ asset('js/jquery.min.js') }}"></script> -->
  <script src="{{ asset('js/bootstrap.min.js') }}"
    integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- <script src="{{ asset('js/chart.js') }}"></script> -->


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>