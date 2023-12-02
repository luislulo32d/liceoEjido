document.addEventListener('DOMContentLoaded',function(){
    tablenotascertificadas =  $('#tablenotascertificadas').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "dom": "lBfrtip",
        
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0,"asc"]]
        
    });
})
