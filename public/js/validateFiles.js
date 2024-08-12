function validateFiles(input) {
    const allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx'];
    const maxFiles = 5;
    const maxSize = 20 * 1024 * 1024;
    const files = input.files;

    if (files.length > maxFiles) {
        alert(`Puedes subir un máximo de ${maxFiles} archivos.`);
        input.value = '';
        return false;
    }

    const fileList = document.getElementById('fileList');
    fileList.innerHTML = '';

    for (let i = 0; i < files.length; i++) {
        const fileExtension = files[i].name.split('.').pop().toLowerCase();
        const fileSize = files[i].size;
        if (!allowedExtensions.includes(fileExtension)) {
            alert('Solo se permiten archivos PDF, Word y Excel.');
            input.value = '';
            return false;
        }
        if (fileSize > maxSize) {
            alert(`El archivo ${files[i].name} excede el tamaño máximo permitido de 20 MB.`);
            input.value = '';
            return false;
        }
    }

    return true;
}