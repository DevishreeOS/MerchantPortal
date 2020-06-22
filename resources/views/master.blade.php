<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="js/zoom-image.js"></script>
<script src="js/main.js"></script>

<style>
body {
  font-family: "Lato", sans-serif;
  background-color:Gainsboro;
}

.sidenav {
  width: 200px;
  position:fixed;
  height:auto;
  z-index: 1;
  left: 0;
  background-color: LavenderBlush;
  overflow-x: hidden;
  padding-top: 20px;
  margin-top:50px;
  overflow-y: scroll;
  top: 0;
  bottom: 0;


}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 15px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: black;
}

.main {
  margin-left: 220px; /* Same as the width of the sidenav */
  font-size: 14px; /* Increased text to enable scrolling */
  padding: 0px 10px;
  margin-top:40px;
}
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.container-fluid{
  background-color:Lavender;
}
.subMenu{
  height:50px;
}
.breadcrumbs{
  height:20px;
}
</style>
@yield('stylecontent')
@yield('scriptcontent')
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Peerbrains</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="{{url('select')}}">Home</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">ContactUs</a></li>
      <li><a href="#">SignIn</a></li>
</ul>
  </div>
</nav>
<div class="subMenu">
@yield('subMenu')
</div>
<div class="breadcrumbs">

@yield('breadcrumbs')
</div>
<div class="sidenav">
@yield('sidemenu')
</div>
<div class="main">
@yield('maincontent')
<footer>
@yield('footer')
</footer>
</div>
</body>
</html> 
