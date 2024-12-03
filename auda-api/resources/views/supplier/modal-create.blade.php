<!-- Modal -->

<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH SUPPLIER</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    <div class="form-group">

                        <label for="name" class="control-label">Nama Supplier</label>

                        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                    </div>

                    <div class="form-group">

                        <label for="name" class="control-label">Jenis Supplier</label>

                        <input type="text" class="form-control" id="jenis_supplier" name="jenis_supplier">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                    </div>

                    <div class="form-group">

                        <label for="name" class="control-label">Alamat Supplier</label>

                        <input type="text" class="form-control" id="alamat_supplier" name="alamat_supplier">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                    </div>
                    <div class="form-group">

                        <label for="name" class="control-label">No Hp Supplier</label>

                        <input type="text" class="form-control" id="no_hp_supplier" name="no_hp_supplier">
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
    data.append("nama_supplier", $('#nama_supplier').val());
    data.append("jenis_supplier",$('#jenis_supplier').val());
    data.append("alamat_supplier", $('#alamat_supplier').val());
    data.append("no_hp_supplier", $('#no_hp_supplier').val());

    
    //ajax
    $.ajax({
        url: '{{url('api/suppliers')}}',
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
            let supliers = `<tr id="index_${response.data.id}">
                            <td>${response.data.title}</td>
                            <td>${response.data.content}</td>
                          

                            <td class="text-center">

                                <a href="javascript:void(0)" id="btn-
                                edit-post" data-id="${response.data.id}" class="btn btn-primary btn-
                                sm">EDIT</a>

                              
                            </td>
                        </tr>`;

            //append to table
            $('#table-supliers').prepend(supliers);
            //clear form
            $('#nama_supplier').val('');
            $('#jenis_supplier').val('');
            $('#alamat_supplier').val('');
            $('#no_hp_supplier').val('');

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