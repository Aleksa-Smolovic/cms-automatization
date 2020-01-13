$(".submitForm").submit(function(event){
    event.preventDefault();
    $(".submitFormBtn").attr("disabled", true);
    $(".formSpinner").show();
    var formData = new FormData($(this)[0]);
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        url: route,
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (returndata) {
          $(".formSpinner").hide();
          $(".submitFormBtn").attr("disabled", false);
          if(returndata == 'Done'){
            swal("Poooof!", "Uspješno ste sačuvali podatke!", "success").then((value) => {
              $("form")[0].reset();
              window.location.reload(true); 
            });
          }else{
            swal("Greška!", returndata, "error");
          }
        },
        error: function (returndata) {
          $(".formSpinner").hide();
          $(".submitFormBtn").attr("disabled", false);
			var errors = returndata.responseJSON;
			var deepErrors = errors.errors;
			swal("Greška!", String(deepErrors[Object.keys(deepErrors)[0]]) , "error");
        }
    });
    return false;
});

