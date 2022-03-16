'use strict';

(function($) {
    $(function() {
        // Si un li a un dropdown, ajouter le sous-menu toggle.
        $('nav ul li a:not(:only-child)').click(function(e) {
        $(this).siblings('.nav-dropdown').toggle();
        // Ferme le dropdown quand on clique sur un autre
        $('.nav-dropdown').not($(this).siblings()).hide();
        e.stopPropagation();
        });
        // Cliquer sur autre chose va enlever la class .dropdown
        $('html').click(function() {
        $('.nav-dropdown').hide();
        });
        // Toggle s'ouvre et ferme les nav style sur click
        $('#nav-toggle').click(function() {
        $('nav ul').slideToggle();
        });
        // Menu burger toggle vers X
        $('#nav-toggle').on('click', function() {
        this.classList.toggle('active');
        });
    });


    //Slider services
    $('.carousel-item:first-of-type').addClass('active');

    if ( $('.carousel-inner').children().length > 1 ) {
        $('.carousel-control').show();
    }
    else{
        $('.carousel-control').hide();
    }


    if ( $('.avis-content').children($('avis-content')).length > 1 ) {
        $('.avis').show();
    }
    else{
        $('.avis').hide();
    }

})(jQuery); // fin de jQuery