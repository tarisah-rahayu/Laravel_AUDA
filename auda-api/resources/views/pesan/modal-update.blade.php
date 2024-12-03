<!-- Modal -->

<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formData_edit" enctype="multipart/form-data" method="post">
                    <input type="hidden" id="post_id">
                    <div class="form-group">
                        <label for="name" class="control-label">Satuan Pesanan</label>
                        <input type="text" class="form-control" id="satuan_pesanan-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-satuan_pesanan-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Status Pesanan</label>
                        <input type="text" class="form-control" id="status_pesanan-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-status_pesanan-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Tanggal Pesanan</label>
                        <input type="text" class="form-control" id="tanggal_pesan-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tanggal_pesan-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Tanggal Terima</label>
                        <input type="text" class="form-control" id="tanggal_terima-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tanggal_terima-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Supplier</label>
                        <input type="text" class="form-control" id="id_supplier-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-id_supplier-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Karyawan</label>
                        <input type="text" class="form-control" id="id_karyawan-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-id_karyawan-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Barang</label>
                        <input type="text" class="form-control" id="id_barang-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-id_barang-edit"></div>
                    </div>
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                    <button type="submit" class="btn btn-primary" id="update">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>

//button create post event
$('body').on('click', '#btn-edit-post', function () {
    let post_id = $(this).data('id');

    //fetch detail post with ajax
    $.ajax({
        url: '{{url('api/pesans')}}/'+post_id,
        type: "GET",
        cache: false,
        success:function(response){
            //fill data to form
            $('#post_id').val(response.data.id);
            $('#satuan_pesanan-edit').val(response.data.satuan_pesanan);
            $('#status_pesanan-edit').val(response.data.status_pesanan);
            $('#tanggal_pesan-edit').val(response.data.tanggal_pesan);
            $('#tanggal_terima-edit').val(response.data.tanggal_terima);
            $('#id_supplier-edit').val(response.data.id_supplier);
            $('#id_karyawan-edit').val(response.data.id_karyawan);
            $('#id_barang-edit').val(response.data.id_barang);
        //open modal
        $('#modal-edit').modal('show');
    }
});
});
//action update post
$('#update').click(function(e) {
    e.preventDefault();
    e.stopPropagation();
    let post_id=$('#post_id').val()
    var form = new FormData();
    form.append("satuan_pesanan",$('#satuan_pesanan-edit').val());
    form.append("status_pesanan",$('#status_pesanan-edit').val());
    form.append("tanggal_pesan",$('#tanggal_pesan-edit').val());
    form.append("tanggal_terima",$('#tanggal_terima-edit').val());
    form.append("id_supplier",$('#id_supplier-edit').val());
    form.append("id_karyawan",$('#id_karyawan-edit').val());
    form.append("id_barang",$('#id_barang-edit').val());
    form.append("_method", "PUT");
    
    //ajax
    $.ajax({
        url: '{{url('api/pesans')}}/'+post_id,
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
            
            //data post
            let pesan = `
            <tr id="index_${response.data.id}">
                <td>${response.data.satuan_pesanan}</td>
                <td>${response.data.status_pesanan}</td>
                <td>${response.data.tanggal_pesan}</td>
                <td>${response.data.tanggal_terima}</td>
                <td>${response.data.id_supplier}</td>
                <td>${response.data.id_karyawan}</td>
                <td>${response.data.id_barang}</td>
                <td class="text-left">
                <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                </td>
            </tr>
            `;
            
            //append to post data
            $(`#index_${response.data.id}`).replaceWith(post);
            
            //close modal
            $('#modal-edit').modal('hide');
        },
        error:function(error){
            console.log(error)
            if(error.responseJSON.satuan_pesanan[0]) {
                
                //show alert
                $('#alert-satuan_pesanan-edit').removeClass('d-none');
                $('#alert-satuan_pesanan-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-satuan_pesanan-edit').html(error.responseJSON.satuan_pesanan[0]);
            }
            if(error.responseJSON.status_pesanan[0]) {
                
                //show alert
                $('#alert-status_pesanan-edit').removeClass('d-none');
                $('#alert-status_pesanan-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-status_pesanan-edit').html(error.responseJSON.status_pesanan[0]);
            }
            if(error.responseJSON.tanggal_pesan[0]) {
                
                //show alert
                $('#alert-tanggal_pesan-edit').removeClass('d-none');
                $('#alert-tanggal_pesan-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-tanggal_pesan-edit').html(error.responseJSON.tanggal_pesan[0]);
            }
            if(error.responseJSON.tanggal_terima[0]) {
                
                //show alert
                $('#alert-tanggal_terima-edit').removeClass('d-none');
                $('#alert-tanggal_terima-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-tanggal_terima-edit').html(error.responseJSON.tanggal_terima[0]);
            }
            if(error.responseJSON.id_supplier[0]) {
                
                //show alert
                $('#alert-id_supplier-edit').removeClass('d-none');
                $('#alert-id_supplier-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-id_supplier-edit').html(error.responseJSON.id_supplier[0]);
            }
        }
    });
});
</script>