@extends('dashboard.layout.master')

@section('title_content')
    <h6 class="m-0 font-weight-bold text-primary">Edit Pemasukan</h6>
@endsection

@section('content')
    @if(session('status'))
        <div class="alert alert-info" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="modal-body">
        <form action="/pemasukan/{{ $pemasukan->id }}/update" method="POST">
            @csrf
            <div class="form-group {{ $errors->has('nama_pemasukan') ? ' has-error': '' }}">
                <label for="nama_pemasukan">Nama Pemasukan</label>
                <input type="text" id="nama_pemasukan" name="nama_pemasukan" class="form-control form-control-user"
                       value="{{ $pemasukan->nama_pemasukan }}" placeholder="Masukan Nama Pemasukan" required>
                @if($errors->has('nama_pemasukan'))
                    <span class="help-block">{{ $errors->first('nama_pemasukan') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('kategori') ? ' has-error': '' }}">
                <label for="kategori">Kategori</label>
                <select id="kategori" class="form-control" name="kategori" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Kerja" {{ ($pemasukan->kategori == 'Kerja') ? 'selected' : '' }}>Kerja</option>
                    <option value="Hadiah" {{ ($pemasukan->kategori == 'Hadiah') ? 'selected' : '' }}>Hadiah</option>
                    <option value="Orang Tua" {{ ($pemasukan->kategori == 'Orang Tua') ? 'selected' : '' }}>Orang Tua</option>
                    <option value="Saham/Investasi" {{ ($pemasukan->kategori == 'Saham/Investasi') ? 'selected' : '' }}>
                        Saham/Investasi</option>
                    <option value="Lain-lain" {{ ($pemasukan->kategori == 'Lain-lain') ? 'selected' : '' }}>Lain-Lain</option>
                </select>
                @if($errors->has('kategori'))
                    <span class="help-block">{{ $errors->first('kategori') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('tanggal_pemasukan') ? ' has-error': '' }}">
                <label for="tanggal_pemasukan">Tanggal Pemasukan</label>
                <input type="date" id="tanggal_pemasukan" name="tanggal_pemasukan" class="form-control form-control-user"
                       value="{{ $pemasukan->tanggal_pemasukan }}" required>
                @if($errors->has('tanggal_pemasukan'))
                    <span class="help-block">{{ $errors->first('tanggal_pemasukan') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('jumlah_pemasukan') ? ' has-error': '' }}">
                <label for="jumlah_pemasukan">Jumlah Pemasukan</label>
                <input type="number" id="jumlah_pemasukan" name="jumlah_pemasukan" class="form-control form-control-user"
                       value="{{ $pemasukan->jumlah_pemasukan }}" placeholder="Masukan Jumlah Pemasukan" required>
                @if($errors->has('jumlah_pemasukan'))
                    <span class="help-block">{{ $errors->first('jumlah_pemasukan') }}</span>
                @endif
            </div>

            <div class="modal-footer">
                <a href="/pemasukan" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
