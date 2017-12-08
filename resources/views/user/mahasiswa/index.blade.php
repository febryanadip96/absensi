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
@endsection
