@extends('layouts.admin')

@section('content')
<div class="container">
	@include('includes.common.status')
	@include('includes.common.errors')
	<h3>Log Kehadiran Mahasiswa {{$mahasiswa->nama}} ({{$mahasiswa->nrp}})</h3>
	<div class="panel-group" id="accordion">
		@foreach($periode as $index => $item)
		<div class="panel panel-default">
		    <div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$index}}">{{$item->nama}}</a>
				</h4>
		    </div>
		    <div id="collapse{{$index}}" class="panel-collapse collapse">
				<div class="panel-body">
					@foreach($item->matakuliah->whereIn('id', $daftarKelas->pluck('matakuliah_id')) as $matakuliah)
						<button data-toggle="collapse" data-target="#logkehadiran{{$matakuliah->id}}" class="btn btn-warning">{{$matakuliah->nama}}</button>
						<div id="logkehadiran{{$matakuliah->id}}" class="collapse">
							<h4>Log Kehadiran Matakuliah {{$matakuliah->nama}}</h4>
							<table class="table table-hover">
						        <tr>
						            <th>No</th>
						            <th>Tanggal</th>
									<th>Kedatangan</th>
									<th>Kepulangan</th>
						        </tr>
								@foreach($matakuliah->daftarKelas->where('mahasiswa_id', $mahasiswa->id)->first()->logKehadiran as $index => $item)
									<tr>
										<td>{{$index+1}}</td>
										<td>{{$item->tanggal}}</td>
										<td>{{$item->kedatangan}}</td>
										<td>{{$item->kepulangan}}</td>
									</tr>
								@endforeach
						    </table>
						</div>
					@endforeach
				</div>
		    </div>
		</div>
		@endforeach
	</div>
</div>
@endsection
