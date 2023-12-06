@extends('dashboard.layout.master')

@section('title_content')
    <h6 class="m-0 font-weight-bold text-primary">Edit Hutang</h6>
@endsection

@section('content')
    @if(session('status'))
        <div class="alert alert-info" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="modal-body">
        <form action="/hutang/{{ $hutang->id }}/update" method="POST">
            @csrf

            <div class="form-group {{ $errors->has('nama_orang') ? ' has-error': '' }}">
                <label>Nama Orang</label>
                <input type="text" name="nama_orang" class="form-control form-control-user"
                    value="{{ $hutang->nama_orang }}" placeholder="Masukkan Nama Orang" required>
                @if($errors->has('nama_orang'))
                    <span class="help-block">{{ $errors->first('nama_orang') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('kategori') ? ' has-error': '' }}">
                <label>Kategori</label>
                <select class="form-control" name="kategori" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Meminjamkan Uang" {{ ($hutang->kategori == 'Meminjamkan Uang') ? 'selected' : '' }}>
                        Meminjamkan Uang
                    </option>
                    <option value="Meminjam Uang" {{ ($hutang->kategori == 'Meminjam Uang') ? 'selected' : '' }}>
                        Meminjam Uang
                    </option>
                </select>
                @if($errors->has('kategori'))
                    <span class="help-block">{{ $errors->first('kategori') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('nominal_hutang') ? ' has-error': '' }}">
                <label>Nominal Hutang</label>
                <input type="number" name="nominal_hutang" class="form-control form-control-user"
                    value="{{ $hutang->nominal_hutang }}" placeholder="Masukkan Jumlah Nominal Hutang" required>
                @if($errors->has('nominal_hutang'))
                    <span class="help-block">{{ $errors->first('nominal_hutang') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('tanggal_hutang') ? ' has-error': '' }}">
                <label>Tanggal Hutang</label>
                <input type="date" name="tanggal_hutang" class="form-control form-control-user"
                    value="{{ $hutang->tanggal_hutang }}" required>
                @if($errors->has('tanggal_hutang'))
                    <span class="help-block">{{ $errors->first('tanggal_hutang') }}</span>
                @endif
            </div>

            <!-- Add other fields as needed -->

            <div class="modal-footer">
                <a href="/hutang" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
