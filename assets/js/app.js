/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
//var $ = require('jquery');
import 'bootstrap';
import 'summernote/dist/summernote-bs4.js';
import 'codemirror';
import 'codemirror/mode/xml/xml.js';


$(function() {

    $('.summernote').summernote({
        height: 250,   
        codemirror: { // codemirror options
            theme: 'monokai',
        },
        styleTags: [
            'p',
            {title: 'Blockquote', tag: 'blockquote', className: 'blockquote', value: 'blockquote'},
            {title: 'Code', tag: 'pre', className: 'code', value: 'pre'},
            {title: 'Titre 1', tag: 'h1', className: 'titre1', value: 'h1'},
            {title: 'Titre 2', tag: 'h2', className: 'titre2', value: 'h2'},
            {title: 'Titre 3', tag: 'h3', className: 'titre3', value: 'h3'},
            {title: 'Titre 4', tag: 'h4', className: 'titre4', value: 'h4'},
            {title: 'Titre 5', tag: 'h5', className: 'titre5', value: 'h5'},
            {title: 'Titre 6', tag: 'h6', className: 'titre6', value: 'h6'},
          ]
    });

    var $followLink = $('.follow-link');

    // Pour chaque élément ".follow-link"
    $followLink.each(function(index, element) {
        // Intercepte l'événement "click" du lien
        $(element).click(function(e) {
            e.preventDefault(); // Annule le chargement de la page

            $.getJSON($(this).attr('href'), function(data) {

                if (data.success) {
                    if(data.isFollow) { // Si on suis l'article
                        $(element).addClass('text-warning').removeClass('text-primary');
                    } else {
                        $( element ).addClass( 'text-primary' ).removeClass( 'text-warning' );
                    }
                }
            });

        });
    });
});