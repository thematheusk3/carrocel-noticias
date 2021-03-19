<?php
header('Content-Type: text/html; charset=utf-8');
require 'OpenGraph.php';

ini_set('allow_url_fopen', 1);
ini_set('allow_url_include', 1);


header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=utf-8");

$FeedRSS = "https://www.google.com.br/alerts/feeds/05782171012611430547/8965232573941978887";
$LeituraFeedRSS = simplexml_load_file("$FeedRSS");

function buscarImagem($linkGoogle) {
    $google = array("https://www.google.com/url?rct=j&sa=t&url=");
    $linkLimpo = str_replace($google, "", $linkGoogle);
    $linkLimpo = strstr($linkLimpo, '&ct', true);

    $graph = OpenGraph::fetch($linkLimpo);

    return $graph->image;
}
?>


<html>
    <head>
        <!-- HTML 4 -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <!-- HTML5 -->
        <meta charset="utf-8"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.css">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css'>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.css">


        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js'></script>
        <script src='./plnzqb.js'></script>
        <script src="./script.js"></script>
        <style>
         
        </style>
    </head>
    <body>


        <section class="black" id="noticia">
            <div class="carousel carousel-slider" >
                
                <div class="carousel-fixed-item">
                    <div class="container">
                       
                    </div>
                </div>



                <?php
                $i = 0;
                foreach ($LeituraFeedRSS->entry as $ItemFeed) {
                    $i++;

                    if ($i > 10) {
                        break;
                    }

                    if ($i % 2 == 1) {
                        echo '<div class="row">';
                    }
                    ?>


                <div class="carousel-item white-text" href="#one!" style="background-size: cover; background-position: center; background-repeat: no-repeat; background-image: url('<?php echo buscarImagem($ItemFeed->link->attributes()->href); ?>');">
                        
                        <div class="" style="padding: 10px; z-index:2; position:fixed;bottom:0;left:0;width:100%; background-color: rgba(0,0,0,.6);" >
                            <h2><?php echo"{$ItemFeed->title}" ?></h2>
                            <p class="white-text"><?php echo"{$ItemFeed->content}"; ?></p>
                        </div>
                    </div>
                    


                    <?php
                    if ($i % 2 == 0) {
                        echo '</div>';
                    }
                }
                ?>





            </div>
        </section>
    </body>
</html>
