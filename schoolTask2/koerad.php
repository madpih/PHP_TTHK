<?php
require ($_SERVER["DOCUMENT_ROOT"]."/../../config.php");
global $yhendus;

if(isSet($_REQUEST["uusleht"])){
    $kask=$yhendus->prepare("INSERT INTO koerad (nimi, kirjeldus, pildiaadress ) VALUES (?, ?, ?)");
    $kask->bind_param("sss", $_REQUEST["nimi"], $_REQUEST["kirjeldus"], $_REQUEST["pildiaadress"]);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]"); 
    $yhendus->close();
    exit();
}

if(isSet($_REQUEST["kustutasid"])){
    $kask=$yhendus->prepare("DELETE FROM koerad WHERE id=?");
    $kask->bind_param("i", $_REQUEST["kustutasid"]);
    $kask->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Koerad kirjelduse ja piltidega</title>
</head>
<body>

<style type="text/css">

body {
margin:30px;
font-family: Arial, Helvetica, sans-serif;
font-size: 24px;
margin-bottom:5px;
}

h1{
    text-transform:uppercase;
}

.container-main{
    background-color:ghostwhite;
}

a{
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.greeting{
    color:orangered;
}

</style>

<div class="container container-main">
    <div class="row">
        <div class="col-sm-6 px-5 py-5">
        <a class="btn btn-primary py-2" href='?lisamine=jah' role="button">Sisesta uus koer</a>
                
        <h1 class="text-uppercase py-5">Koerad piltide ja tutvustusega</h1>
            <ul>
            <?php
            $kask=$yhendus->prepare("SELECT id, nimi FROM koerad");
            $kask->bind_result($id, $nimi);
            $kask->execute();
            while($kask->fetch()){
            echo "<li><a href='?id=$id'>".
            htmlspecialchars($nimi)."</a></li>";
            }
            ?>

            </ul>
        </div>

        <div class="col-sm-6 py-5 px-5">
        <?php

        if(isSet($_REQUEST["id"])){
        $kask=$yhendus->prepare("SELECT id, nimi, kirjeldus, pildiaadress FROM koerad
        WHERE id=?");

        $kask->bind_param("i", $_REQUEST["id"]);
        $kask->bind_result($id, $nimi, $kirjeldus, $pildiaadress);
        $kask->execute();
        if($kask->fetch()){
        echo '<h2 class="text-uppercase">'.htmlspecialchars($nimi).'</h2>';
        echo htmlspecialchars($kirjeldus)."<br><br>";
        $imageData = base64_encode(file_get_contents($pildiaadress));
        echo '<img src="data:image/jpeg;base64,'.$imageData.'" style="width:auto; height:300px">';

        // echo "<br /><a href='?kustutasid=$id'>kustuta</a>";
        echo "<br/><a class='btn btn-primary py-2 my-3' href='?kustutasid=$id' role='button'>Kustuta</a>";

        } else {
        echo "Vigased andmed.";
        }
    }
    else if (isSet($_REQUEST["lisamine"]))
 {
    ?>
    
    <form action='?'>
    <input type="hidden" name="uusleht" value="jah" />
    <h2 class="my-3">Uue koera lisamine</h2>

    <div class="mb-3">
    <label for="nimi"class="form-label">Koera nimi:</label>
    <input class="form-control" input id="nimi" type="text" name="nimi" />
    </div>

    <div class="mb-3">
     <label for="kirjeldus" class="form-label">Koera kirjeldus:</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="kirjeldus"></textarea>
    </div>

    <div class="mb-3">
    <label for="pildiaadress" class="form-label">Pildiaadress:</label>
    <input class="form-control" type="url" id="pildiaadress" name="pildiaadress" >
    </div>
       
    <input class="btn btn-info my-2" type="submit" value="Sisesta">
    </form>

    <?php

        } else {
        echo '<h1 class=" mt-5 greeting pt-3">Tere tulemast avalehele!</h1><br>';
        echo '<h1>Vali vasakult sobiv koer, kelle kohta soovid rohkem teada</h1>';

        }

        ?>
        </div>
    </div>
</div>

<div class="container bg-dark text-white">
    <div class="footer p-3 text-center">
        Lehe tegi Madis
    </div>
</div>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>

<?php
$yhendus->close();
?>