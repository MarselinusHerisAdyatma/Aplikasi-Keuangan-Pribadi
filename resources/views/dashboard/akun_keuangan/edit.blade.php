@extends('dashboard.layout.master')

@section('title_content')
    <h6 class="m-0 font-weight-bold text-primary">Edit Akun Keuangan</h6>
@endsection

@section('content')
    @if(session('status'))
        <div class="alert alert-info" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="modal-body">
        <form action="/akun_keuangan/{{ $akunKeuangan->id }}/update" method="POST">
            @csrf

            <div class="form-group {{ $errors->has('nama_rekening') ? ' has-error': '' }}">
                <label>Nama Rekening</label>
                <input type="text" name="nama_rekening" class="form-control form-control-user"
                    value="{{ $akunKeuangan->nama_rekening }}" placeholder="Masukkan Nama Rekening" required>
                @if($errors->has('nama_rekening'))
                    <span class="help-block">{{ $errors->first('nama_rekening') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('no_rekening') ? ' has-error': '' }}">
                <label>No Rekening</label>
                <input type="text" name="no_rekening" class="form-control form-control-user"
                    value="{{ $akunKeuangan->no_rekening }}" placeholder="Masukkan No Rekening" required>
                @if($errors->has('no_rekening'))
                    <span class="help-block">{{ $errors->first('no_rekening') }}</span>
                @endif
            </div>

            <!-- Add other fields as needed -->

            <div class="modal-footer">
                <a href="/akun_keuangan" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
