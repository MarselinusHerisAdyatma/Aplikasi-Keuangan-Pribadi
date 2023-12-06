@extends('dashboard.layout.master')

@section('title_content')
    <h6 class="m-0 font-weight-bold text-primary">Edit Pengeluaran</h6>
@endsection

@section('content')
    <div class="modal-body">
        <form action="/pengeluaran/{{ $pengeluaran->id }}/update" method="POST">
            @csrf
            <!-- Form fields for editing -->
            <div class="form-group">
                <label>Nama Pengeluaran</label>
                <input type="text" name="nama_pengeluaran" class="form-control form-control-user"
                    value="{{ $pengeluaran->nama_pengeluaran }}" placeholder="Masukkan Nama Pengeluaran" required>
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <select class="form-control" name="kategori" required>
                    <option value="Belanja" {{ ($pengeluaran->kategori == 'Belanja') ? 'selected' : '' }}>Belanja</option>
                    <option value="Makanan & Minuman" {{ ($pengeluaran->kategori == 'Makanan & Minuman') ? 'selected' : '' }}>
                        Makanan & Minuman</option>
                    <option value="Kebutuhan Pokok" {{ ($pengeluaran->kategori == 'Kebutuhan Pokok') ? 'selected' : '' }}>
                        Kebutuhan Pokok</option>
                    <option value="Tagihan" {{ ($pengeluaran->kategori == 'Tagihan') ? 'selected' : '' }}>Tagihan(Wifi, Listrik dll)</option>
                    <option value="Lain-lain" {{ ($pengeluaran->kategori == 'Lain-lain') ? 'selected' : '' }}>Lain-Lain</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal Pengeluaran</label>
                <input type="date" name="tanggal_pengeluaran" class="form-control form-control-user"
                    value="{{ $pengeluaran->tanggal_pengeluaran }}" required>
            </div>

            <div class="form-group">
                <label>Jumlah Pengeluaran</label>
                <input type="number" name="jumlah_pengeluaran" class="form-control form-control-user"
                    value="{{ $pengeluaran->jumlah_pengeluaran }}" placeholder="Masukkan Jumlah Pengeluaran" required>
            </div>

            <!-- Add other fields as needed -->

            <div class="modal-footer">
                <a href="/pengeluaran" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
