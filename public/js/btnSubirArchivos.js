document.addEventListener('DOMContentLoaded', function() {
    const pCategoriaSg = document.getElementById('caSeguridad');
    const imageUploadGroup = document.getElementById('imageUploadGroup');

    pCategoriaSg.addEventListener('change', function() {
        const selectedValue = pCategoriaSg.value;

        if (selectedValue === '0') {

            imageUploadGroup.classList.add('hidden');
        } else {
            imageUploadGroup.classList.remove('hidden');
        }


    });
    pCategoriaSg.dispatchEvent(new Event('change'));
});