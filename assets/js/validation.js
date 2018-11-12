$('.c-form-1-box form').on('submit', function (event) {

    $(this).find('p').text('');
    event.preventDefault();
    // $('.c-form-1-box form input[type="text"], .c-form-1-box input[type="email"], .c-form-1-box input[type="tel"], .c-form-1-box form textarea').removeClass('contact-error');
    var emailRegexp = /^[\w-]+(\.[\w-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i,
            phoneRegexp = /^0(2|3|4|5|8|9)(\d)?\d{7}$/,
            validate = false,
            name = $('#c-form-1-name'),
            email = $('#c-form-1-email'),
            phone = $('#c-form-1-subject'),
            userData = {
                name: name.val().trim(),
                email: email.val().trim(),
                phone: phone.val().trim()
            },
            submit = $('#submit');

    submit.attr('disabled', true);

    if (userData.name.length < 2 || userData.name.length > 50) {
        validate = true;
        name.next().text('* אנא כתוב 2-50 תווים');
        name.addClass('contact-error');
    }

    if (!emailRegexp.test(userData.email)) {
        validate = true;
        email.next().text('* אנא כתוב אימייל תקני');
        email.addClass('contact-error');
    }

    if (!phoneRegexp.test(userData.phone)) {
        validate = true;
        phone.next().text('* אנא כתוב מספר טלפון תקני');
        phone.addClass('contact-error');
    }



    if (validate) {
        submit.attr('disabled', false);
    } else {
        $.ajax({
            type: 'POST',
            url: 'assets/contact_form.php',
            dataType: 'html',
            data: userData,
            success: function (res) {
               
                if (res == 1) {
                    window.location = 'tnx.html';
                } else {
                    submit.next().text('* התרחשה שגיאה, אנא נסה מאוחר יותר');
                }
            }

        });
    }

});