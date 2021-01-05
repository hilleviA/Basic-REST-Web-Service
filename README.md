# Webbtjänst
En webbtjänst som läser ut kurser som lästs på Mittuniversitetet från en lokal databas som sedan skrivs ut i JSON-format. På detta sätt kan man från andra domäner hämta in datan och sedan bearbeta och presentera den som man vill. 

## Requests med GET, POST, PUT och DELETE
För att testa sidan med t.ex. Advanced Rest Client använder man följande länkar: 

### GET (läser ut alla kusrer) 
http://courses.hilleviannfalt.se/

### GET (läser ut specifik kurs beroende på id) 
http://courses.hilleviannfalt.se/?ID=1

### POST (Postar ny kurs) 
http://courses.hilleviannfalt.se/

Görs i följande format
{
      "code":      "DT057G",
      "name":         "Webbutveckling I",
      "progression":  "A",
      "courseSyllabus":     "http://www.miun.se/utbildning/kurser/sok-kursplan/kursplan?kursplanid=15472"
    }

### PUT (uppdaterar kurs med valt id)
http://courses.hilleviannfalt.se/?ID=1

{
      "code":      "DT057G",
      "name":         "Webbutveckling I",
      "progression":  "A",
      "courseSyllabus":     "http://www.miun.se/utbildning/kurser/sok-kursplan/kursplan?kursplanid=15472"
    }

### DELETE (tar bort kurs med valt id )
http://courses.hilleviannfalt.se/?ID=1


## Länk till publicerad webbtjänst
http://courses.hilleviannfalt.se/




