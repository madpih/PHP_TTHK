<?php
$kask = $yhendus ->prepare("SELECT id, firstname, lastname, email FROM participants");
$kask->bind_result($id,$firstname,$lastname, $email);
$kask->execute();

?>

<h1>List of participants</h1>
    
    <?php
    $rownumber= 1;
    while($kask->fetch()){

        echo "<h2>".$rownumber.". ".htmlspecialchars($firstname)." ".htmlspecialchars($lastname)."</h2>";
        $rownumber = $rownumber + 1;
        echo "<p class='format-p'>".htmlspecialchars($email)."</p>";

    }
    ?>
</body>
</html>

<?php
$yhendus->close();

?>
