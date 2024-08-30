<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>    
</head>
<body>
    <h1>Ini halaman buku tamu</h1>
    <button type="button" id="btn-add" >Tambah</button>
    {{-- <div class='my-3 col-12 col-sm-8 col-md-6'>
        <form action="/buku_tamu/fetch_data" method="GET">
            <div class="input-group mb-3">
                <input type="text" name="query" class="form-control" placeholder="Search Data" aria-label="Username" aria-describedby="basic-addon1">
                <button class="input-group-text">Search</button>
            </div>    
        </form>
    </div> --}}
    <div class="my-3 col-12 col-sm-8 col-md-6">
        <div class="form-group">
         <input type="text" name="serach" id="serach" class="form-control" />
        </div>
    </div>
    <div id="tabel_tamu">
        @include('buku_tamu_tabel')
    </div> 
    @include('modal.buku_tamu-add')
    @include('modal.buku_tamu-edit')

    <script>
        $(document).ready(function(){
            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var column_name = $('#hidden_column_name').val();
                var query = $('#serach').val();
                $('li').removeClass('active');
                $(this).parent().addClass('active');
                fetch_data(page, sort_type, column_name, query);
                // fetch_data(page);
            });

            function clear_icon(){
                $('#id_icon').html('');
                $('#post_title_icon').html('');
            }

            function fetch_data(page)
            {
                $.ajax({
                    url:"/buku_tamu/fetch_data?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&query="+query,
                    success:function(data)
                    {
                        // $('#tabel_tamu').html(data);
                        $('tbody').html('');
                        $('tbody').html(data);
                    }
                });
            }

            $(document).on('keyup', '#serach', function(){
                var query = $('#serach').val();
                var column_name = $('#hidden_column_name').val();
                var sort_type = $('#hidden_sort_type').val();
                var page = $('#hidden_page').val();
                fetch_data(page, sort_type, column_name, query);
            });

            $(document).on('click', '.sorting', function(){
                var column_name = $(this).data('column_name');
                var order_type = $(this).data('sorting_type');
                var reverse_order = '';
                if(order_type == 'asc'){
                    $(this).data('sorting_type', 'desc');
                    reverse_order = 'desc';
                    clear_icon();
                    $('#'+column_name+'_icon').html('<span class="glyphicon glyphicon-triangle-bottom"></span>');
                }
                if(order_type == 'desc'){
                    $(this).data('sorting_type', 'asc');
                    reverse_order = 'asc';
                    clear_icon();
                    $('#'+column_name+'_icon').html('<span class="glyphicon glyphicon-triangle-top"></span>');
                }
                $('#hidden_column_name').val(column_name);
                $('#hidden_sort_type').val(reverse_order);
                var page = $('#hidden_page').val();
                var query = $('#serach').val();
                fetch_data(page, reverse_order, column_name, query);
            });

            $('body').on('click', '#btn-add', function () {
                $('#buku_tamu-add').modal('show');
            });
            
            $('body').on('click', '#btn-edit', function () {
                var id = $(this).data('id');
                console.log(id);
                $.get('buku_tamu/'+id+'/edit', function (data) {
                    $('#buku_tamu-edit').modal('show');
                    $('#id').val(data.id);
                    $('#nama_tamu_edit').val(data.nama_tamu);
                    $('#no_telepon_edit').val(data.no_telepon);
                    $('#nama_instansi_edit').val(data.nama_instansi);
                    $('#keperluan_edit').val(data.keperluan);
                    $('#bertemu_dengan_edit').val(data.bertemu_dengan);
                    $('#tanggal_bertamu_edit').val(data.tanggal_bertamu);
                    $('#waktu_edit').val(data.waktu);
                })
            });

            $('#store').click(function() {
                var nama_tamu   = $('#nama_tamu').val();
                var no_telepon = $('#no_telepon').val();
                var nama_instansi = $('#nama_instansi').val();
                var keperluan = $('#keperluan').val();
                var bertemu_dengan = $('#bertemu_dengan').val();
                var tanggal_bertamu = $('#tanggal_bertamu').val();
                var waktu = $('#waktu').val();
                var token   = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    url:`/buku_tamu`,
                    type: "POST",
                    cache: false,
                    data: {
                        "nama_tamu": nama_tamu,
                        "no_telepon": no_telepon,
                        "nama_instansi": nama_instansi,
                        "keperluan": keperluan,
                        "bertemu_dengan": bertemu_dengan,
                        "tanggal_bertamu": tanggal_bertamu,
                        "waktu": waktu,
                        "_token": token
                    },
                    success:function(response){
                        Swal.fire({
                            icon: 'success',
                            title: 'Data '+nama_tamu+' Berhasil Ditambahkan',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        $('#buku_tamu-add').modal('hide');
                        fetch_data();
                    },
                    error:function(error){
                        if((error.responseJSON.nama_tamu) || (error.responseJSON.no_telepon) || 
                            (error.responseJSON.nama_instansi) || (error.responseJSON.keperluan) ||
                            (error.responseJSON.bertemu_dengan) || (error.responseJSON.tanggal_bertamu) ||
                            (error.responseJSON.waktu)
                        ) {     
                            $('#alert-error_add').removeClass('d-none');             
                            $('#alert-error_add').addClass('d-block');
                            $('#alert-error_add').html(error.responseJSON.nama_tamu);
                            $('#alert-error_add').html(error.responseJSON.no_telepon);
                            $('#alert-error_add').html(error.responseJSON.nama_instansi);
                            $('#alert-error_add').html(error.responseJSON.keperluan);
                            $('#alert-error_add').html(error.responseJSON.bertemu_dengan);
                            $('#alert-error_add').html(error.responseJSON.tanggal_bertamu);
                            $('#alert-error_add').html(error.responseJSON.waktu);
                            setTimeout(function(){
                                $('#alert-error_add').removeClass('d-block');
                                $('#alert-error_add').addClass('d-none');
                            },3000)
                        }
                    }
                });
            });
            
            $('#update').click(function() {
                var id   = $('#id').val();
                var nama_tamu   = $('#nama_tamu_edit').val();
                var no_telepon = $('#no_telepon_edit').val();
                var nama_instansi = $('#nama_instansi_edit').val();
                var keperluan = $('#keperluan_edit').val();
                var bertemu_dengan = $('#bertemu_dengan_edit').val();
                var tanggal_bertamu = $('#tanggal_bertamu_edit').val();
                var waktu = $('#waktu_edit').val();
                var token   = $("meta[name='csrf-token']").attr("content");
                console.log(id);
                $.ajax({
                    url: `/buku_tamu/${id}`,
                    type: "PUT",
                    cache: false,
                    data: {
                        "id": id,
                        "nama_tamu": nama_tamu,
                        "no_telepon": no_telepon,
                        "nama_instansi": nama_instansi,
                        "keperluan": keperluan,
                        "bertemu_dengan": bertemu_dengan,
                        "tanggal_bertamu": tanggal_bertamu,
                        "waktu": waktu,
                        "_token": token
                    },
                    success:function(data){
                        console.log('success:', data);
                        Swal.fire({
                            icon: 'success',
                            title: 'Data '+nama_tamu+' Berhasil Diubah',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        $('#buku_tamu-edit').modal('hide');
                        fetch_data();
                    },
                    error:function(error){
                        if((error.responseJSON.nama_tamu) || (error.responseJSON.no_telepon) || 
                            (error.responseJSON.nama_instansi) || (error.responseJSON.keperluan) ||
                            (error.responseJSON.bertemu_dengan) || (error.responseJSON.tanggal_bertamu) ||
                            (error.responseJSON.waktu)
                        ) {
                            $('#alert-error_edit').removeClass('d-none');             
                            $('#alert-error_edit').addClass('d-block');
                            $('#alert-error_edit').html(error.responseJSON.nama_tamu);
                            $('#alert-error_edit').html(error.responseJSON.no_telepon);
                            $('#alert-error_edit').html(error.responseJSON.nama_instansi);
                            $('#alert-error_edit').html(error.responseJSON.keperluan);
                            $('#alert-error_edit').html(error.responseJSON.bertemu_dengan);
                            $('#alert-error_edit').html(error.responseJSON.tanggal_bertamu);
                            $('#alert-error_edit').html(error.responseJSON.waktu);
                            setTimeout(function(){
                                $('#alert-error_edit').removeClass('d-block');
                                $('#alert-error_edit').addClass('d-none');
                            },3000)
                        }
                    }
                });
            });

            $('body').on('click', '#btn-delete', function () {
                var id = $(this).data("id");
                var token   = $("meta[name='csrf-token']").attr("content");
                console.log(id);
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: "Ingin Menghapus Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Tidak',
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: `/buku_tamu/${id}`,
                            cache: false,
                            data: {
                                "id": id,
                                "_token": token
                            },
                            success:function(response){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data Berhasil Dihapus!',
                                    showConfirmButton: false,
                                    timer: 4000
                                });
                                fetch_data();
                            }
                        });
                    }
                })
            });

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>