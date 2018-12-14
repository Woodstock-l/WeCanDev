
    
    // Déclaration des variables
    var $form_tuto = $('form[name="tutorial"]');
    $form_tuto.attr('novalidate', true);
    var $form_error = $('.form-error');

    var $title = $('#tutorial_title');
    var $category = $('#category');
    var $content = $('#content');

    // Requête jQuery - Ajax 
    $form_tuto.submit(function(e){
        e.preventDefault();

        var error = '';

        if($title.val().length <= 3) {
            // !isCategory(category) | content.length < 50)
            error += "Veuillez renseigner un titre.<br>"; 
        }

        // foreach
        console.log($('input[name="tutorial[categories][]"]'));

        $form_error.html(error);

        if(error == '') {
            alert('formulaire envoyé');
                // $form.ajaxSubmit({
                //     url: '_form.html.twig',
                //     type: 'POST',
                //     data: $form_tuto.serialize(),
                //     dataType: 'html',
                // });
        }
    });