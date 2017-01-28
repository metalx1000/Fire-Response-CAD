<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!--favicon-->
    <?php include("fav.php");?>

    <style>
      .site-heading{
        height:300px;
      }

      .well{
        padding : 0px;
      }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <title class='calladd'>CAD</title>
</head>

<body>
    <?php include("nav.php");?>
    <!-- Page Header -->
<!--
    <header>
        <div class="container site-heading">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Clean Blog</h1>
                        <hr class="small">
                        <span class="subheading">A Clean Blog Theme by Start Bootstrap</span>                    
                    </div>
                </div>
            </div>
        </div>

    </header>
-->
<!--unit info-->
    <br><br>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
          <div class="post-preview">
            <h3 class="post-subtitle">
              <span class="calladd"></span>
            </h3>
          </div>
        </div>
      </div>
    </div>
<!--Notes-->
    <div class="container" id="notesbox">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 alert alert-danger" >
          <h3>Notes:</h3>
          <div id="notes"></div> 
        </div>
      </div>
    </div>


<!--Map1-->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 intro-header site-heading getmap" id="map">
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-preview">
                        <h3 class="post-subtitle" id="comments"></h3>
                        <h3 class="post-title" id="units"></h3>
                    <p class="post-meta" id="date"></p>
                </div>
                <hr>
                <div id="secondsDisplay" class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                  <h1 id="seconds" class="list-inline text-center"></h1>
                  <p class="copyright text-muted list-inline text-center">Seconds Since Dispatch</p>
                  <hr>
                </div>
            </div>
        </div>
    </div>

<!--Map2-->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 intro-header site-heading getmap" id="sat" >
        </div>
      </div>
    </div>

<!--Residents-->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 well" id="residents">
        </div>
      </div>
    </div>

<!--Street View-->
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 intro-header site-heading" id="street">
        </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                          <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-volume-off fa-stack-1x fa-inverse" id="speech"></i>
                          </span>
                        </li>
                        <li>
                          <a href="https://github.com/metalx1000/Fire-Response-CAD" target="_blank">
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                            </span>
                          </a>
                        </li>

                    </ul>
                    <p class="copyright text-muted" id="speechText"></p>
                    <p class="copyright text-muted">Copyright &copy; <a href="http://filmsbykris.com" target="_blank">Kris Occhipinti 2017</a> - <a href="http://www.gnu.org/licenses/gpl-3.0.txt" target="_blank">GPLv3</a></p>
                </div>
            </div>
        </div>

    </footer>

    <?php include("head.php");?>
    <script src="js/incident.js"></script>
    <script>
      function update(){
        $("#notesbox").hide();
        $.getJSON("getcall.php", {unit:unit},function(data){
          refresh(data);
        });
      }
    </script>

</body>

</html>
