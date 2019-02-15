//SwalAlert2 confirm submit form
$(".swa-confirm").on("click", function(e) {
    e.preventDefault();
    var form = $(this).parents('form');
    Swal.fire({
        title: form.attr("swa-title"),
        html: form.attr("swa-text"),
        type: form.attr("swa-type"),
        showCancelButton: true,
        confirmButtonColor: form.attr("swa-color"),
        cancelButtonColor: '#3085d6',
        confirmButtonText: $(this).html(),
        cancelButtonText: 'Annuler'
    }).then(function (result) {
        if (result.value) {
            form.submit();
        }
    });
});