document.addEventListener("DOMContentLoaded", () => {
    const $boton = document.querySelector("#btnCrearPdf");
    const $tabla = document.querySelector("#boletinInformativo")
    $boton.addEventListener("click", () => {
        const $elementoParaConvertir = $tabla;
        html2pdf()
            .set({
                margin: 1,
                filename: 'boletin.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 3, 
                    letterRendering: true,
                },
                jsPDF: {
                    unit: "in",
                    format: "a4",
                    orientation: 'portrait'
                }
            })
            .from($elementoParaConvertir)
            .save()
            .catch(err => console.log(err));
    });
});