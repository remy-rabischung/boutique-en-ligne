<?php

// Accueil du BACK OFFICE

require_once("../inc/init.php");
require_once("inc/header.php");

?>

<!-- BODY -->
<h1 class="mb-5 text-center">Welcome to the management of your orders in the backOffice</h1>

<div class="w-100"> </div>

<h2>List of orders <span class="badge badge-secondary"></span></h2>

<div class="w-100"> </div>

<form class="row col-md-12 align-items-center justify-content-center m-5" method="get" action="">
    <input type="hidden" name="filterCommand">
    <select class="form-control col-md-4" name="state">
        <option value="none" disabled="" selected=""> Choose type of order </option>
        <option value="in progress"> In progress </option>
        <option value="sent"> Sent </option>
        <option value="delivered"> Delivered </option>
    </select>

    <p class="text-center mb-0 mr-3 ml-3">Or</p>

    <input type="text" name="id_order" class="form-control col-md-4" id="id_order" aria-describedby="id_order"
        placeholder="Enter an order number">

</form>


<table class="table mb-5">
    <thead class="thead-dark">
        <tr>
            <th scope="col"> id_order </th>
            <th scope="col"> id_member </th>
            <th scope="col"> amount </th>
            <th scope="col"> date </th>
            <th scope="col"> state </th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td> 9</td>
            <td> 1</td>
            <td> 40</td>
            <td> 2022-10-17 17:14:07</td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="id_order" value="9">
                    <input type="hidden" name="modifyState">
                    <select class="form-control" name="state">
                        <option value="in progress" selected=""> In progress </option>
                        <option value="sent"> Sent </option>
                        <option value="delivered"> Delivered </option>
                    </select>
                </form>
            </td>
        </tr>
        <tr>
            <td> 10</td>
            <td> 1</td>
            <td> 75</td>
            <td> 2022-10-17 17:17:01</td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="id_order" value="10">
                    <input type="hidden" name="modifyState">
                    <select class="form-control" name="state">
                        <option value="in progress"> In progress </option>
                        <option value="sent"> Sent </option>
                        <option value="delivered" selected=""> Delivered </option>
                    </select>
                </form>
            </td>
        </tr>
        <tr>
            <td> 11</td>
            <td> 1</td>
            <td> 49</td>
            <td> 2022-10-17 17:20:36</td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="id_order" value="11">
                    <input type="hidden" name="modifyState">
                    <select class="form-control" name="state">
                        <option value="in progress"> In progress </option>
                        <option value="sent" selected=""> Sent </option>
                        <option value="delivered"> Delivered </option>
                    </select>
                </form>
            </td>
        </tr>
        <tr>
            <td> 12</td>
            <td> 1</td>
            <td> 151</td>
            <td> 2022-10-17 17:23:37</td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="id_order" value="12">
                    <input type="hidden" name="modifyState">
                    <select class="form-control" name="state">
                        <option value="in progress"> In progress </option>
                        <option value="sent"> Sent </option>
                        <option value="delivered" selected=""> Delivered </option>
                    </select>
                </form>
            </td>
        </tr>
        <tr>
            <td> 13</td>
            <td> 1</td>
            <td> 98</td>
            <td> 2022-10-17 17:30:15</td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="id_order" value="13">
                    <input type="hidden" name="modifyState">
                    <select class="form-control" name="state">
                        <option value="in progress" selected=""> In progress </option>
                        <option value="sent"> Sent </option>
                        <option value="delivered"> Delivered </option>
                    </select>
                </form>
            </td>
        </tr>

    </tbody>
</table>


<?php
require_once("inc/footer.php");
?>