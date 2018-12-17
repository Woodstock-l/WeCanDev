// Déclaration des variables
var $form_tuto = $('form[name="tutorial"]');
$form_tuto.attr('novalidate', true);
var $form_error = $('.form-error');

var $title = $('#tutorial_title');
var $content = $('#tutorial_content');
var $category = $('input[name="tutorial[categories][]"]');

// var $category = $('input[name="tutorial[categories][]"]:checked');

// Requête jQuery - Ajax 
// $form_tuto.submit(function(e){
//     e.preventDefault();

//     var error = '';

//     // Cocher au moins une catégorie
//     if( $category.is(':checked') ){
//         error += '';
//     } else {
//         error += 'Veuillez cocher au moins une catégorie';
//     }

//     // Message d'erreur (div)
//     $form_error.html(error);
// });