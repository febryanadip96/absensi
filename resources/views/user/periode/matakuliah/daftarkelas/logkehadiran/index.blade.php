@extends('layouts.admin')

@section('content')
<div class="container">
	@include('includes.common.status')
	@include('includes.common.errors')
	<h3>Log Kehadiran</h3>
	<h5>Mahasiswa:{{$daftarKelas->mahasiswa->nama}} ({{$daftarKelas->mahasiswa->nrp}})</h5>
	<h5>Matakuliah: {{$matakuliah->nama}}</h5>
	<h5>Periode: {{$periode->nama}}</h5>
    <table class="table table-hover">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
			<th>Kedatangan</th>
			<th>Kepulangan</th>
        </tr>
		@foreach($logKehadiran as $index => $item)
			<tr>
				<td>{{$index+1}}</td>
				<td>{{$item->tanggal}}</td>
				<td>{{$item->kedatangan}}</td>
				<td>{{$item->kepulangan}}</td>
			</tr>
		@endforeach
    </table>
</div>
@endsection
