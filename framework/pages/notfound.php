<!DOCTYPE HTML>
<?php header("HTTP/1.0 404 Not Found"); ?>
<html>
    <head>
        <meta charset="utf-8">
        <title>404 -El recurso no existe </title>
        <style>

            @import url("//fonts.googleapis.com/css?family=Lato:400,700,400italic");

            *{
                maring: 0;
                padding: 0;
            }
            body{
                font-family: "Lato","Helvetica Neue",Helvetica,Arial,sans-serif;
                background: #2c3e50;
                color: #ffffff;
            }
            a:link{
                color: #ffffff;
                text-decoration: none;
            }
            a:active{
                color: #18bc9c;
                text-decoration: none;
            }
            a:hover{
                color: #18bc9c;
                text-decoration: none;
            }
            a:visited{
                color: #ffffff;
                text-decoration: none;                
            }

            .bree-font{
                font-family: "Lato","Helvetica Neue",Helvetica,Arial,sans-serif;
            }

            #content{
                margin: 0 auto;
                width: 960px;
            }

            #logo {
                margin: 1em;
                float: left;
                display: bloack;
            }

            #main-body{
                text-align: center;
            }

            .enormous-font{
                font-size: 10em;
                margin-bottom: 0em;
            }
            .big-font{
                font-size: 2em;
            }
            hr{
                width: 25%;
                height: 1px;
                background: #1f3759;
                border: 0px;
            }



        </style>
    </head>
    <body>
        <div id="content">
            <div id="main-body">
                <p class="enormous-font bree-font"> 404 </p>
                <p class="big-font"> Oops... parece que este recurso no existe. </p>
                <hr>
                <p class="big-font"> <a href="http://localhost/easyinvoice">Regresar a la pagina principal</a></p>
            </div>
        </div>
    </body>
</html>
<?php die(); ?>