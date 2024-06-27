<?php

require_once("inc/init.php");

require_once("inc/header.php");
?>

<div class="col-md-12 mb-5">
    <h2 class="text-center">Hi habbani sam , welcome to your profile !</h2>
</div>

<div class="card col-md-4">
    <img src="pictures/avatar_male.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">habbani sam</h5>
    </div>

    <ul class="list-group list-group-flush">
        <li class="list-group-item text-center">samihhabbani@gmail.com</li>
        <li class="list-group-item text-center">26 rue d'acy</li>
        <li class="list-group-item text-center">02200 Sepmtonts</li>
    </ul>
</div>

<div class="col-md-4">
    <ul class="list-group">
        <li class="list-group-item text-center">
            <h5>My orders</h5>
        </li>

            </ul>

    <ul class="list-group mt-5">
        <li class="list-group-item text-center">
            <h5>All my orders</h5>
        </li>
        <li class="list-group-item text-center">
            <p>Order n°1 from the 2020-03-01</p>
            <p class="badge badge-primary"> Sent</p>
        </li>
    </ul>
</div>

<?php
require_once("inc/footer.php");
?>