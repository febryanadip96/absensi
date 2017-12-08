@extends('layouts.admin')

@section('content')
<div class="container">
	@include('includes.common.status')
	@include('includes.common.errors')
	<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</button>
	<h3>Daftar Mahasiswa Matakuliah {{$matakuliah->nama}} Periode {{$periode->nama}}</h3>
    <table class="table table-hover">
        <tr>
            <th>No</th>
            <th>NRP</th>
			<th>Nama</th>
			<th>Log Kehadiran</th>
			<th>Aksi</th>
        </tr>
		@foreach($daftarKelas as $index => $item)
			<tr>
				<td>{{$index+1}}</td>
				<td>{{$item->mahasiswa->nrp}}</td>
				<td>{{$item->mahasiswa->nama}}</td>
				<td>{{$item->logKehadiran->where('kedatangan', '!=', null)->where('kepulangan', '!=', null)->count()}}</td>
				<td><a data-url="{{url('periode/'.$periode->id.'/matakuliah/'.$matakuliah->id.'/daftarkelas/'.$item->id)}}" class="btn btn-success btn-hapus"><span class="glyphicon glyphicon-trash"></span> Hapus</a> <a href="{{url('periode/'.$periode->id.'/matakuliah/'.$matakuliah->id.'/daftarkelas/'.$item->id.'/logkehadiran')}}" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> Log Kehadiran</a></td>
			</tr>
		@endforeach
    </table>
</div>
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Mahasiswa</h4>
            </div>
            <form class="form-horizontal" method="POST" action="{{ url('periode/'.$periode->id.'/matakuliah/'.$matakuliah->id.'/daftarkelas') }}">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="pengajar" class="col-md-4 control-label">Mahasiswa</label>
                        <div class="col-md-6">
                            <select id="pengajar" class="form-control" name="mahasiswa" required>
								@foreach($mahasiswaTersedia as $mahasiswa)
									<option value="{{$mahasiswa->id}}">{{$mahasiswa->nama}} ({{$mahasiswa->nrp}})</option>
								@endforeach
							</select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="modal-hapus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus Mahasiswa</h4>
            </div>
            <form id="formHapus" class="form-horizontal" method="POST" action="">
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
					<p>Anda yakin ingin menghapus <b><span id="dataHapus"></span></b> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary">Ya</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    $(function(){
        $('.btn-hapus').on('click', function(){
            var url = $(this).attr('data-url');
            $.get(url, function(data){
                //alert(JSON.stringify(data));
                $('#formHapus').attr('action', url);
                $('#dataHapus').html(data.mahasiswa.nama+" ("+data.mahasiswa.nrp+")");
                $('#modal-hapus').modal('show',{backdrop: 'true'});
            });
        });
    });
</script>
@endsection
