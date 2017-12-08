@extends('layouts.admin')

@section('content')
<div class="container">
	@include('includes.common.status')
	@include('includes.common.errors')
	<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</button>
	<h3>Master Matakuliah Periode {{$periode->nama}}</h3>
    <table class="table table-hover">
        <tr>
            <th>No</th>
            <th>Nama</th>
			<th>KP</th>
			<th>Pengajar</th>
			<th>Aksi</th>
        </tr>
		@foreach($matakuliahs as $index => $matakuliah)
			<tr>
				<td>{{$index+1}}</td>
				<td>{{$matakuliah->nama}}</td>
				<td>{{$matakuliah->kp}}</td>
				<td>{{$matakuliah->pengajar->user->name}}</td>
				<td><a data-url="{{url('periode/'.$periode->id.'/matakuliah/'.$matakuliah->id)}}" class="btn btn-success btn-edit"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
				<a href="{{url('periode/'.$periode->id.'/matakuliah/'.$matakuliah->id.'/daftarkelas')}}" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span> Daftar Kelas</a></td>
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
                <h4 class="modal-title">Tambah Matakuliah</h4>
            </div>
            <form class="form-horizontal" method="POST" action="{{ url('periode/'.$periode->id.'/matakuliah') }}">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nama" class="col-md-4 control-label">Nama</label>
                        <div class="col-md-6">
                            <input id="nama" type="text" class="form-control" name="nama" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kp" class="col-md-4 control-label">KP</label>
                        <div class="col-md-6">
                            <input id="kp" type="text" class="form-control" name="kp" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pengajar" class="col-md-4 control-label">Pengajar</label>
                        <div class="col-md-6">
                            <select id="pengajar" class="form-control" name="pengajar" required>
								@foreach($dosens as $dosen)
									<option value="{{$dosen->id}}">{{$dosen->user->name}} ({{$dosen->nik}})</option>
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
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Dosen</h4>
            </div>
            <form id="formEdit" class="form-horizontal" method="POST" action="">
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
					<div class="form-group">
                        <label for="namaEdit" class="col-md-4 control-label">Nama</label>
                        <div class="col-md-6">
                            <input id="namaEdit" type="text" class="form-control" name="nama" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kpEdit" class="col-md-4 control-label">KP</label>
                        <div class="col-md-6">
                            <input id="kpEdit" type="text" class="form-control" name="kp" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pengajarEdit" class="col-md-4 control-label">Pengajar</label>
                        <div class="col-md-6">
                            <select id="pengajarEdit" class="form-control" name="pengajar" required>
								@foreach($dosens as $dosen)
									<option value="{{$dosen->id}}">{{$dosen->user->name}} ({{$dosen->nik}})</option>
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
<script>
    $(function(){
        $('.btn-edit').on('click', function(){
            var url = $(this).attr('data-url');
            $.get(url, function(data){
                //alert(JSON.stringify(data));
                $('#formEdit').attr('action', url);
                $('#namaEdit').val(data.nama);
                $('#kpEdit').val(data.kp);
                $('#pengajarEdit').val(data.dosen_id);
                $('#modal-edit').modal('show',{backdrop: 'true'});
            });
        });
    });
</script>
@endsection
