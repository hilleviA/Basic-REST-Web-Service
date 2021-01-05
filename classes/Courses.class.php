<?php 
class Courses {

    private $db;
    private $code;
    private $name;
    private $progression;
    private $courseSyllabus;

    //Function constructor 
    function __construct(){
        $this->db = new mysqli (DBHOST, DBUSERNAME, DBPASSWORD, DBNAME);
        if($this->db->connect_errno > 0) {
            die ("Kunde inte ansluta till databasen. Fel: " . $this->db->connect_error);
        }
    }

    
    //Läser in samtliga kurser
    function getAllCourses() {
        $sql = "SELECT * FROM Courses";
        $result = $this->db->query($sql); 
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    //Läser in kurs med medskickat ID
    function getSpecificCourse($ID) {
        $sql = "SELECT * FROM Courses WHERE ID ='$ID'";
        $result = $this->db->query($sql); 
        $thePost = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $thePost; 
    }


    function addNewCourse() {
        $sql = "INSERT INTO Courses (CourseCode, CourseName, Progression, CourseSyllabus) VALUES ('$this->code', '$this->name', '$this->progression', '$this->courseSyllabus');";
        $result =  $this->db->query($sql);
        return $result;
    }

    //Uppdatera en kurs
    function updateCourse($id) {
        $sql = "UPDATE Courses SET CourseCode = '$this->code', CourseName = '$this->name', Progression  = '$this->progression', CourseSyllabus = '$this->courseSyllabus'  WHERE ID ='$id';";
        $result =  $this->db->query($sql);
        return $result;

    }

    //Ta bort en kurs
    function deleteCourse($id) {
        $sql = "DELETE FROM Courses WHERE ID = '$id'";
        return $result =  $this->db->query($sql);
    }

    //Set and get Code
    function setCode($code) {
        if($code != "") {
            $code = strip_tags($code);
            $this->code = $code;
            return true;
        }else {
            return false;
        }   
    }

    function getCode() {
        return $this->code; 
    }
    
    //Set and get Name
    function setName($name) {
        if($name != "") {
            $name = strip_tags($name);
            $this->name = $name;
            return true;
        } else {
            return false;
        }   
    }

    function getName() {
        return $this->name; 
    }
    
    //Set and get Progression
    function setProgression($progression) {
        if($progression != "") {
            $progression = strip_tags($progression);
            $this->progression = $progression;
            return true;
        }
        return false;    
    }

    function getProgression() {
        return $this->progression; 
    }

    //Set and get CourseSyllabus
    function setCourseSyllabus($courseSyllabus) {
        if($courseSyllabus !="") {
            $courseSyllabus = strip_tags($courseSyllabus);
            $this->courseSyllabus = $courseSyllabus;
            return true;
        } else {
            return false;
        }
        
    }
    function getCourseSyllabus() {
        return $this->courseSyllabus; 
    }

}


?>