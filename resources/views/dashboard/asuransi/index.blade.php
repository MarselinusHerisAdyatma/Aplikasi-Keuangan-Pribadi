@extends('dashboard.layout.master')

@section('title_content')
<h6 class="m-0 font-weight-bold text-primary">Data Asuransi</h6>
@endsection

@section('content')
@if(session('status'))
<div class="alert alert-info" role="alert">
    {{ session('status') }}
</div>
@endif
<button type="button" class="btn btn-sm btn-success shadow-sm mb-3" data-toggle="modal" data-target="#addModal"><i
        class="fas fa-plus fa-sm text-white-50"></i>
    Tambah
    Asuransi</button>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Nama Asuransi</th>
                <th>Kategori</th>
                <th>Tanggal Mulai Asuransi</th>
                <th>Nominal</th>
                <th>Periode</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asuransi as $asuransi)
            <tr>
                <td>{{ $asuransi->nama_asuransi }}</td>
                <td>{{ $asuransi->kategori }}</td>
                <td>{{ date("d-m-Y", strtotime($asuransi->tanggal_asuransi)) }}</td>
                <td>Rp. {{ number_format($asuransi->nominal, 0, ',', '.') }}</td>
                <td>{{ $asuransi->periode }}</td>
                <td>{{ $asuransi->keterangan }}</td>
                <td>
                    <a href="/asuransi/{{ $asuransi->id }}/edit" class="btn btn-sm btn-warning shadow-sm mb-3">
                        <i class="fas fa-edit fa-sm text-white-50"></i> Edit
                    </a>
                    <a href="/asuransi/{{ $asuransi->id }}/delete" class="btn btn-sm btn-danger shadow-sm mb-3"
                        onclick="return confirm('Apakah anda ingin menghapus data ({{ $asuransi->nama_asuransi }})?')"><i
                        class="fas fa-trash fa-sm text-white-50"></i> Hapus</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Add Modal --}}
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Asuransi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/asuransi/add" method="POST">
                    @csrf
                    <div class="form-group {{ $errors->has('nama_asuransi') ? ' has-error': '' }}">
                        <label>Nama asuransi</label>
                        <input type="text" name="nama_asuransi" class="form-control form-control-user"
                            value="{{ old('nama_asuransi') }}" placeholder="Masukan Nama Asuransi" required>
                        @if($errors->has('nama_asuransi'))
                        <span class="help-block">{{ $errors->first('nama_asuransi') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('kategori') ? ' has-error': '' }}">
                        <label>Kategori</label>
                        <select class="form-control" name="kategori" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Kesehatan" {{ (old('kategori') == 'Kesehatan') ? 'selected' : '' }}>Kesehatan</option>
                            <option value="Kerja" {{ (old('kategori') == 'Kerja') ? 'selected' : '' }}>Kerja</option>
                            <option value="Jaminan Masa Tua" {{ (old('kategori') == 'Jaminan Masa Tua') ? 'selected' : '' }}>Jaminan Masa Tua
                            </option>
                            <option value="Lain-lain" {{ (old('kategori') == 'Lain-lain') ? 'selected' : '' }}>Lain-Lain
                            </option>
                        </select>
                        @if($errors->has('kategori'))
                        <span class="help-block">{{ $errors->first('kategori') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('tanggal_asuransi') ? ' has-error': '' }}">
                        <label>Tanggal Asuransi Dibuat</label>
                        <input type="date" name="tanggal_asuransi" class="form-control form-control-user"
                            value="{{ old('tanggal_asuransi') }}" required>
                        @if($errors->has('tanggal_asuransi'))
                        <span class="help-block">{{ $errors->first('tanggal_asuransi') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('nominal') ? ' has-error': '' }}">
                        <label>Nominal</label>
                        <input type="number" name="nominal" class="form-control form-control-user"
                            value="{{ old('nominal') }}" placeholder="Masukan Jumlah Nominal" required>
                        @if($errors->has('nominal'))
                        <span class="help-block">{{ $errors->first('nominal') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('periode') ? ' has-error': '' }}">
                        <label>Periode</label>
                        <input type="text" name="periode" class="form-control form-control-user"
                            value="{{ old('periode') }}" required>
                        @if($errors->has('periode'))
                        <span class="help-block">{{ $errors->first('periode') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('keterangan') ? ' has-error': '' }}">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" class="form-control form-control-user"
                            value="{{ old('keterangan') }}" placeholder="Masukan Keterangan asuransi" required>
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