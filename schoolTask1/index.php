<?php
require($_SERVER["DOCUMENT_ROOT"]."/../config.php");
global $yhendus;

if(isSet($_REQUEST["uusleht"])){
    $kask=$yhendus->prepare("INSERT INTO schedule (startingtime, performanceAct ) VALUES (?, ?)");
    $kask->bind_param("ss", $_REQUEST["startingtime"], $_REQUEST["performanceAct"]);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]?page=$_REQUEST[page]"); 

    $yhendus->close();
    exit();
}

if(isSet($_REQUEST["uusleht2"])){
    $kask=$yhendus->prepare("INSERT INTO participants(firstname, lastname, email ) VALUES (?, ?, ?)");
    $kask->bind_param("sss", $_REQUEST["firstname"], $_REQUEST["lastname"], $_REQUEST["email"]);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]"); 
    $yhendus->close();
    exit();
}


if(isSet($_REQUEST["kustutasid"])){
    $kask=$yhendus->prepare("DELETE FROM schedule WHERE id=?");
    $kask->bind_param("i", $_REQUEST["kustutasid"]);
    $kask->execute();
}

if(isSet($_REQUEST["kustutasid"])){
    $kask=$yhendus->prepare("DELETE FROM participants WHERE id=?");
    $kask->bind_param("i", $_REQUEST["kustutasid"]);
    $kask->execute();
}

require("header.php");

if(isset($_GET["page"])){
    $openPage = $_GET["page"].".php";
    if (file_exists($openPage)) {
        require($openPage);
    } else {
        require("error404.php");
    }
    
} else {
    require("default.php");
}

require("footer.php");