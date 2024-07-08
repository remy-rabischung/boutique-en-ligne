$(document).ready(function () {

    $("#selectQuantity").change(function() {
        $("#addToCart").prop("disabled", false);
    });
    
});

$(function() {
    $("#search").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "../search_suggestions.php",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function(data) {
                    response(data);
                },
                error: function(xhr, status, error) {
                    console.error("Erreur AJAX:", status, error);
                }
            });
        },
        minLength: 2, // Longueur minimale de la recherche avant de déclencher l'autocomplétion
        select: function(event, ui) {
            // Optionnel : rediriger vers la page du produit sélectionné
            window.location.href = 'product.php?id=' + ui.item.value;
        }
    });
});
