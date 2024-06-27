<?php

require_once("inc/init.php");
require_once("inc/header.php");
?>

<!-- Body content -->

<?= $content; ?>

<div class="col-md-12">
    <h3 class="text-center mb-5"> Get connected to access your profile !</h3>
</div>

<div class="col-md-5">
    <form method="POST" action="">
        <div class="form-group">
            <label for="pseudo">Pseudo:</label>
            <input type="text" name="pseudo" class="form-control" id="pseudo" aria-describedby="pseudo" placeholder="Enter your pseudo">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="pwd" class="form-control" id="password" placeholder="Enter your password">
        </div>
        <button type="submit" class="btn btn-dark">Connection</button>
    </form>
</div>


<?php
require_once("inc/footer.php");
?>