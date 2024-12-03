<!-- Modal -->

<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH KONSUMEN</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    <div class="form-group">

                        <label for="name" class="control-label">Nama Konsumen</label>

                        <input type="text" class="form-control" id="nama_konsumen" name="nama_konsumen">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                    </div>

                    <div class="form-group">

                        <label for="name" class="control-label">Alamat Konsumen</label>

                        <input type="text" class="form-control" id="alamat_konsumen" name="alamat_konsumen">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                    </div>

                    <div class="form-group">

                        <label for="name" class="control-label">No Hp Konsumen</label>

                        <input type="text" class="form-control" id="no_hp_konsumen" name="no_hp_konsumen">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                        <button type="submit" class="btn btn-primary" id="store">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
//button create post event
$('body').on('click', '#btn-create-post', function () {
    //open modal
    $('#modal-create').modal('show');
});

//action create post
$('#store').click(function(e) {
    e.preventDefault();
    e.stopPropagation();
    var data = new
    FormData(document.getElementById("formData"));
    data.append("nama_konsumen", $('#nama_konsumen').val());
    data.append("alamat_konsumen",$('#alamat_konsumen').val());
    data.append("no_hp_konsumen", $('#no_hp_konsumen').val());

    
    //ajax
    $.ajax({
        url: '{{url('api/konsumens')}}',
        type: "POST",
        data: data,
        cache: false,
        dataType: 'json',
        processData: false,
        contentType: false,
        timeout: 0,
        mimeType: "multipart/form-data",

        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

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
            let konsumen = `<tr id="index_${response.data.id}">
                            <td>${response.data.title}</td>
                            <td>${response.data.content}</td>
                           

                            <td class="text-center">

                                <a href="javascript:void(0)" id="btn-
                                edit-post" data-id="${response.data.id}" class="btn btn-primary btn-
                                sm">EDIT</a>

                                
                            </td>
                        </tr>`;

            //append to table
            $('#table-konsumens').prepend(konsumen);
            //clear form
            $('#nama_konsumen').val('');
            $('#alamat_konsumen').val('');
            $('#no_hp_konsumen').val('');
            
            //close modal
            $('#modal-create').modal('hide');

        },
        error:function(error){
            console.log(error.responseText)
            if(error.responseJSON.title[0]) {
                //show alert
                $('#alert-title').removeClass('d-none');
                $('#alert-title').addClass('d-block');
                //add message to alert

                $('#alert-title').html(error.responseJSON.title[0]);

            }
            
            if(error.responseJSON.content[0]) {
                //show alert
                $('#alert-content').removeClass('d-none');
                $('#alert-content').addClass('d-block');
                //add message to alert

                $('#alert-content').html(error.responseJSON.content[0]);

            }
        }

    });
});
</script>