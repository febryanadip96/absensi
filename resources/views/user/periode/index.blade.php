@extends('layouts.admin')

@section('content')
<div class="container">
    @include('includes.common.status')
    @include('includes.common.errors')
    <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</button>
    <h3>Master Periode</h3>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($periodeList as $key => $periode)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$periode->nama}}</td>
                    <td>{{$periode->status}}</td>
                    <td><a data-url="{{url('periode/'.$periode->id)}}" class="btn btn-success btn-edit"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
					<a href="{{url('periode/'.$periode->id.'/matakuliah')}}" class="btn btn-primary"><span class="glyphicon glyphicon-book"></span> Matakuliah</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Periode</h4>
            </div>
            <form class="form-horizontal" method="POST" action="{{ url('periode') }}">
                <div class="modal-body">
                    {{ csrf_field() }}
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
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Periode</h4>
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
                        <label for="namaEdit" class="col-md-4 control-label">Status</label>
                        <div class="col-sm-6">
                            <div class="radio">
                                <label><input type="radio" id="aktifEdit" name="status" value="2">Aktif</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" id="tidakAktifEdit" name="status" value="1">Tidak Aktif</label>
                            </div>
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
                if(data.status==2){
                    $('#aktifEdit').prop('checked', true);
                }
                else{
                    $('#tidakAktifEdit').prop('checked', true);
                }
                $('#modal-edit').modal('show',{backdrop: 'true'});
            });
        });
    });
</script>
@endsection
