
<div class="content-center">
<h1>Schedule Management</h1>
<ul>
<?php
$kask=$yhendus->prepare("SELECT id, time_format(startingtime,'%H:%i') as formatted_time FROM schedule order by formatted_time");
$kask->bind_result($id, $formatted_time);
$kask->execute();
while($kask->fetch()){
    echo "<li><a href='?page=schedule_admin&id=$id'>".
    htmlspecialchars($formatted_time)."</a></li>";
    }
?>
</ul>

<div>
    <a href='?page=schedule_admin&lisamine=jah'><button class ="button button1"> Add new...</button></a>
<br>
</div>


    <?php
        if(isSet($_REQUEST["id"])){
        $kask=$yhendus->prepare("SELECT id, time_format(startingtime,'%H:%i') as formatted_time, performanceAct FROM schedule
        WHERE id=?");

        $kask->bind_param("i", $_REQUEST["id"]);
        $kask->bind_result($id, $formatted_time, $performanceAct);
        $kask->execute();
        if($kask->fetch()){
            echo '<h2 class="text-uppercase">'.htmlspecialchars($formatted_time).'</h2>';
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
            <input type="hidden" name="page" value="schedule_admin.php" />

            <h2>Add new time and performance act</h2>
            <dl>
            <dt><label for="startingtime">Time:</label></dt>
            <dd>
            <input id="startingtime" type="time" name="startingtime" />
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
