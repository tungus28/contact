let $ = jQuery;
function editContact(id) {
   $('table').find('tr').each(function (index) {
        if($(this).attr('data-id') == id) {
            $('.update').find('input').eq(0).val($(this).find('td').eq(0).text())
            $('.update').find('input').eq(1).val($(this).find('td').eq(1).text())
            $('.update').find('input').eq(2).val($(this).find('td').eq(2).text())
            $('.update').find('input').eq(3).val($(this).find('td').eq(3).text())
            $('.update').find('input').eq(4).val(id)
        }
   })

}

$(function() {

    let emailPattern = /^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;

    $('.update_form').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            contact_email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    regexp: {
                        regexp: emailPattern,
                        message: 'The value is not a valid email address'
                    }
                }
            },
        }
    })
    .on('success.form.bv', function(e) {
        e.preventDefault();

        if( $('.update_form').find('#contact_email').val().match(emailPattern) === null ) {
            return;
        }

        $('.update_form').bootstrapValidator('defaultSubmit');
    });

    $('.add_form').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            contact_email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    regexp: {
                        regexp: emailPattern,
                        message: 'The value is not a valid email address'
                    }
                }
            },
        }
    })
        .on('success.form.bv', function(e) {
            e.preventDefault();

            if( $('.add_form').find('#contact_email').val().match(emailPattern) === null ) {
                return;
            }

            $('.add_form').bootstrapValidator('defaultSubmit');
        });

});



