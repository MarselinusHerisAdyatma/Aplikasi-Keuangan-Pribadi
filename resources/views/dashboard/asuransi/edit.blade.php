@extends('dashboard.layout.master')

@section('title_content')
    <h6 class="m-0 font-weight-bold text-primary">Edit Asuransi</h6>
@endsection

@section('content')
    @if(session('status'))
        <div class="alert alert-info" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="modal-body">
        <form action="/asuransi/{{ $asuransi->id }}/update" method="POST">
            @csrf
            <div class="form-group {{ $errors->has('nama_asuransi') ? ' has-error': '' }}">
                <label for="nama_asuransi">Nama Asuransi</label>
                <input type="text" id="nama_asuransi" name="nama_asuransi" class="form-control form-control-user"
                       value="{{ $asuransi->nama_asuransi }}" placeholder="Masukan Nama asuransi" required>
                @if($errors->has('nama_asuransi'))
                    <span class="help-block">{{ $errors->first('nama_asuransi') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('kategori') ? ' has-error': '' }}">
                <label for="kategori">Kategori</label>
                <select id="kategori" class="form-control" name="kategori" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Kesehatan" {{ ($asuransi->kategori == 'Kesehatan') ? 'selected' : '' }}>Kesehatan</option>
                    <option value="Kerja" {{ ($asuransi->kategori == 'Kerja') ? 'selected' : '' }}>Kerja</option>
                    <option value="Jaminan Masa Tua" {{ ($asuransi->kategori == 'Jaminan Masa Tua') ? 'selected' : '' }}>Jaminan Masa Tua</option>
                    <option value="Lain-lain" {{ ($asuransi->kategori == 'Lain-lain') ? 'selected' : '' }}>Lain-Lain</option>
                </select>
                @if($errors->has('kategori'))
                    <span class="help-block">{{ $errors->first('kategori') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('tanggal_asuransi') ? ' has-error': '' }}">
                <label for="tanggal_asuransi">Tanggal Asuransi Dibuat</label>
                <input type="date" id="tanggal_asuransi" name="tanggal_asuransi" class="form-control form-control-user"
                       value="{{ $asuransi->tanggal_asuransi }}" required>
                @if($errors->has('tanggal_asuransi'))
                    <span class="help-block">{{ $errors->first('tanggal_asuransi') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('nominal') ? ' has-error': '' }}">
                <label for="nominal">Nominal</label>
                <input type="number" id="nominal" name="nominal" class="form-control form-control-user"
                       value="{{ $asuransi->nominal }}" placeholder="Masukan Jumlah Nominal" required>
                @if($errors->has('nominal'))
                    <span class="help-block">{{ $errors->first('nominal') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('periode') ? ' has-error': '' }}">
                <label for="periode">Periode</label>
                <input type="date" id="periode" name="periode" class="form-control form-control-user"
                       value="{{ $asuransi->periode }}" required>
                @if($errors->has('periode'))
                    <span class="help-block">{{ $errors->first('periode') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('keterangan') ? ' has-error': '' }}">
                <label for="keterangan">Keterangan</label>
                <input type="text" id="keterangan" name="keterangan" class="form-control form-control-user"
                       value="{{ $asuransi->keterangan }}" placeholder="Masukan Keterangan asuransi" required>
                @if($errors->has('keterangan'))
                    <span class="help-block">{{ $errors->first('keterangan') }}</span>
                @endif
            </div>

            <div class="modal-footer">
                <a href="/asuransi" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
