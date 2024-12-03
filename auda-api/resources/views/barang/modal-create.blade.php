<!-- Modal -->

<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH BARANG</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    <div class="form-group">

                        <label for="name" class="control-label">Nama Barang</label>

                        <input type="text" class="form-control" id="nama_barang" name="nama_barang">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                    </div>

                    <div class="form-group">

                        <label for="name" class="control-label">Harga Barang</label>

                        <input type="text" class="form-control" id="harga_barang" name="harga_barang">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                    </div>

                    <div class="form-group">

                        <label for="name" class="control-label">Jumlah Stok</label>

                        <input type="text" class="form-control" id="jml_stok" name="jml_stok">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                    </div>

                    <div class="form-group">

                        <label for="name" class="control-label">Gambar Barang</label>

                        <input type="file" class="form-control" id="gambar" name="gambar">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                    </div>

                    <div class="form-group">

                        <label for="name" class="control-label">Status Stok Barang</label>

                        <input type="text" class="form-control" id="status_stok_barang" name="status_stok_barang">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                    </div>

                  <div class="form-group">

                        <label for="name" class="control-label">Satuan Barang</label>

                        <input type="text" class="form-control" id="satuan" name="satuan">
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
    data.append('gambar', $('input[id="gambar"]')[0].files[0]);
    data.append("nama_barang", $('#nama_barang').val());
    data.append("harga_barang",$('#harga_barang').val());
    data.append("jml_stok", $('#jml_stok').val());
    data.append("status_stok_barang",$('#status_stok_barang').val());
    data.append("satuan", $('#satuan').val());

    
    //ajax
    $.ajax({
        url: '{{url('api/barangs')}}',
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
            let barang = `<tr id="index_${response.data.id}">
                            <td>${response.data.title}</td>
                            <td>${response.data.content}</td>
                            <td>
                                <img src="{{ url('storage/barangs') }}${"/"+response.data.gambar}">
                            </td>

                            <td class="text-center">

                                <a href="javascript:void(0)" id="btn-
                                edit-post" data-id="${response.data.id}" class="btn btn-primary btn-
                                sm">EDIT</a>

                                
                            </td>
                        </tr>`;

            //append to table
            $('#table-barangs').prepend(barang);
            //clear form
            $('#nama_barang').val('');
            $('#harga_barang').val('');
            $('#jml_stok').val('');
            $('#gambar').val('');
            $('#status_stok_barang').val('');
            $('#satuan').val('');
            
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