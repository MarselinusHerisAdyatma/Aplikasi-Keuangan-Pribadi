@extends('dashboard.layout.master')

@section('title_content')
    <h6 class="m-0 font-weight-bold text-primary">Edit Tabungan</h6>
@endsection

@section('content')
    @if(session('status'))
        <div class="alert alert-info" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="modal-body">
        <form action="/tabungan/{{ $tabungan->id }}/update" method="POST">
            @csrf
            <div class="form-group {{ $errors->has('nama_tabungan') ? ' has-error': '' }}">
                <label for="nama_tabungan">Nama Tabungan</label>
                <input type="text" id="nama_tabungan" name="nama_tabungan" class="form-control form-control-user"
                       value="{{ $tabungan->nama_tabungan }}" placeholder="Masukan Nama Tabungan" required>
                @if($errors->has('nama_tabungan'))
                    <span class="help-block">{{ $errors->first('nama_tabungan') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('tanggal_tabungan') ? ' has-error': '' }}">
                <label for="tanggal_tabungan">Tanggal Tabungan</label>
                <input type="date" id="tanggal_tabungan" name="tanggal_tabungan" class="form-control form-control-user"
                       value="{{ $tabungan->tanggal_tabungan }}" required>
                @if($errors->has('tanggal_tabungan'))
                    <span class="help-block">{{ $errors->first('tanggal_tabungan') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('nominal') ? ' has-error': '' }}">
                <label for="nominal">Nominal</label>
                <input type="number" id="nominal" name="nominal" class="form-control form-control-user"
                       value="{{ $tabungan->nominal }}" placeholder="Masukan Nominal" required>
                @if($errors->has('nominal'))
                    <span class="help-block">{{ $errors->first('nominal') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('keterangan') ? ' has-error': '' }}">
                <label for="keterangan">Keterangan</label>
                <input type="text" id="keterangan" name="keterangan" class="form-control form-control-user"
                       value="{{ $tabungan->keterangan }}" placeholder="Masukan Keterangan" required>
                @if($errors->has('keterangan'))
                    <span class="help-block">{{ $errors->first('keterangan') }}</span>
                @endif
            </div>

            <div class="modal-footer">
                <a href="/tabungan" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
