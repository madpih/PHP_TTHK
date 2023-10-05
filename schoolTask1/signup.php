 <div class="content-center">
 <h1>Signup for the awesome party</h1>
    <a href='?page=signup&lisamine=jah'><button class ="button button1"> Insert your details here ...</button></a>


 <?php

if (isSet($_REQUEST["lisamine"])){

?>
<div class="form-style">
    <form method="POST" action="?">
    <input type="hidden" name="uusleht2" value="jah" />
    <dl>
    <dt><label for="firstname">First Name</label></dt>
    <dd>
    <input id="firstname" type="text" name="firstname" />
    <br>
    </dd>
    
    <dt><label for="lastname">Last Name</label></dt>
    <dd>
    <input id="lastname" type="text" name="lastname" />
    <br>
    </dd>

    <dt><label for="email">Your Email</label></dt>
    <dd>
    <input id="email" type="email" name="email" />
    <br>
    </dd>

    </dl>

    <button class ="button button1" input type="submit" value="Submit">Submit</button>
    <br>
    <br>
    </form>
 
    <?php

}
?>

</div>
</body>
</html>

<?php
$yhendus->close();
?>

