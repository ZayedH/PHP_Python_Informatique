import json
import sys



def jsonToKml(jsonFile):
  
 try:
   fjson=open(jsonFile[1]) 

   jsonfile=json.load(fjson)

   fjson.close()

   numberPoint=len(jsonfile)

   Depart=jsonfile[0]

   Arrive=jsonfile[numberPoint-1]

 

   jsonName=jsonFile[1].split("/")
   nameKml=jsonName[1].split(".")
 
   kmlfile=open(f'KML/{nameKml[0]}.kml', 'w') 


   kmlfile.write('<?xml version="1.0" encoding="UTF-8"?>\n')
   kmlfile.write('<kml xmlns="http://www.opengis.net/kml/2.2">\n')
   kmlfile.write('  <Document>\n')
   kmlfile.write(f'    <name>{nameKml[0]}</name>\n')
   kmlfile.write('    <Style id="yellowLineGreenPoly">\n')
   kmlfile.write('      <LineStyle>\n')
   kmlfile.write('        <color>7f00ffff</color>\n')
   kmlfile.write('      </LineStyle>\n')
   kmlfile.write('      <PolyStyle>\n')
   kmlfile.write('        <color>7f00ff00</color>\n')
   kmlfile.write('      </PolyStyle>\n')
   kmlfile.write('    </Style>\n')
   kmlfile.write('    <Placemark>\n')
   kmlfile.write('      <name>Départ</name> \n')
   kmlfile.write('      <description>Départ.</description> \n')
   kmlfile.write('      <Point>\n')
   kmlfile.write('        <coordinates>\n')
   kmlfile.write(f'         {Depart["lng"]},{Depart["lat"]},2000\n')                  # 2000 représente l'altitude du point. C'est pour la lisibilité de la trajectoire.
   kmlfile.write('        </coordinates>\n')
   kmlfile.write('      </Point> \n')
   kmlfile.write('    </Placemark>\n')
   kmlfile.write('    <Placemark>\n')
   kmlfile.write('      <styleUrl>#yellowLineGreenPoly</styleUrl>\n')
   kmlfile.write('      <LineString>\n')
   kmlfile.write('        <extrude>1</extrude>\n')
   kmlfile.write('        <altitudeMode>relativeToGround</altitudeMode>\n')
   kmlfile.write('        <coordinates>\n')

   for i in range(1,numberPoint-1):
      kmlfile.write(f'         {jsonfile[i]["lng"]},{jsonfile[i]["lat"]},2000\n')   # Les différents points de la trajectoire 



   kmlfile.write('        </coordinates>\n')
   kmlfile.write('      </LineString>\n')
   kmlfile.write('    </Placemark>\n')
   kmlfile.write('    <Placemark>\n')
   kmlfile.write('      <name>Arrivée</name> \n')
   kmlfile.write('      <description>Arrivée.</description> \n')
   kmlfile.write('      <Point>\n')
   kmlfile.write('        <coordinates>\n')
   kmlfile.write(f'         {Arrive["lng"]},{Arrive["lat"]},2000\n')   # Point d'arrivée
   kmlfile.write('        </coordinates>\n')
   kmlfile.write('      </Point> \n')
   kmlfile.write('    </Placemark>\n')
   kmlfile.write('  </Document>\n')
   kmlfile.write('</kml>\n')

   kmlfile.close()
 
 except:

     print("An unexpected error occurred")


jsonPath=sys.argv

jsonToKml(jsonPath)