<?php

function jsonToKml($path){

    try{
        
        $readJsonFile=file_get_contents($path[1]);

        $arrayJson=json_decode($readJsonFile,TRUE);

        $numberPoint=count($arrayJson);

        $Depart=$arrayJson[0];

        $Arrive=$arrayJson[$numberPoint-1];


        $jsonName= explode("/" , $path[1]);
        $kmlName=explode(".",$jsonName[1]);

       
        $kmlFile="KML/".$kmlName[0].".kml";
        $kml=fopen($kmlFile,'w');
        fwrite($kml,'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL);
        fwrite($kml,'<kml xmlns="http://www.opengis.net/kml/2.2">'.PHP_EOL);
        fwrite($kml,'  <Document>'.PHP_EOL);
        fwrite($kml,'    <name>'.$kmlName[0].'</name>'.PHP_EOL);
        fwrite($kml,'    <Style id="yellowLineGreenPoly">'.PHP_EOL);
        fwrite($kml,'      <LineStyle>'.PHP_EOL);
        fwrite($kml,'        <color>7f00ffff</color>'.PHP_EOL);
        fwrite($kml,'      </LineStyle>'.PHP_EOL);
        fwrite($kml,'      <PolyStyle>'.PHP_EOL);
        fwrite($kml,'        <color>7f00ff00</color>'.PHP_EOL);
        fwrite($kml,'      </PolyStyle>'.PHP_EOL);
        fwrite($kml,'    </Style>'.PHP_EOL);
        fwrite($kml,'    <Placemark>'.PHP_EOL);
        fwrite($kml,'      <name>Départ</name> '.PHP_EOL);
        fwrite($kml,'      <description>Départ.</description> '.PHP_EOL);
        fwrite($kml,'      <Point>'.PHP_EOL);
        fwrite($kml,'        <coordinates>'.PHP_EOL);
        fwrite($kml,'         '.$Depart["lng"].','.$Depart["lat"].',2000'.PHP_EOL);
        fwrite($kml,'        </coordinates>'.PHP_EOL);
        fwrite($kml,'      </Point> '.PHP_EOL);
        fwrite($kml,'    </Placemark>'.PHP_EOL);
        fwrite($kml,'    <Placemark>'.PHP_EOL);
        fwrite($kml,'      <styleUrl>#yellowLineGreenPoly</styleUrl>'.PHP_EOL);
        fwrite($kml,'      <LineString>'.PHP_EOL);
        fwrite($kml,'        <extrude>1</extrude>'.PHP_EOL);
        fwrite($kml,'        <altitudeMode>relativeToGround</altitudeMode>'.PHP_EOL);
        fwrite($kml,'        <coordinates>'.PHP_EOL);

        for($i=1;$i<$numberPoint-1;$i++){

            fwrite($kml,'         '.$arrayJson[$i]["lng"].','.$arrayJson[$i]["lat"].',2000'.PHP_EOL);

        }
        fwrite($kml,'        </coordinates>'.PHP_EOL);
        fwrite($kml,'      </LineString>'.PHP_EOL);
        fwrite($kml,'    </Placemark>'.PHP_EOL);
        fwrite($kml,'    <Placemark>'.PHP_EOL);
        fwrite($kml,'      <name>Arrivée</name> '.PHP_EOL);
        fwrite($kml,'      <description>Arrivée.</description> '.PHP_EOL);
        fwrite($kml,'      <Point>'.PHP_EOL);
        fwrite($kml,'        <coordinates>'.PHP_EOL);
        fwrite($kml,'         '.$Arrive["lng"].','.$Arrive["lat"].',2000'.PHP_EOL);
        fwrite($kml,'        </coordinates>'.PHP_EOL);
        fwrite($kml,'      </Point> '.PHP_EOL);
        fwrite($kml,'    </Placemark>'.PHP_EOL);
        fwrite($kml,'  </Document>'.PHP_EOL);
        fwrite($kml,'</kml>'.PHP_EOL);
        
   



    }catch(Exception){
       echo "An unexpected error occurred\n";

    }

    



    
}
 









jsonToKml($argv);
