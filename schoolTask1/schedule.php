<div class="content-center">
<h1>Event Schedule</h1>

<ul>
    <?php
    $kask=$yhendus->prepare("SELECT id, time_format(startingtime,'%H:%i') as formatted_time, performanceAct FROM schedule order by formatted_time");
    $kask->bind_result($id, $formatted_time, $performanceAct);
    $kask->execute();

    while($kask->fetch()){
        echo "<h1><b>".htmlspecialchars($formatted_time)."</b></h1>";
        echo "<b><h4 class='content bg'>".htmlspecialchars($performanceAct)."</h4><b>";
    }
    ?>
</ul>

</div>
</body>
</html>

<?php
$yhendus->close();
?>