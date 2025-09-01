console.log('____extension');
apiHeaders['headers']['Authorization'] = 'Bearer '+$("meta[name='tapi']").attr("content");
console.log(apiHeaders);

$(function(){
    $("#btn-submit-add").on('click', function(e) {
      const form = document.getElementById('form-add');
      form.reportValidity()
      if (!form.checkValidity()) {
      } else if($('[name="check_validity"]').val() == 0){
        Swal.fire({
          position: 'top-end',
          icon: 'warning',
          html: 'Masih ada isian yang belum valid, mohon diperbaiki',
          showConfirmButton: false,
          timer: 2000
        });
      } else {
        $('#loading').show();
        $('#form').hide();
        const formData = new FormData(form);
        // for (const [key, value] of formData) {
        //   console.log('»', key, value)
        // }; return;
        axios.post(baseUrl+'/api/role', formData, apiHeaders)
        .then(function (response) {
          console.log('response..',response);
          if(response.status == 200 && response.data.status) {
            Swal.fire({
              icon: 'success',
              width: 600,
              title: "Berhasil",
              // html: "...",
              confirmButtonText: 'Ya, terima kasih',
            });
            // window.location = baseUrl+'/role';
          }else{
            Swal.fire({
              icon: 'warning',
              width: 600,
              title: "Gagal",
              html: response.data.message,
              confirmButtonText: 'Ya',
            });
          }
          $('#loading').hide();
          $('#form').show();
        })
        .catch(function (error) {
          Swal.fire({
            icon: 'error',
            width: 600,
            title: "Error",
            html: error.message,
            confirmButtonText: 'Ya',
          });
          $('#loading').hide();
          $('#form').show();
        });
      }
    });
  
    $("#btn-submit-edit").on('click', function(e) {
      const form = document.getElementById('form-edit');
      form.reportValidity()
      if (!form.checkValidity()) {
      } else if($('[name="check_validity"]').val() == 0){
        Swal.fire({
          position: 'top-end',
          icon: 'warning',
          html: 'Masih ada isian yang belum valid, mohon diperbaiki',
          showConfirmButton: false,
          timer: 2000
        });
      } else {
        $('#loading').show();
        $('#form').hide();
        const formData = new FormData(form);
        // console.log(formData.get('id')); return;
        // for (const [key, value] of formData) {
        //   console.log('»', key, value)
        // }; return;
        axios.post(baseUrl+'/api/role/'+$('#item-id').val(), formData, apiHeaders)
        .then(function (response) {
          console.log('response..',response);
          if(response.status == 200 && response.data.status) {
            Swal.fire({
              icon: 'success',
              width: 600,
              title: "Berhasil",
              // html: "...",
              confirmButtonText: 'Ya, terima kasih',
            });
            window.location = baseUrl+'/role';
          }else{
            Swal.fire({
              icon: 'warning',
              width: 600,
              title: "Gagal",
              html: response.data.message,
              confirmButtonText: 'Ya',
            });
          }
          $('#loading').hide();
          $('#form').show();
        })
        .catch(function (error) {
          Swal.fire({
            icon: 'error',
            width: 600,
            title: "Error",
            html: error,
            confirmButtonText: 'Ya',
          });
          $('#loading').hide();
          $('#form').show();
        });
      }
    });
  
  });
  