<!-- Modal -->

<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT KONSUMEN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
            </div>

            <div class="modal-body">
                <form id="formData_edit" enctype="multipart/form-data" method="post">
                    <input type="hidden" id="post_id">
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Konsumen</label>
                        <input type="text" class="form-control" id="nama_konsumen-edit" rows="4" name="nama_konsumen"></textarea>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama_konsumen-edit"></div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="control-label">Alamat Konsumen</label>
                        <input type="text" class="form-control" id="alamat_konsumen-edit" rows="4" name="alamat_konsumen"></textarea>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat_konsumen-edit"></div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="control-label">Nomor Handphone</label>
                        <input type="text" class="form-control" id="no_hp_konsumen-edit" rows="4" name="no_hp_konsumen"></textarea>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-no_hp_konsumen-edit"></div>
                    </div>

                  
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="submit" class="btn btn-primary" id="update">UPDATE</button>
            </div>
        </div>
    </div>
</div>

<script>
//button create barang event
$('body').on('click', '#btn-edit-konsumen', function () {
    let post_id = $(this).data('id');
    //fetch detail barang with ajax
    $.ajax({
        url: '{{url('api/konsumens')}}/'+post_id,
        type: "GET",
        cache: false,
        success:function(response){
            //fill data to form
            $('#post_id').val(response.data.id);
            $('#nama_konsumen-edit').val(response.data.nama_konsumen);
            $('#alamat_konsumen-edit').val(response.data.alamat_konsumen);
            $('#no_hp_konsumen-edit').val(response.data.no_hp_konsumen);
            //open modal
            $('#modal-edit').modal('show');
        }
    });
});

//action update barang
$('#update').click(function(e) {
    e.preventDefault();
    e.stopPropagation();
    let post_id=$('#post_id').val()
    var form = new FormData();
    form.append("nama_konsumen",$('#nama_konsumen-edit').val());
    form.append("alamat_konsumen",$('#alamat_konsumen-edit').val());
    form.append("no_hp_konsumen",$('#no_hp_konsumen-edit').val());
    form.append("_method", "PUT");
    //ajax
    $.ajax({
        url: '{{url('api/konsumens')}}/'+post_id,
        type: "POST",
        data: form,
        cache: false,
        dataType: 'json',
        processData: false,
        contentType: false,
        timeout: 0,
        mimeType: "multipart/form-data",
        success:function(response){
            //show success message
            Swal.fire({
                type: 'success',
                icon: 'success',
                title: `${response.message}`,
                showConfirmButton: false,
                timer: 3000
            });
            //data barang
            let konsumen = `
                <tr id="index_${response.data.id}">
                    <td>${response.data.nama_konsumen}</td>
                    <td>${response.data.alamat_konsumen}</td>
                    <td>${response.data.no_hp_konsumen}</td>
                    
                    <td>
                   
                    <td class="text-center">

                        <a href="javascript:void(0)" id="btn-edit-konsumen" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>

                        <a href="javascript:void(0)" id="btn-delete-konsumen" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                    </td>
                </tr>`;
            //append to barang data
            $(`#index_${response.data.id}`).replaceWith(konsumen);
            //close modal
            $('#modal-edit').modal('hide');
        },
        error:function(error){
            console.log(error)
            if(error.responseJSON.nama_konsumen[0]) {
                //show alert
                $('#alert-nama_konsumen-edit').removeClass('d-none');
                $('#alert-nama_konsumen-edit').addClass('d-block');
                //add message to alert
                $('#alert-nama_konsumen-edit').html(error.responseJSON.nama_konsumen[0]);
            }
            if(error.responseJSON.alamat_konsumen[0]) {
                //show alert
                $('#alert-alamat_konsumen-edit').removeClass('d-none');
                $('#alert-alamat_konsumen-edit').addClass('d-block');
                //add message to alert

                $('#alert-alamat_konsumen-edit').html(error.responseJSON.alamat_konsumen[0]);
            }
            if(error.responseJSON.Stok[0]) {
                
                //show alert
                $('#alert-no_hp_konsumen-edit').removeClass('d-none');
                $('#alert-no_hp_konsumen-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-no_hp_konsumen-edit').html(error.responseJSON.no_hp_konsumen[0]);
            }
            
        }
    });
});
</script>