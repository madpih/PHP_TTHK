
<div class="content-center">
<h1>Schedule Management</h1>
<ul>
<?php

$kask=$yhendus->prepare("SELECT id, startingtime, performanceAct FROM schedule order by startingtime");
$kask->bind_result($id, $startingtime,$performanceAct);
$kask->execute();
while($kask->fetch()){
    $datetime = new DateTime($startingtime);
    echo "<li><a href='?page=schedule_admin&id=$id'>".
    ($datetime->format('d.m H:i'))."  ".htmlspecialchars($performanceAct)."</a></li>";

    }
?>
</ul>

<div>
    <a href='?page=schedule_admin&lisamine=jah'><button class ="button button1"> Add new...</button></a>
<br>
</div>
    <?php
        if(isSet($_REQUEST["id"])){
        $kask=$yhendus->prepare("SELECT id, startingtime, performanceAct FROM schedule
        WHERE id=?");
            $kask->bind_param("i", $_REQUEST["id"]);
            $kask->bind_result($id, $startingtime, $performanceAct);
            $kask->execute();
            if($kask->fetch()){
                $datetime = new DateTime($startingtime);
                echo "<h1><b>".($datetime->format('d.m H:i'))."</b></h1>";
                echo '<h4 class="content">'.htmlspecialchars($performanceAct)."</h4>";
                echo "<a href='?page=schedule_admin&kustutasid=$id'><button class ='button button1'>Delete event</button></a>";
        } else {
            echo "Incorrect data.";
        }
    }
        else if (isSet($_REQUEST["lisamine"]))
    {
    ?>
    <div class="form-style">
        <form method="POST" action='?'>
            <input type="hidden" name="uusleht" value="jah" />
            <input type="hidden" name="page" value="schedule_admin" />

            <h2>Add new time and performance act</h2>
            <dl>
            <dt><label for="startingtime">Time:</label></dt>
            <dd>
            <input id="startingtime" type="datetime-local" name="startingtime"/>
            <br>
            </dd>
            <dt><label for="performanceAct">Performance Act:</label></dt>
            <dd>
            <textarea rows="5" name="performanceAct"></textarea>
            </dd>
            </dl>
            <button class ="button button1" input type="submit" value="Submit">Submit</button>
            <br>
            <br>
        </form>
    </div>

    <?php
    }

    ?>

</div>

</body>
</html>

<?php
$yhendus->close();
?>
