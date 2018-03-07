import IMask from 'imask';
document.addEventListener("DOMContentLoaded", function(event) {
    console.log("DOM fully loaded and parsed");

    const ui = {
        serviceAccountNumber: document.getElementById('service_account_number'),
        phoneNumber: document.getElementById('phone'),
        zipCode: document.getElementById('zip_code')
    }

    if (ui.serviceAccountNumber) {
        const mask = new IMask(ui.serviceAccountNumber, {
            mask: '000-0000-00'
        });
    }
    if (ui.phoneNumber) {
        const mask = new IMask(ui.phoneNumber, {
            mask: '(000)-000-0000'
        });
    }
    if (ui.zipCode) {
        const mask = new IMask(ui.zipCode, {
            mask: '00000'
        });
    }

});
