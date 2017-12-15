@extends('layouts.admin')

@section('content')
<div class="container">
	@include('includes.common.status')
	@include('includes.common.errors')
	<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</button>
	<h3>Master Mahasiswa</h3>
    <table class="table table-hover">
        <tr>
            <th>No</th>
            <th>NRP</th>
			<th>Nama</th>
			<th>Matakuliah</th>
        </tr>
		@foreach($mahasiswas as $index => $mahasiswa)
			<tr>
				<td>{{$index+1}}</td>
				<td>{{$mahasiswa->nrp}}</td>
				<td>{{$mahasiswa->nama}}</td>
				<td><a href="{{url('mahasiswa/'.$mahasiswa->id.'/matakuliah')}}" class="btn btn-success"><i class="glyphicon glyphicon-book"></i></a></td>
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
            <form class="form-horizontal" method="POST" action="{{ url('mahasiswa') }}">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nrp" class="col-md-4 control-label">NRP</label>
                        <div class="col-md-6">
                            <input id="nrp" type="text" class="form-control" name="nrp" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama" class="col-md-4 control-label">Nama</label>
                        <div class="col-md-6">
                            <input id="nama" type="text" class="form-control" name="nama" required>
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
@endsection
