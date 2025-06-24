document.addEventListener('DOMContentLoaded', function() {

    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            

            const inputs = form.querySelectorAll('input[required], select[required]');
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('border-red-500');
                    isValid = false;
                } else {
                    input.classList.remove('border-red-500');
                }
            });

            const nipInput = form.querySelector('#nip');
            if (nipInput && !/^\d+$/.test(nipInput.value.trim())) {
                nipInput.classList.add('border-red-500');
                isValid = false;
            }
            
            const umurInput = form.querySelector('#umur');
            if (umurInput && (parseInt(umurInput.value) < 18 || parseInt(umurInput.value) > 65)) {
                umurInput.classList.add('border-red-500');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
                alert('Harap isi semua field dengan benar!');
            }
        });
    });
});