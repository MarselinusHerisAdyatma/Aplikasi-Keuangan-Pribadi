@extends('dashboard.layout.master')

@section('title_content')
    <h6 class="m-0 font-weight-bold text-primary">Data Tabungan</h6>
@endsection

@section('content')
    @if(session('status'))
        <div class="alert alert-info" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <button type="button" class="btn btn-sm btn-success shadow-sm mb-3" data-toggle="modal" data-target="#addModal">
        <i class="fas fa-plus fa-sm text-white-50"></i>
        Tambah Tabungan
    </button>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nama Tabungan</th>
                    <th>Tanggal Tabungan</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tabungan as $tabungan)
                    <tr>
                        <td>{{ $tabungan->nama_tabungan }}</td>
                        <td>{{ date("d-m-Y", strtotime($tabungan->tanggal_tabungan)) }}</td>
                        <td>Rp. {{ number_format($tabungan->nominal, 0, ',', '.') }}</td>
                        <td>{{ $tabungan->keterangan }}</td>
                        <td>
                            <a href="/tabungan/{{ $tabungan->id }}/edit" class="btn btn-sm btn-warning shadow-sm mb-3">
                                <i class="fas fa-edit fa-sm text-white-50"></i> Edit
                            </a>
                            <a href="/tabungan/{{ $tabungan->id }}/delete" class="btn btn-sm btn-danger shadow-sm mb-3"
                                onclick="return confirm('Apakah anda ingin menghapus data ({{ $tabungan->nama_tabungan }})?')">
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Tabungan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/tabungan/add" method="POST">
                        @csrf
                        <div class="form-group {{ $errors->has('nama_tabungan') ? ' has-error': '' }}">
                            <label>Nama Tabungan</label>
                            <input type="text" name="nama_tabungan" class="form-control form-control-user"
                                value="{{ old('nama_tabungan') }}" placeholder="Masukan Nama Tabungan" required>
                            @if($errors->has('nama_tabungan'))
                                <span class="help-block">{{ $errors->first('nama_tabungan') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('tanggal_tabungan') ? ' has-error': '' }}">
                            <label>Tanggal Tabungan</label>
                            <input type="date" name="tanggal_tabungan" class="form-control form-control-user"
                                value="{{ old('tanggal_tabungan') }}" required>
                            @if($errors->has('tanggal_tabungan'))
                                <span class="help-block">{{ $errors->first('tanggal_tabungan') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('nominal') ? ' has-error': '' }}">
                            <label>Nominal</label>
                            <input type="number" name="nominal" class="form-control form-control-user"
                                value="{{ old('nominal') }}" placeholder="Masukan Nominal" required>
                            @if($errors->has('nominal'))
                                <span class="help-block">{{ $errors->first('nominal') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('keterangan') ? ' has-error': '' }}">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control form-control-user"
                                value="{{ old('keterangan') }}" placeholder="Masukan Keterangan" required>
                            @if($errors->has('keterangan'))
                                <span class="help-block">{{ $errors->first('keterangan') }}</span>
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
