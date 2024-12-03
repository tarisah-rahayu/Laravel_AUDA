<!-- Modal -->

<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH PESANAN</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    
                    <div class="form-group">

                        <label for="name" class="control-label">Satuan Pesanan</label>

                        <input type="text" class="form-control" id="satuan_pesanan" name="satuan_pesanan">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                    </div>
                    <div class="form-group">

                        <label for="name" class="control-label">Status Pesanan</label>

                        <input type="text" class="form-control" id="status_pesanan" name="status_pesanan">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                    </div>
                    <div class="form-group">

                        <label for="name" class="control-label">Tanggal Pesan</label>

                        <input type="text" class="form-control" id="tanggal_pesan" name="tanggal_pesan">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                    </div>
                    <div class="form-group">

                        <label for="name" class="control-label">Tanggal Terima</label>

                        <input type="text" class="form-control" id="tanggal_terima" name="tanggal_terima">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                    </div>
                    <div class="form-group">

                        <label for="name" class="control-label">Supplier</label>

                        <input type="text" class="form-control" id="id_supplier" name="id_supplier">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                    </div>

                    <div class="form-group">

                        <label for="name" class="control-label">Karyawan</label>

                        <input type="text" class="form-control" id="id_karyawan" name="id_karyawan">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                    </div>

                    <div class="form-group">

                        <label for="name" class="control-label">Barang</label>

                        <input type="text" class="form-control" id="id_barang" name="id_barang">
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
    data.append("satuan_pesanan", $('#satuan_pesanan').val());
    data.append("status_pesanan", $('#status_pesanan').val());
    data.append("tanggal_pesan", $('#tanggal_pesan').val());
    data.append("tanggal_terima", $('#tanggal_terima').val());
    data.append("id_supplier", $('#id_supplier').val());
    data.append("id_karyawan",$('#id_karyawan').val());
    data.append("id_barang", $('#id_barang').val());
    
    //ajax
    $.ajax({
        url: '{{url('api/pesans')}}',
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
            let pesan = `<tr id="index_${response.data.id}">
                            <td>${response.data.title}</td>
                            <td>${response.data.content}</td>
                            

                            <td class="text-center">

                                <a href="javascript:void(0)" id="btn-
                                edit-post" data-id="${response.data.id}" class="btn btn-primary btn-
                                sm">EDIT</a>

                                
                            </td>
                        </tr>`;

            //append to table
            $('#table-pesans').prepend(pesan);
            //clear form
            $('#satuan_pesanan').val('');
            $('#status_pesanan').val('');
            $('#tanggal_pesan').val('');
            $('#tanggal_terima').val('');
            $('#id_supplier').val('');
            $('#id_karyawan').val('');
            $('#id_barang').val('');
            
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