<div class="modal fade" id="buku_tamu-add" tabindex="-1" aria-labelledby="modalmahasiswaTambah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </button>
            </div>
            <div class="modal-body">
            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-error_add" ></div>
            <div class="mb-3">
                <label for="nama_tamu" class="form-label">Nama Tamu</label>
                <input type="text" class="form-control" name="nama_tamu" id="nama_tamu"> 
            </div>
            <div class="mb-3">
                <label for="no_telepon" class="form-label">No. Telepon</label>
                <input type="number" class="form-control" name="no_telepon" id="no_telepon" >
            </div>
            <div class="mb-3">
                <label for="nama_instansi" class="form-label">Nama Instansi</label>
                <input type="text" class="form-control" name="nama_instansi" id="nama_instansi" >
            </div>
            <div class="mb-3">
                <label for="keperluan" class="form-label">Keperluan</label>
                <textarea type="text" class="form-control" name="keperluan" id="keperluan" ></textarea>
            </div>
            <div class="mb-3">
                <label for="bertemu_dengan" class="form-label">Bertemu Dengan</label>
                <input type="text" class="form-control" name="bertemu_dengan" id="bertemu_dengan" >
            </div>
            <div class="mb-3">
                <label for="tanggal_bertamu" class="form-label">Tanggal Bertamu</label>
                <input type="date" class="form-control" name="tanggal_bertamu" id="tanggal_bertamu" >
            </div>
            <div class="mb-3">
                <label for="waktu" class="form-label">Waktu</label>
                <input type="time" class="form-control" name="waktu" id="waktu" >
            </div>
            <button type="button" class="btn btn-primary" id="store">Tambah</button>
            </div>
        </div>
    </div>
</div>
