@extends('dashboard.layout.master')

@section('title_content')
    <h6 class="m-0 font-weight-bold text-primary">Edit Wishlist</h6>
@endsection

@section('content')
    @if(session('status'))
        <div class="alert alert-info" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="modal-body">
        <form action="/wishlist/{{ $wishlist->id }}/update" method="POST">
            @csrf
            <div class="form-group {{ $errors->has('nama_wishlist') ? ' has-error': '' }}">
                <label for="nama_wishlist">Nama Wishlist</label>
                <input type="text" id="nama_wishlist" name="nama_wishlist" class="form-control form-control-user"
                       value="{{ $wishlist->nama_wishlist }}" placeholder="Masukan Nama Wishlist" required>
                @if($errors->has('nama_wishlist'))
                    <span class="help-block">{{ $errors->first('nama_wishlist') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('kategori') ? ' has-error': '' }}">
                <label for="kategori">Kategori</label>
                <select id="kategori" class="form-control" name="kategori" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Jangka Pendek" {{ ($wishlist->kategori == 'Jangka Pendek') ? 'selected' : '' }}>Jangka Pendek</option>
                    <option value="Jangka Panjang" {{ ($wishlist->kategori == 'Jangka Panjang') ? 'selected' : '' }}>Jangka Panjang</option>
                    <option value="Barang Pribadi" {{ ($wishlist->kategori == 'Barang Pribadi') ? 'selected' : '' }}>Barang Pribadi</option>
                    <option value="Hadiah Orang Tua" {{ ($wishlist->kategori == 'Hadiah Orang Tua') ? 'selected' : '' }}>
                        Hadiah Orang Tua</option>
                    <option value="Lain-lain" {{ ($wishlist->kategori == 'Lain-lain') ? 'selected' : '' }}>Lain-Lain</option>
                </select>
                @if($errors->has('kategori'))
                    <span class="help-block">{{ $errors->first('kategori') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('tanggal_wishlist') ? ' has-error': '' }}">
                <label for="tanggal_wishlist">Tanggal Wishlist Dibuat</label>
                <input type="date" id="tanggal_wishlist" name="tanggal_wishlist" class="form-control form-control-user"
                       value="{{ $wishlist->tanggal_wishlist }}" required>
                @if($errors->has('tanggal_wishlist'))
                    <span class="help-block">{{ $errors->first('tanggal_wishlist') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('nominal') ? ' has-error': '' }}">
                <label for="nominal">Nominal</label>
                <input type="number" id="nominal" name="nominal" class="form-control form-control-user"
                       value="{{ $wishlist->nominal }}" placeholder="Masukan Jumlah Nominal" required>
                @if($errors->has('nominal'))
                    <span class="help-block">{{ $errors->first('nominal') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('tanggal_target') ? ' has-error': '' }}">
                <label for="tanggal_target">Tanggal Target Tercapai</label>
                <input type="date" id="tanggal_target" name="tanggal_target" class="form-control form-control-user"
                       value="{{ $wishlist->tanggal_target }}" required>
                @if($errors->has('tanggal_target'))
                    <span class="help-block">{{ $errors->first('tanggal_target') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('keterangan') ? ' has-error': '' }}">
                <label for="keterangan">Keterangan</label>
                <input type="text" id="keterangan" name="keterangan" class="form-control form-control-user"
                       value="{{ $wishlist->keterangan }}" placeholder="Masukan Keterangan Wishlist" required>
                @if($errors->has('keterangan'))
                    <span class="help-block">{{ $errors->first('keterangan') }}</span>
                @endif
            </div>

            <div class="modal-footer">
                <a href="/wishlist" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
