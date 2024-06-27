<?php

require_once("inc/init.php");
require_once("inc/header.php");

?>

<div class="col-md-12">
        <form method="POST" action="" class="form-row">
            <!-- PSEUDO -->
            <div class="form-group col-md-6">
                <label for="pseudo">Pseudo:</label>
                <input type="text" class="form-control" name="pseudo" id="pseudo" aria-describedby="pseudo" placeholder="Enter your pseudo">
            </div>
            <!-- PASSWORD -->
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="pwd" id="password" placeholder="Enter your password">
            </div>
            <!-- Last Name -->
            <div class="form-group col-md-3">
                <label for="lasttName">Last Name</label>
                <input type="text" class="form-control" name="name" id="lastName" placeholder="Enter your last name">
            </div>
            <!-- First Name -->
            <div class="form-group col-md-3">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" name="first_name" id="firstName" placeholder="Enter your first name">
            </div>
            <!-- Email -->
            <div class="form-group col-md-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your first email">
            </div>

            <div class="form-grou col-md-3">
                <label for="sexe">Sexe:</label>
                <div class="form-check">
                    <input class="form-check-input" name="sexe" type="radio" checked value="m" id="sexem">
                    <label class="form-check-label" for="sexem">
                        Male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="" id="sexef">
                    <label class="form-check-label" name="sexe" for="sexef">
                        Female
                    </label>
                </div>

            </div>

            <!-- Address -->
            <div class="form-group col-md-12">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="Enter your first address">
            </div>

            <!-- CITY -->
            <div class="form-group col-md-6">
                <label for="city">City</label>
                <input type="text" class="form-control" name="city" id="city" placeholder="Enter your first city">
            </div>

            <!-- POSTAL CODE -->
            <div class="form-group col-md-6">
                <label for="postalCode">Postal Code</label>
                <input type="text" class="form-control" name="postal_code" id="postalCode" placeholder="Enter your first postal code">
            </div>

            <div class="form-group col-md-3">
                <button type="submit" class="btn btn-dark">Create my account</button>
            </div>
        </form>
    </div>

<?php
require_once("inc/footer.php");
?>