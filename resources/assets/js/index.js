import IMask from 'imask';
document.addEventListener("DOMContentLoaded", function(event) {
    console.log("DOM fully loaded and parsed");

    const ui = {
        serviceAccountNumber: document.getElementById('service_account_number')
    }

    if (ui.serviceAccountNumber) {
        const mask = new IMask(ui.serviceAccountNumber, {
            mask: '3-000-0000-00'
        });
    }

});
