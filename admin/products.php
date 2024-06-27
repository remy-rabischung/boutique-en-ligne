<?php

require_once("../inc/init.php");
require_once("inc/header.php");

?>


<!-- BODY -->

<h1 class="mb-5 text-center col-12">Welcome to the management of your products in your BackOffice</h1>


<!-- TABLE -->

<p class="text-center col-12">Your products in DB:</p>


<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col"> id_product </th>
            <th scope="col"> reference </th>
            <th scope="col"> category </th>
            <th scope="col"> title </th>
            <th scope="col"> description </th>
            <th scope="col"> color </th>
            <th scope="col"> size </th>
            <th scope="col"> public </th>
            <th scope="col"> picture </th>
            <th scope="col"> price </th>
            <th scope="col"> stock </th>
            <th scope="col"> Modify </th>
            <th scope="col"> Delete </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> 2 </td>
            <td> 31-p-33 </td>
            <td> T-shirt </td>
            <td> Black original t-shirt </td>
            <td> Nice original t-shirt </td>
            <td> black </td>
            <td> XL </td>
            <td> m </td>
            <td> <img style="width:50px" src="http://localhost:8888/php/onlineshop/pictures/31-p-33_green_t-shirt.png">
            </td>
            <td> 25 </td>
            <td> 0 </td>
            <td> <a href="?action=modify&amp;id_product=2#add_modify"> Modify </a> </td>
            <td> <a href="?action=delete&amp;id_product=2"> Delete </a> </td>
        </tr>
        <tr>
            <td> 3 </td>
            <td> 56-a-65 </td>
            <td> Shirt </td>
            <td> White shirt </td>
            <td> Classic white shirt </td>
            <td> white </td>
            <td> L </td>
            <td> m </td>
            <td> <img style="width:50px" src="http://localhost:8888/php/onlineshop/pictures/white_shirt.png"> </td>
            <td> 49 </td>
            <td> 1 </td>
            <td> <a href="?action=modify&amp;id_product=3#add_modify"> Modify </a> </td>
            <td> <a href="?action=delete&amp;id_product=3"> Delete </a> </td>
        </tr>
        <tr>
            <td> 4 </td>
            <td> 77-p-79 </td>
            <td> Pullover </td>
            <td> Grey pullover </td>
            <td> Grey Pullover for winter </td>
            <td> grey </td>
            <td> XL </td>
            <td> f </td>
            <td> <img style="width:50px" src="http://localhost:8888/php/onlineshop/pictures/grey_pullover.png"> </td>
            <td> 79 </td>
            <td> 4 </td>
            <td> <a href="?action=modify&amp;id_product=4#add_modify"> Modify </a> </td>
            <td> <a href="?action=delete&amp;id_product=4"> Delete </a> </td>
        </tr>
        <tr>
            <td> 5 </td>
            <td> 11-d-231 </td>
            <td> T-shirt </td>
            <td> V-neck T-shirt </td>
            <td> Dark blue t-shirt for men </td>
            <td> dark blue </td>
            <td> M </td>
            <td> m </td>
            <td> <img style="width:50px" src="http://localhost:8888/php/onlineshop/pictures/blue_t-shirt.png"> </td>
            <td> 44 </td>
            <td> 0 </td>
            <td> <a href="?action=modify&amp;id_product=5#add_modify"> Modify </a> </td>
            <td> <a href="?action=delete&amp;id_product=5"> Delete </a> </td>
        </tr>
        <tr>
            <td> 6 </td>
            <td> 66-f-15_01 </td>
            <td> T-shirt </td>
            <td> Red t-shirt </td>
            <td> Red t-shirt for man </td>
            <td> red </td>
            <td> S </td>
            <td> m </td>
            <td> <img style="width:50px" src="http://localhost:8888/php/onlineshop/pictures/red_t-shirt.png"> </td>
            <td> 56 </td>
            <td> 5 </td>
            <td> <a href="?action=modify&amp;id_product=6#add_modify"> Modify </a> </td>
            <td> <a href="?action=delete&amp;id_product=6"> Delete </a> </td>
        </tr>


    </tbody>
</table>

<div class="row col-12">
</div>


<p id="add_modify">Add or Modify your products :</p>

<form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_product" value="">
    <input type="hidden" name="prevPicture" value="">
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="reference">Reference</label>
            <input type="text" class="form-control" id="reference" name="reference" value="">
        </div>
        <div class="form-group col-md-3">
            <label for="category">Category</label>
            <input type="text" class="form-control" id="category" name="category" value="">
        </div>
        <div class="form-group col-md-3">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="">
        </div>
        <div class="form-group col-md-3">
            <label for="color">Color</label>
            <input type="text" class="form-control" id="color" name="color" value="">
        </div>
        <div class="form-group col-md-3">
            <label for="size">Size</label>
            <input type="text" class="form-control" id="size" name="size" value="">
        </div>
        <div class="form-group col-md-3">
            <label for="price">Price</label>
            <input type="text" class="form-control" id="price" name="price" value="">
        </div>
        <div class="form-group col-md-3">
            <label for="stock">Stock</label>
            <input type="text" class="form-control" id="stock" name="stock" value="">
        </div>
        <div class="w-100"></div>

        <!-- FAIRE VARIABLED LE SELECTED DES INPUTS -->

        <div class="form-group col-md-2">
            <label for="public_m">Public</label>
            <div class="custom-control custom-radio">
                <input type="radio" id="public_m" name="public" class="custom-control-input" value="m" checked="">
                <label class="custom-control-label" for="public_m">Male</label>
            </div>
        </div>
        <div class="form-group col-md-2">
            <label for="public_f" style="color:transparent">Public</label>
            <div class="custom-control custom-radio">
                <input type="radio" id="public_f" name="public" class="custom-control-input" value="f">
                <label class="custom-control-label" for="public_f">Female</label>
            </div>
        </div>

        <div class="custom-file mb-5">
            <input type="file" class="custom-file-input" id="myPicture" name="myPicture">
            <label class="custom-file-label" for="myPicture">Choose a picture</label>


        </div>
        <div class="form-group col-md-12">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="">
        </div>

        <button type="submit" class="btn btn-secondary" name="addProduct">Add a product</button>
    </div>

</form>


<?php
require_once("inc/footer.php");
?>