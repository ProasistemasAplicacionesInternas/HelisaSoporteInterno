var nVersion = document.getElementById('nVersionDiv');
var version = document.getElementById('version');

$('#version').on('change', function() {
    if (this.value == "" || this.value == undefined) {
        nVersion.style.display = 'none';
    } else if (this.value == 'Si') {
        nVersion.style.display = 'inline'
    } else if (this.value == 'No') {
        nVersion.style.display = 'none';

    }
});

$('#version').trigger('change');

