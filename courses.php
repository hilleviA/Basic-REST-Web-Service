<?php

//Läser in inställningar
require "config.php";

//Header inställningar
header("Content-Type: application/json, charset=UTF-8"); //För att kunna använda JSON
header("Access-Control-Allow-Origin: *"); //För att användas utanför webbplatsen
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Lägger till funktionalitet för att sända requests
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");

//Lagrar medskickad metod och ID i variabler
$method = $_SERVER["REQUEST_METHOD"];
if(isset($_GET["ID"])) {
    $id = $_GET["ID"];
}

//Initierar klassinstans
$course = new Courses();

//Tar reda på vilken metod som använts
switch ($method) {
    case "GET":
        if(isset($id)) {
            $result = $course->getSpecificCourse($id);   
        }
        else {
            $result = $course->getAllCourses();
        }
        if(sizeof($result) > 0) {
            http_response_code(200); //Ok
        }
        else {
            http_response_code(404); //Not found
            $result = array("Message" => "Inga kurser funna"); 
        }
        break;
    case "POST":
        //Konverterar från JSON
        $data = json_decode(file_get_contents("php://input"));
        
        //Kontrollerar så att medskickad data inte är tom eller innehåller ogiltiga tecken.
        //Lägger till i databasen
        if($course->setCode($data->code) && $course->setName($data->name) && $course->setProgression($data->progression) && $course->setCourseSyllabus($data->courseSyllabus)) {
            if($course->addNewCourse()) {
                http_response_code(201); //Created
                $result = array("Message" => "Kursen är tillagd");
            }else {
                http_response_code(503); //Service Unavailable
                $result = array("Message" => "Kurs kunde inte läggas till");
            }
        } else {
            $result = array("Message" => "Inga kolumner får lämnas tomma");
        }
        break;
    case "PUT":
        if(!isset($id)) {
            http_response_code(510);
            $result = array("Message" => "Ingen kurs vald");
        } else {
            //Konverterar från JSON
            $data = json_decode(file_get_contents("php://input"));
            
            //Hindrar ogiltiga tecken att lagras i databasen
            $course->setCode($data->code);
            $course->setName($data->name);
            $course->setProgression($data->progression);
            $course->setCourseSyllabus($data->courseSyllabus);

            if($course->updateCourse($id)) {
                http_response_code(200); //Ok
                $result = array("Message" => "Kursen är uppdaterad");
            } else {
                http_response_code(503); //Service Unavailable
                $result = array("Message" => "Kunde inte uppdatera kursen");
            }
        } 
        break;
    case "DELETE": 
        if(!isset($id)) {
            http_response_code(501); //Not Implemented
            $result = array("Message" => "Ingen kurs vald");
        } else {
            if($course->deleteCourse($id)) {
                http_response_code(200); //Ok
                $result = array("Message" => "Kursen bortagen");
            } else {
                http_response_code(503); //Service Unavailable
                $result = array("Message" => "Kursen kunde inte tas bort");
            }
        }
        break;
}

//Skriver ut resultatet
echo json_encode($result);

?>