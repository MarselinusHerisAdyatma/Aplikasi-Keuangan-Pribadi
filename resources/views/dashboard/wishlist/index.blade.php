@extends('dashboard.layout.master')

@section('title_content')
<h6 class="m-0 font-weight-bold text-primary">Data Wishlist</h6>
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
    Wishlist</button>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Nama Wishlist</th>
                <th>Kategori</th>
                <th>Tanggal Wishlist Dibuat</th>
                <th>Nominal</th>
                <th>Tanggal Target</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($wishlist as $wishlist)
            <tr>
                <td>{{ $wishlist->nama_wishlist }}</td>
                <td>{{ $wishlist->kategori }}</td>
                <td>{{ date("d-m-Y", strtotime($wishlist->tanggal_wishlist)) }}</td>
                <td>Rp. {{ number_format($wishlist->nominal, 0, ',', '.') }}</td>
                <td>{{ date("d-m-Y", strtotime($wishlist->tanggal_target)) }}</td>
                <td>{{ $wishlist->keterangan }}</td>
                <td>
                    <a href="/wishlist/{{ $wishlist->id }}/edit" class="btn btn-sm btn-warning shadow-sm mb-3">
                        <i class="fas fa-edit fa-sm text-white-50"></i> Edit
                    </a>
                    <a href="/wishlist/{{ $wishlist->id }}/delete" class="btn btn-sm btn-danger shadow-sm mb-3"
                        onclick="return confirm('Apakah anda ingin menghapus data ({{ $wishlist->nama_wishlist }})?')"><i
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Wishlist</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/wishlist/add" method="POST">
                    @csrf
                    <div class="form-group {{ $errors->has('nama_wishlist') ? ' has-error': '' }}">
                        <label>Nama Wishlist</label>
                        <input type="text" name="nama_wishlist" class="form-control form-control-user"
                            value="{{ old('nama_wishlist') }}" placeholder="Masukan Nama Wishlist" required>
                        @if($errors->has('nama_wishlist'))
                        <span class="help-block">{{ $errors->first('nama_wishlist') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('kategori') ? ' has-error': '' }}">
                        <label>Kategori</label>
                        <select class="form-control" name="kategori" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Jangka Pendek" {{ (old('kategori') == 'Jangka Pendek') ? 'selected' : '' }}>Jangka Pendek</option>
                            <option value="Jangka Panjang" {{ (old('kategori') == 'Jangka Panjang') ? 'selected' : '' }}>Jangka Panjang</option>
                            <option value="Barang Pribadi" {{ (old('kategori') == 'Barang Pribadi') ? 'selected' : '' }}>Barang Pribadi
                            </option>
                            <option value="Hadiah Orang Tua"
                                {{ (old('kategori') == 'SHadiah Orang Tua') ? 'selected' : '' }}>
                                Hadiah Orang Tua</option>
                            <option value="Lain-lain" {{ (old('kategori') == 'Lain-lain') ? 'selected' : '' }}>Lain-Lain
                            </option>
                        </select>
                        @if($errors->has('kategori'))
                        <span class="help-block">{{ $errors->first('kategori') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('tanggal_wishlist') ? ' has-error': '' }}">
                        <label>Tanggal Wishlist Dibuat</label>
                        <input type="date" name="tanggal_wishlist" class="form-control form-control-user"
                            value="{{ old('tanggal_wishlist') }}" required>
                        @if($errors->has('tanggal_wishlist'))
                        <span class="help-block">{{ $errors->first('tanggal_wishlist') }}</span>
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
                    <div class="form-group {{ $errors->has('tanggal_target') ? ' has-error': '' }}">
                        <label>Tanggal Target Tercapai</label>
                        <input type="date" name="tanggal_target" class="form-control form-control-user"
                            value="{{ old('tanggal_target') }}" required>
                        @if($errors->has('tanggal_target'))
                        <span class="help-block">{{ $errors->first('tanggal_target') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('keterangan') ? ' has-error': '' }}">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" class="form-control form-control-user"
                            value="{{ old('keterangan') }}" placeholder="Masukan Keterangan Wishlist" required>
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