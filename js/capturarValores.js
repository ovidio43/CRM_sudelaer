function capturarValorEmail() {
    var miEmail;
//    miEmail = document.validar_form.email_address.value;
    miEmail = document.getElementById('email_address').value;
//    document.getElementById('myEmailLink').href = '../app/views/Validations/emailVerify/emailVerify.php?email=' + miEmail + '&TB_iframe=true&height=80&width=400'
if (miEmail == '') {
        miEmail = 'none';
    }
    document.getElementById('myEmailLink').href = '/crm/real-email-validation/' + miEmail + '?TB_iframe=true&height=80&width=400'
}
function capturarValorPhone() {
    var miPhone;
//    miPhone = document.validar_form2.phone_number.value;
    miPhone = document.getElementById('mobile').value;
//    document.getElementById('myPhoneLink').href = '../app/views/Validations/openCnam/reversePhone.php?phone=' + miPhone + '&TB_iframe=true&height=80&width=400';
    if (miPhone == '') {
        miPhone = '0000000000';
    }
    document.getElementById('myPhoneLink').href = '/crm/real-phone-validation/' + miPhone + '?TB_iframe=true&height=80&width=400';
}