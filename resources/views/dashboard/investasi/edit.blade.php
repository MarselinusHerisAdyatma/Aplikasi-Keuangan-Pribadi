@extends('dashboard.layout.master')

@section('title_content')
    <h6 class="m-0 font-weight-bold text-primary">Edit Investasi</h6>
@endsection

@section('content')
    <div class="modal-body">
        <form action="/investasi/{{ $investasi->id }}/update" method="POST">
            @csrf
            <!-- Form fields for editing -->
            <div class="form-group">
                <label>Jenis Investasi</label>
                <select class="form-control" name="investasi" required>
                    <option value="beli" {{ ($investasi->investasi == 'beli') ? 'selected' : '' }}>Beli</option>
                    <option value="jual" {{ ($investasi->investasi == 'jual') ? 'selected' : '' }}>Jual</option>
                </select>
            </div>

            <div class="form-group">
                <label>Nama Investasi</label>
                <input type="text" name="nama_investasi" class="form-control form-control-user"
                    value="{{ $investasi->nama_investasi }}" placeholder="Masukkan Nama Investasi" required>
            </div>

            <div class="form-group">
                <label>Nama Bank</label>
                <select class="form-control" name="nama_bank" required>
                    <option value="BCA" {{ ($investasi->nama_bank == 'BCA') ? 'selected' : '' }}>BCA</option>
                    <option value="BRI" {{ ($investasi->nama_bank == 'BRI') ? 'selected' : '' }}>BRI</option>
                    <option value="BNI" {{ ($investasi->nama_bank == 'BNI') ? 'selected' : '' }}>BNI</option>
                    <option value="Mandiri" {{ ($investasi->nama_bank == 'Mandiri') ? 'selected' : '' }}>Mandiri</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal Investasi</label>
                <input type="date" name="date" class="form-control form-control-user"
                    value="{{ $investasi->date }}" required>
            </div>

            <div class="form-group">
                <label>Waktu Investasi</label>
                <input type="time" name="time" class="form-control form-control-user"
                    value="{{ $investasi->time }}" required>
            </div>

            <div class="form-group">
                <label>Nominal Modal</label>
                <input type="number" name="nominal_modal" class="form-control form-control-user"
                    value="{{ $investasi->nominal_modal }}" placeholder="Masukkan Nominal Modal" required>
            </div>

            <div class="form-group">
                <label>Nominal Investasi</label>
                <input type="number" name="nominal_investasi" class="form-control form-control-user"
                    value="{{ $investasi->nominal_investasi }}" placeholder="Masukkan Nominal Investasi" required>
            </div>

            <div class="form-group">
                <label>Jumlah Unit</label>
                <input type="number" name="jumlah" class="form-control form-control-user"
                    value="{{ $investasi->jumlah }}" placeholder="Masukkan Jumlah Unit" required>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status" required>
                    <option value="Loss" {{ ($investasi->status == 'Loss') ? 'selected' : '' }}>Loss</option>
                    <option value="Profit" {{ ($investasi->status == 'Profit') ? 'selected' : '' }}>Profit</option>
                </select>
            </div>

            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control form-control-user"
                    placeholder="Masukkan Keterangan">{{ $investasi->keterangan }}</textarea>
            </div>

            <!-- Add other fields as needed -->

            <div class="modal-footer">
                <a href="/investasi" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
