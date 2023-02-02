import Dropzone from "dropzone";

Dropzone.autoDiscover = false; //Busca un elemento que tenga la clase de dropzone, para este caso deshabilitamos esta busqueda

const dropzone = new Dropzone("#dropzone", {
    //Recibe el selector
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Archivo",
    maxFiles: 1,
    uploadMultiple: false,

    //Recuperar la imagen en caso de error en la validación
    init: function(){
        if(document.querySelector('[name="imagen"]').value.trim()){ //En caso de que haya algo en el input
            const imagenPublicada = {}
            imagenPublicada.size = 1234; //Es un valor requerido por lo tanto el valor puede ser cualquiera
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});

//Cuando se envia
dropzone.on("success", function (file, response) {
    document.querySelector('[name="imagen"]').value = response.imagen;
});

//Si se quita el archivo
dropzone.on("removedfile", function () {
    document.querySelector('[name="imagen"]').value = "";
});

