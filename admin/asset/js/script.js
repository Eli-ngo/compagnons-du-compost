//fichier admin/asset/js/script.js
'use strict';

//on démarre la fonction
$(function(){

    //tooltips dans le tableau reviewtable.php
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    //Admin navbar
    $('.toggle').on('click', toggleMenu);
    function toggleMenu(){
        let navigation = document.querySelector('.navigation');
        let toggle = document.querySelector('.toggle');
        navigation.classList.toggle('active');
        toggle.classList.toggle('active');
    }
    
    //changement de preview et datapreview
    if ($('#fichier').length > 0) {
        // Sur changement de fichier de couverture (input de type file)
        $('#fichier').on('change', function (e){
            // on récupère les informations du fichier choisi
            let fichier = e.target.files[0];
            // on crée un lecteur de fichier
            let reader = new FileReader();
            //on lit le fichier choisi comme une ressource web
            reader.readAsDataURL(fichier);
            // Une fois lu, on vient modifier l'attribut src avec le résultat de la lecture
            reader.onload = function (event) {
                $('#preview').attr('src', event.target.result);
                $('#datapreview').attr('value', event.target.result);
            }
        });
    }
    
    //filtre tableau
    $('table').DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.22/i18n/French.json"
        },
        columnDefs: [{
            "targets": [0, 1, 2, 3, 4, 6],
            "orderable": false
        }]

    });

    //voir le mot de passe dans manager.php
    if( $('.voirmdp').length > 0){

        $('.voirmdp').on('click',function(){
    
            if( $(this).next('input').attr('type') == 'password' ){
                $(this).next('input').attr('type','text');         
            }
            else{
                $(this).next('input').attr('type','password');
            }
    
            $(this).toggleClass('fa-eye');
            $(this).toggleClass('fa-eye-slash');
    
        });
    
    }
    
}); //fin fonction


