<?php
$data = file_get_contents("trajectories/traj1.json"); // par défaut on affiche la trajectoire traj1

//on affiche la trajectoire demandée par le client
if (isset($_POST["traj1"])) {
    $data = file_get_contents("trajectories/traj1.json");
}
if (isset($_POST["traj2"])) {
    $data = file_get_contents("trajectories/traj2.json");
}
if (isset($_POST["traj3"])) {
    $data = file_get_contents("trajectories/traj3.json");
}
if (isset($_POST["traj4"])) {
    $data = file_get_contents("trajectories/traj4.json");
}
if (isset($_POST["traj5"])) {
    $data = file_get_contents("trajectories/traj5.json");
}


$data = json_decode($data, true);  // Récupère une chaîne encodée JSON et la convertit en une variable PHP.
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="Sysnav" content="trajectories">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <title>Load Maps API dynamically</title>

    <style>
        html,
        body,
        #maps {
            height: 700px;

        }
    </style>

    <script>
        var map;


        const route = [ //cette variable contient  les points de notre trajectoire

            <?php

            $length = count($data);
            for ($i = 0; $i <= $length - 1; $i++) {

                $location = $data[$i];
                $lat = $location["lat"];
                $lng = $location["lng"];
                $confiance = $location["confiance"];  //remplir la  variable route par php
                echo <<<FIN
                {
                    lat: $lat,
                    lng: $lng,
                    confiance:$confiance                  

                },

                
                FIN;
            }
            ?>

        ];


        var length = route.length; // le nombre de points dans notre trajectoire





        function myMap() {

            var c = new google.maps.LatLng(49.091942, 1.476728); //le centre de la vision
            var mapProp = {
                zoom: 13,
                center: c,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById('maps'), mapProp);
            for (var i = 0; i < length - 1; i++) {
                var polyline = new google.maps.Polyline({ //pour relier les différents points de la trajectoire
                    path: [route[i], route[i + 1]],
                    geodesic: true,
                    strokeColor: `hsla(${route[i].confiance},${50}%,${50}%)`, //pour colorer le trait (i,i+1) par la couleur qui correspond à i.confiance
                    strokeOpacity: 0.6,
                    strokeWeight: 5,

                });
                var circle = new google.maps.Circle({ // pour faire des disques noires sur les points de la trajectoire
                    map: map,
                    center: route[i],
                    radius: 0.25, 
                    fillColor: '#000000',
                    strokeColor: '#000000',
                    strokeWeight: 2,
                    fillOpacity: 1,
                });
                polyline.setMap(map);
            }







            var marker0 = new google.maps.Marker({ //marquer le point de départ
                position: route[0],
                map: map,
                title: "Départ"
            });

            var marker1 = new google.maps.Marker({ //marquer le point d'arrivée
                position: route[length - 1],
                map: map,
                title: "Arrivée"
            });

            const infowindow0 = new google.maps.InfoWindow({ //marquer le point de départ par une bulle carrée
                map: map,
                position: route[0],
                content: "<p>Départ" + "</p>",
            });
            const infowindow1 = new google.maps.InfoWindow({ //marquer le point d'arrivée par une bulle carrée
                map: map,
                position: route[length - 1],
                content: "<p>Arrivée" + "</p>",
            });







        }
    </script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="col-md-2 bleu">
                <form class="form-inline my-2 my-lg-0" action="#" method="post">

                    <button class="btn btn-outline-success my-2 my-sm-0" name="traj1" type="submit">traj1</button>
                </form>
            </div>
            <div class="col-md-2 bleu">
                <form class="form-inline my-2 my-lg-0" action="#" method="post">

                    <button class="btn btn-outline-success my-2 my-sm-0" name="traj2" type="submit">traj2</button>
                </form>
            </div>
            <div class="col-md-2 bleu" action="#">
                <form class="form-inline my-2 my-lg-0" method="post">

                    <button class="btn btn-outline-success my-2 my-sm-0" name="traj3" type="submit">traj3</button>
                </form>
            </div>
            <div class="col-md-2 bleu" action="#">
                <form class="form-inline my-2 my-lg-0" method="post">

                    <button class="btn btn-outline-success my-2 my-sm-0" name="traj4" type="submit">traj4</button>
                </form>
            </div>
            <div class="col-md-2 bleu" action="#">
                <form class="form-inline my-2 my-lg-0" method="post">

                    <button class="btn btn-outline-success my-2 my-sm-0" name="traj5" type="submit">traj5</button>
                </form>
            </div>

        </div>
    </nav>

    <div id="maps"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=APIKey&callback=myMap"></script> // veuillez mettre votre APIKey

</html>
