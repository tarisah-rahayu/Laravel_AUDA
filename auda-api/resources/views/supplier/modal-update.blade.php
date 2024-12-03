<!-- Modal -->

<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formData_edit" enctype="multipart/form-data" method="post">
                    <input type="hidden" id="post_id">
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Supplier</label>
                        <input type="text" class="form-control" id="nama_supplier-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama_supplier-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Jenis Supplier</label>
                        <input type="text" class="form-control" id="jenis_supplier-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jenis_supplier-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Alamat Supplier</label>
                        <input type="text" class="form-control" id="alamat_supplier-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat_supplier-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">No Hp Supplier</label>
                        <input type="text" class="form-control" id="no_hp_supplier-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-no_hp_supplier-edit"></div>
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
        url: '{{url('api/supliers')}}/'+post_id,
        type: "GET",
        cache: false,
        success:function(response){
            //fill data to form
            $('#post_id').val(response.data.id);
            $('#nama_supplier-edit').val(response.data.nama_supplier);
            $('#jenis_supplier-edit').val(response.data.jenis_supplier);
            $('#alamat_supplier-edit').val(response.data.alamat_supplier);
            $('#no_hp_supplier-edit').val(response.data.no_hp_supplier);
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
    form.append("nama_supplier",$('#nama_supplier-edit').val());
    form.append("jenis_supplier",$('#jenis_supplier-edit').val());
    form.append("alamat_supplier",$('#alamat_supplier-edit').val());
    form.append("no_hp_supplier",$('#no_hp_supplier-edit').val());
    form.append("_method", "PUT");
    
    //ajax
    $.ajax({
        url: '{{url('api/supliers')}}/'+post_id,
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
            let supliers = `
            <tr id="index_${response.data.id}">
                <td>${response.data.nama_supplier}</td>
                <td>${response.data.jenis_supplier}</td>
                <td>${response.data.alamat_supplier}</td>
                <td>${response.data.no_hp_supplier}</td>
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
            if(error.responseJSON.nama_supplier[0]) {
                
                //show alert
                $('#alert-nama_supplier-edit').removeClass('d-none');
                $('#alert-nama_supplier-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-nama_supplier-edit').html(error.responseJSON.nama_supplier[0]);
            }
            if(error.responseJSON.jenis_supplier[0]) {
                
                //show alert
                $('#alert-jenis_supplier-edit').removeClass('d-none');
                $('#alert-jenis_supplier-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-jenis_supplier-edit').html(error.responseJSON.jenis_supplier[0]);
            }
            if(error.responseJSON.alamat_supplier[0]) {
                
                //show alert
                $('#alert-alamat_supplier-edit').removeClass('d-none');
                $('#alert-alamat_supplier-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-alamat_supplier-edit').html(error.responseJSON.alamat_supplier[0]);
            }
            if(error.responseJSON.no_hp_supplier[0]) {
                
                //show alert
                $('#alert-no_hp_supplier-edit').removeClass('d-none');
                $('#alert-no_hp_supplier-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-no_hp_supplier-edit').html(error.responseJSON.no_hp_supplier[0]);
            }
        }
    });
});
</script>