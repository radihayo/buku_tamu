<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead> 
            <tr>
                <th class="sorting" data-sorting_type="asc" data-column_name="id" style="cursor: pointer">No<span id="id_icon"></span></th></th>
                <th class="sorting" data-sorting_type="asc" data-column_name="post_title" style="cursor: pointer">Nama Tamu <span id="post_title_icon"></span></th>
                <th>No. Telepon</th>
                <th>Nama Instansi</th>
                <th>Keperluan</th>
                <th>Bertemu Dengan</th>
                <th>Tanggal Bertamu</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody >
            @foreach($tampil_data as $data)
            <tr id="post_id{{$data->id}}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nama_tamu}}</td>
                <td>{{ $data->no_telepon}}</td>
                <td>{{ $data->nama_instansi}}</td>
                <td>{{ $data->keperluan}}</td>
                <td>{{ $data->bertemu_dengan}}</td>
                <td>{{Carbon\Carbon::parse($data->tanggal_bertamu)->format('d-M-Y')}}</td>
                <td>{{Carbon\Carbon::parse($data->waktu)->format('H:i')}}</td>
                <td><button type="button" id="btn-edit" data-id="{{ $data->id }}">ubah</a>&nbsp;
                    <button type="button" id="btn-delete" data-id="{{ $data->id }}">hapus</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
    {{$tampil_data->links()}}
</div>