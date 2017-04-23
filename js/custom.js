/* Ready function */
$(function () {
    alert('ready');
    /* Subscribe Button */
    $('#newsletter-subscribe-button').click(function () {
        alert('click');
        var emailIn = $('#newsletter-email').val();
        if (emailIn.length != 0) {
            if (validateEmail(emailIn)) {
                $.ajax({
                    url: templateURL + 'chkSubscribed.php?emailid=' + emailIn,
                    method: 'post',
                    async: false,
                    success: function (data) {
                        if ($.trim(data) == 1) {
                            $('.showMsg').html('Thank you for subscribing!').fadeIn();
                            setTimeout(function () {
                                $('.showMsg').fadeOut();
                                $('.emailInput').val('');
                            }, 3000);
                        } else {
                            $('.showMsg').html('You seem to be on our list. Would you like to try again with another email id?').fadeIn();
                            setTimeout(function () {
                                $('.showMsg').fadeOut();
                                $('.emailInput').val('');
                            }, 3000);
                        }
                    }
                });


            } else {
                $('.showMsg').html('Oops! This doesn\'t look alright. Would you like to try again?').fadeIn();
                setTimeout(function () {
                    $('.showMsg').fadeOut();
                }, 3000);
            }
        } else {
            $('.showMsg').html('Oops! This doesn\'t look alright. Would you like to try again?').fadeIn();
            setTimeout(function () {
                $('.showMsg').fadeOut();
            }, 3000);
        }
    });

});


function validateEmail(strValue)
{
    var objRegExp = /^[a-z0-9]([a-z0-9_\-\.]*)@([a-z0-9_\-\.]*)(\.[a-z]{2,3}(\.[a-z]{2}){0,2})$/i;
    return objRegExp.test(strValue);
}
function numeric(event)
{
    if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || (event.keyCode == 8) || (event.keyCode == 9) || (event.keyCode == 12) || (event.keyCode == 27) || (event.keyCode == 37) || (event.keyCode == 39) || (event.keyCode == 46))
    {
        return true;
    } else {
        event.preventDefault();
        return false;
    }
}