<!-- Modal -->

<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formData_edit" enctype="multipart/form-data" method="post">
                    <input type="hidden" id="post_id">
                    <div class="form-group">
                        <label for="name" class="control-label">Alamat Penerima</label>
                        <input type="text" class="form-control" id="alamat_penerima-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat_penerima-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Tanggal Jual</label>
                        <input type="text" class="form-control" id="tgl_jual-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tgl_jual-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Tanggal Kirim</label>
                        <input type="text" class="form-control" id="tgl_kirim-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tgl_kirim-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Quantity</label>
                        <input type="text" class="form-control" id="qty-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-qty-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Satuan</label>
                        <input type="text" class="form-control" id="satuan-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-satuan-edit"></div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="control-label">Status</label>
                        <input type="text" class="form-control" id="status-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-status-edit"></div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="control-label">Id Barang</label>
                        <input type="text" class="form-control" id="id_barang-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-id_barang-edit"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="name" class="control-label">Id Konsumen</label>
                        <input type="text" class="form-control" id="id_konsumen-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-id_konsumen-edit"></div>
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
        url: '{{url('api/juals')}}/'+post_id,
        type: "GET",
        cache: false,
        success:function(response){
            //fill data to form
            $('#post_id').val(response.data.id);
            $('#alamat_penerima-edit').val(response.data.alamat_penerima);
            $('#tgl_jual-edit').val(response.data.tgl_jual);
            $('#tgl_kirim-edit').val(response.data.tgl_kirim);
            $('#qty-edit').val(response.data.qty);
            $('#satuan-edit').val(response.data.satuan);
            $('#status-edit').val(response.data.status);
            $('#id_barang-edit').val(response.data.id_barang);
            $('#id_konsumen-edit').val(response.data.id_konsumen);
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
    form.append("alamat_penerima",$('#alamat_penerima-edit').val());
    form.append("tgl_jual",$('#tgl_jual-edit').val());
    form.append("tgl_kirim",$('#tgl_kirim-edit').val());
    form.append("qty",$('#qty-edit').val());
    form.append("satuan",$('#satuan-edit').val());
    form.append("status",$('#status-edit').val());
    form.append("id_barang",$('#id_barang-edit').val());
    form.append("id_konsumen",$('#id_konsumen-edit').val());
    form.append("_method", "PUT");
    
    //ajax
    $.ajax({
        url: '{{url('api/juals')}}/'+post_id,
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
            let jual = `
            <tr id="index_${response.data.id}">
                <td>${response.data.alamat_penerima}</td>
                <td>${response.data.tgl_jual}</td>
                <td>${response.data.tgl_kirim}</td>
                <td>${response.data.qty}</td>
                <td>${response.data.satuan}</td>
                <td>${response.data.status}</td>
                <td>${response.data.id_barang}</td>
                <td>${response.data.id_konsumen}</td>
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
            if(error.responseJSON.alamat_penerima[0]) {
                
                //show alert
                $('#alert-alamat_penerima-edit').removeClass('d-none');
                $('#alert-alamat_penerima-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-alamat_penerima-edit').html(error.responseJSON.alamat_penerima[0]);
            }
            if(error.responseJSON.tgl_jual[0]) {
                
                //show alert
                $('#alert-tgl_jual-edit').removeClass('d-none');
                $('#alert-tgl_jual-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-tgl_jual-edit').html(error.responseJSON.tgl_jual[0]);
            }
            if(error.responseJSON.tgl_kirim[0]) {
                
                //show alert
                $('#alert-tgl_kirim-edit').removeClass('d-none');
                $('#alert-tgl_kirim-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-tgl_kirim-edit').html(error.responseJSON.tgl_kirim[0]);
            }
            if(error.responseJSON.qty[0]) {
                
                //show alert
                $('#alert-qty-edit').removeClass('d-none');
                $('#alert-qty-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-qty-edit').html(error.responseJSON.qty[0]);
            }
            if(error.responseJSON.satuan[0]) {
                
                //show alert
                $('#alert-satuan-edit').removeClass('d-none');
                $('#alert-satuan-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-satuan-edit').html(error.responseJSON.satuan[0]);
            }
            if(error.responseJSON.status[0]) {
                
                //show alert
                $('#alert-status-edit').removeClass('d-none');
                $('#alert-status-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-status-edit').html(error.responseJSON.status[0]);
            }
            if(error.responseJSON.id_barang[0]) {
                
                //show alert
                $('#alert-id_barang-edit').removeClass('d-none');
                $('#alert-id_barang-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-id_barang-edit').html(error.responseJSON.id_barang[0]);
            }
            if(error.responseJSON.id_konsumen[0]) {
                
                //show alert
                $('#alert-id_konsumen-edit').removeClass('d-none');
                $('#alert-id_konsumen-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-id_konsumen-edit').html(error.responseJSON.id_konsumen[0]);
            }
        }
    });
});
</script>