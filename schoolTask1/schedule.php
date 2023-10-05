<div class="content-center">
<h1>Event Schedule</h1>

<ul>
    <?php
    $kask=$yhendus->prepare("SELECT id, startingtime, performanceAct FROM schedule order by startingtime");
    $kask->bind_result($id, $startingtime, $performanceAct);
    $kask->execute();

       while($kask->fetch()){
        $datetime = new DateTime($startingtime);
        echo "<h1><b>".($datetime->format('d.m H:i'))."</b></h1>";
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