<!-- Modal -->

<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT BARANG</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formData_edit" enctype="multipart/form-data" method="post">
                    <input type="hidden" id="post_id">
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama_barang-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Harga Barang</label>
                        <input type="text" class="form-control" id="harga_barang-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-harga_barang-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Jumlah Stok</label>
                        <input type="text" class="form-control" id="jml_stok-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jml_stok-edit"></div>
                    </div>
                    <div class="form-group">

                        <label for="name" class="control-label">Gambar</label>

                        <input type="file" class="form-control" id="gambar-edit">
                        <img id="image" width="50" height="50">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-gambar-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Status Stok Barang</label>
                        <input type="text" class="form-control" id="status_stok_barang-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-status_stok_barang-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Satuan Barang</label>
                        <input type="text" class="form-control" id="satuan-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-satuan-edit"></div>
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
        url: '{{url('api/barangs')}}/'+post_id,
        type: "GET",
        cache: false,
        success:function(response){
            //fill data to form
            $('#post_id').val(response.data.id);
            $('#nama_barang-edit').val(response.data.nama_barang);
            $('#harga_barang-edit').val(response.data.harga_barang);
            $('#jml_stok-edit').val(response.data.jml_stok);
            $('#gambar').attr("src","{{ url('storage/posts') }}"+"/"+response.data.gambar);
            $('#status_stok_barang-edit').val(response.data.status_stok_barang);
            $('#satuan-edit').val(response.data.satuan);
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
    form.append("nama_barang",$('#nama_barang-edit').val());
    form.append("harga_barang",$('#harga_barang-edit').val());
    form.append("jml_stok",$('#jml_stok-edit').val());
    form.append("gambar", $('input[id="gambar"]')[0].files[0]);
    form.append("status_stok_barang",$('#status_stok_barang-edit').val());
    form.append("satuan",$('#satuan-edit').val());
    form.append("_method", "PUT");
    
    //ajax
    $.ajax({
        url: '{{url('api/barangs')}}/'+post_id,
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
            let post = `
            <tr id="index_${response.data.id}">
                <td>${response.data.nama_barang}</td>
                <td>${response.data.harga_barang}</td>
                <td>${response.data.jml_stok}</td>
                <td>
                    <img src="{{ url('storage/posts') }}${"/"+response.data.gambar}" width=50 height=50>
                </td>
                <td>${response.data.status_stok_barang}</td>
                <td>${response.data.satuan}</td>
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
            if(error.responseJSON.nama_barang[0]) {
                
                //show alert
                $('#alert-nama_barang-edit').removeClass('d-none');
                $('#alert-nama_barang-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-nama_barang-edit').html(error.responseJSON.nama_barang[0]);
            }
            if(error.responseJSON.harga_barang[0]) {
                
                //show alert
                $('#alert-harga_barang-edit').removeClass('d-none');
                $('#alert-harga_barang-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-harga_barang-edit').html(error.responseJSON.harga_barang[0]);
            }
            if(error.responseJSON.jml_stok[0]) {
                
                //show alert
                $('#alert-jml_stok-edit').removeClass('d-none');
                $('#alert-jml_stok-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-jml_stok-edit').html(error.responseJSON.jml_stok[0]);
            }
            if(error.responseJSON.gambar[0]) {
                
                //show alert
                $('#alert-gambar-edit').removeClass('d-none');
                $('#alert-gambar-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-gambar-edit').html(error.responseJSON.gambar[0]);
            }
            if(error.responseJSON.status_stok_barang[0]) {
                
                //show alert
                $('#alert-status_stok_barang-edit').removeClass('d-none');
                $('#alert-status_stok_barang-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-status_stok_barang-edit').html(error.responseJSON.status_stok_barang[0]);
            }
            if(error.responseJSON.satuan[0]) {
                
                //show alert
                $('#alert-satuan-edit').removeClass('d-none');
                $('#alert-satuan-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-satuan-edit').html(error.responseJSON.satuan[0]);
            }
        }
    });
});
</script>