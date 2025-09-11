var emailValidators = {
    validators: {
        stringCase: {
            message: 'The Email must be in lowercase',
            'case': 'lower'
        },
        notEmpty: {
            message: 'The Email is required and cannot be empty.'
        },
        stringLength: {
            max: 150,
            message: 'The Email must less than 30 characters'
        }
    }
};

// user
$('#add_user').bootstrapValidator({
    excluded: [':disabled', ':hidden', ':not(:visible)'],
    fields: {
        role: {
            validators: {
                notEmpty: {
                    message: 'The Role is required.'
                }
            }
        },
        name: {
            validators: {
                notEmpty: {
                    message: 'The Name is required.'
                }
            }
        },
        email: emailValidators
    }
});

$('#add_url').bootstrapValidator({
    excluded: [':disabled', ':hidden', ':not(:visible)'],
    fields: {
        original_url: {
            validators: {
                notEmpty: {
                    message: 'The Long URL is required.'
                }
            }
        }
    }
});


function ajaxLoaderStart() {
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="' + BASE_URL + '/public/assets/img/ajax-loader.gif"><div></div></div><div class="bg"></div></div>');
    }

    jQuery('#resultLoading').css({
        'width': '100%',
        'height': '100%',
        'position': 'fixed',
        'z-index': '10000000',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto'
    });

    jQuery('#resultLoading .bg').css({
        'background': '#000000',
        'opacity': '0.7',
        'width': '100%',
        'height': '100%',
        'position': 'absolute',
        'top': '0'
    });

    jQuery('#resultLoading>div:first').css({
        'width': '250px',
        'height': '75px',
        'text-align': 'center',
        'position': 'fixed',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto',
        'font-size': '16px',
        'z-index': '10',
        'color': '#ffffff'

    });

    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}
function ajaxLoaderStop() {
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}