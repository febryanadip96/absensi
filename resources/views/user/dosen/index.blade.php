@extends('layouts.admin')

@section('content')
<div class="container">
    @include('includes.common.status')
    @include('includes.common.errors')
    <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</button>
    <h3>Master Dosen</h3>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dosenList as $key => $dosen)
                <tr>
                    <td>{{$dosen->nik}}</td>
                    <td>{{$dosen->user->name}}</td>
                    <td>{{$dosen->user->email}}</td>
                    <td><a data-url="{{url('dosen/'.$dosen->id)}}" class="btn btn-success btn-edit"><span class="glyphicon glyphicon-pencil"></span> Edit</a></td>
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
                <h4 class="modal-title">Tambah Dosen</h4>
            </div>
            <form class="form-horizontal" method="POST" action="{{ url('dosen') }}">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nik" class="col-md-4 control-label">NIK</label>
                        <div class="col-md-6">
                            <input id="nik" type="text" class="form-control" name="nik" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama" class="col-md-4 control-label">Nama</label>
                        <div class="col-md-6">
                            <input id="nama" type="text" class="form-control" name="nama" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-md-4 control-label">Username</label>
                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control" name="username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">Email</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Password</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="col-md-4 control-label">Konfirmasi Password</label>
                        <div class="col-md-6">
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
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
                        <label for="nikEdit" class="col-md-4 control-label">NIK</label>
                        <div class="col-md-6">
                            <input id="nikEdit" type="text" class="form-control" name="nik" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="namaEdit" class="col-md-4 control-label">Nama</label>
                        <div class="col-md-6">
                            <input id="namaEdit" type="text" class="form-control" name="nama" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="usernameEdit" class="col-md-4 control-label">Username</label>
                        <div class="col-md-6">
                            <input id="usernameEdit" type="text" class="form-control" name="username" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="emailEdit" class="col-md-4 control-label">Email</label>
                        <div class="col-md-6">
                            <input id="emailEdit" type="email" class="form-control" name="email" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Password</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="col-md-4 control-label">Konfirmasi Password</label>
                        <div class="col-md-6">
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
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
                $('#nikEdit').val(data.nik);
                $('#namaEdit').val(data.user.name);
                $('#usernameEdit').val(data.user.username);
                $('#emailEdit').val(data.user.email);
                $('#modal-edit').modal('show',{backdrop: 'true'});
            });
        });
    });
</script>
@endsection
