<?php

//Laddar autmatiskt in klasser när de kallas
function autoLoader($className) {
    $filePath = "classes/" . $className . ".class.php";
    include($filePath);
}
spl_autoload_register("autoLoader"); 


//Databasinställningar lokalt
define("DBHOST", "");
define("DBUSERNAME", "");
define("DBPASSWORD", "");
define("DBNAME", "");

?>