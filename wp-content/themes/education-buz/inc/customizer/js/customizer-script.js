jQuery(document).ready(function($) {	

    /** Script for switch option **/
    $('.switch_button').each(function() {
        //This object
        var obj = $(this);
    
        var switchPart = obj.children('.switch_part').attr('data-switch');
        var input = obj.children('input'); //cache the element where we must set the value
        var input_val = obj.children('input').val(); //cache the element where we must set the value
    
        obj.children('.switch_part.'+input_val).addClass('selected');
        obj.children('.switch_part').on('click', function(){
            var switchVal = $(this).attr('data-switch');
            obj.children('.switch_part').removeClass('selected');
            $(this).addClass('selected');
            $(input).val(switchVal).change(); //Finally change the value to 1
        });

    });
     
    /** Radio Image **/
    $( '[id="input_education_buz_portfolio_layout"]' ).buttonset(); 
    
    /** FA Icon **/
    $(document).on('click', '.tb-fa-icons li', function() {
        $(this).parents('.tb-fa-icons').find('li').removeClass();
        $(this).addClass('selected');
        var iconVal = $(this).parents('.icons-list-wrapper').find('li.selected').children('i').attr('class');
        var inpiconVal = iconVal.split(' ');
        $(this).parents( '.tb-fa-icons' ).find('.tb-icon-value').val(inpiconVal[1]);
        $(this).parents( '.tb-fa-icons' ).find('.ta-icon-preview').html('<i class="' + iconVal + '"></i>');
        $('.tb-icon-value').trigger('change');
    });
});