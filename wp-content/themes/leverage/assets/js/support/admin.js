/*----------------------------------------------
*
* [Admin Scripts]
*
* Theme    : Leverage - Creative Agency, Corporate and Portfolio. Multipurpose Theme.
* Version  : 1.1.0
* Author   : Codings
* Support  : adm.codings@gmail.com
* 
----------------------------------------------*/

/*----------------------------------------------

[ALL CONTENTS]

1. Support

----------------------------------------------*/

/*----------------------------------------------
1. Support
----------------------------------------------*/

jQuery(function ($) {

    'use strict';

    var selection = '.leverage-icon .select2-selection';

    $(document).on('click', selection, function () {

        setTimeout(function() {

            let item = $('.select2-results__option');

            item.each(function() {           

                let value = $(this).text();

                $(this).addClass('leverage-icon-item').html('<i class="icon-'+value+'" title="'+value+'"></i>'+value);

            })
        
        }, 800)
    })

    var searching = '.select2-search__field';

    $(document).on('keyup', searching, function () {

        setTimeout(function() {

            let item = $('.select2-results__option');

            item.each(function() {           

                let value = $(this).text();

                $(this).addClass('leverage-icon-item').html('<i class="icon-'+value+'" title="'+value+'"></i>'+value);

            })
        
        }, 800)
    })
})