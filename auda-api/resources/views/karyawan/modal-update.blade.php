<!-- Modal -->

<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formData_edit" enctype="multipart/form-data" method="post">
                    <input type="hidden" id="post_id">
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Karyawan</label>
                        <input type="text" class="form-control" id="nama_karyawan-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama_karyawan-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Posisi</label>
                        <input type="text" class="form-control" id="posisi-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-posisi-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat-edit"></div>
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
        url: '{{url('api/karyawans')}}/'+post_id,
        type: "GET",
        cache: false,
        success:function(response){
            //fill data to form
            $('#post_id').val(response.data.id);
            $('#nama_karyawan-edit').val(response.data.nama_karyawan);
            $('#posisi-edit').val(response.data.posisi);
            $('#alamat-edit').val(response.data.alamat);
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
    form.append("nama_karyawan",$('#nama_karyawan-edit').val());
    form.append("posisi",$('#posisi-edit').val());
    form.append("alamat",$('#alamat-edit').val());
    form.append("_method", "PUT");
    
    //ajax
    $.ajax({
        url: '{{url('api/karyawans')}}/'+post_id,
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
            let karyawan = `
            <tr id="index_${response.data.id}">
                <td>${response.data.nama_karyawan}</td>
                <td>${response.data.posisi}</td>
                <td>${response.data.alamat}</td>
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
            if(error.responseJSON.nama_karyawan[0]) {
                
                //show alert
                $('#alert-nama_karyawan-edit').removeClass('d-none');
                $('#alert-nama_karyawan-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-nama_karyawan-edit').html(error.responseJSON.nama_karyawan[0]);
            }
            if(error.responseJSON.posisi[0]) {
                
                //show alert
                $('#alert-posisi-edit').removeClass('d-none');
                $('#alert-posisi-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-posisi-edit').html(error.responseJSON.posisi[0]);
            }
            if(error.responseJSON.alamat[0]) {
                
                //show alert
                $('#alert-alamat-edit').removeClass('d-none');
                $('#alert-alamat-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-alamat-edit').html(error.responseJSON.alamat[0]);
            }
        }
    });
});
</script>