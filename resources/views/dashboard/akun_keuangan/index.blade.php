@extends('dashboard.layout.master')

@section('title_content')
    <h6 class="m-0 font-weight-bold text-primary">Data Akun Keuangan</h6>
@endsection

@section('content')
    @if(session('status'))
        <div class="alert alert-info" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <button type="button" class="btn btn-sm btn-success shadow-sm mb-3" data-toggle="modal" data-target="#addModal">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Akun Keuangan
    </button>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nama Rekening</th>
                    <th>No Rekening</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($akunKeuangans as $akunKeuangan)
                    <tr>
                        <td>{{ $akunKeuangan->nama_rekening }}</td>
                        <td>{{ $akunKeuangan->no_rekening }}</td>
                        <td>
                            <a href="/akun_keuangan/{{ $akunKeuangan->id }}/edit" class="btn btn-sm btn-warning shadow-sm mb-3">
                                <i class="fas fa-edit fa-sm text-white-50"></i> Edit
                            </a>
                            <a href="/akun_keuangan/{{ $akunKeuangan->id }}/delete" class="btn btn-sm btn-danger shadow-sm mb-3"
                                onclick="return confirm('Apakah anda ingin menghapus data akun keuangan ({{ $akunKeuangan->nama_rekening }})?')">
                                <i class="fas fa-trash fa-sm text-white-50"></i> Hapus
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Add Modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Akun Keuangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/akun_keuangan/add" method="POST">
                        @csrf
                        <div class="form-group {{ $errors->has('nama_rekening') ? ' has-error': '' }}">
                            <label>Nama Rekening</label>
                            <input type="text" name="nama_rekening" class="form-control form-control-user"
                                value="{{ old('nama_rekening') }}" placeholder="Masukan Nama Rekening" required>
                            @if($errors->has('nama_rekening'))
                                <span class="help-block">{{ $errors->first('nama_rekening') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('no_rekening') ? ' has-error': '' }}">
                            <label>No Rekening</label>
                            <input type="text" name="no_rekening" class="form-control form-control-user"
                                value="{{ old('no_rekening') }}" placeholder="Masukan No Rekening" required>
                            @if($errors->has('no_rekening'))
                                <span class="help-block">{{ $errors->first('no_rekening') }}</span>
                            @endif
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
