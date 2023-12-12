@extends('dashboard.layout.master')

@section('title_content')
<h6 class="m-0 font-weight-bold text-primary">Data Investasi</h6>
@endsection

@section('content')
@if(session('status'))
<div class="alert alert-info" role="alert">
    {{ session('status') }}
</div>
@endif
<button type="button" class="btn btn-sm btn-success shadow-sm mb-3" data-toggle="modal" data-target="#addModal"><i
        class="fas fa-plus fa-sm text-white-50"></i>
    Tambah Investasi</button>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Jenis Investasi</th>
                <th>Nama Investasi</th>
                <th>Nama Bank</th>
                <th>Tanggal Investasi</th>
                <th>Waktu Investasi</th>
                <th>Nominal Modal</th>
                <th>Nominal Investasi</th>
                <th>Jumlah Unit</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($investasis as $investasi)
            <tr>
                <td>{{ $investasi->investasi }}</td>
                <td>{{ $investasi->nama_investasi }}</td>
                <td>{{ $investasi->nama_bank }}</td>
                <td>{{ date("d-m-Y", strtotime($investasi->date)) }}</td>
                <td>{{ $investasi->time }}</td>
                <td>Rp. {{ number_format($investasi->nominal_modal, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($investasi->nominal_investasi, 0, ',', '.') }}</td>
                <td>{{ $investasi->jumlah }}</td>
                <td>{{ $investasi->status }}</td>
                <td>{{ $investasi->keterangan }}</td>
                <td>
                    <a href="/investasi/{{ $investasi->id }}/edit" class="btn btn-sm btn-warning shadow-sm mb-3">
                        <i class="fas fa-edit fa-sm text-white-50"></i> Edit
                    </a>
                    <a href="/investasi/{{ $investasi->id }}/delete" class="btn btn-sm btn-danger shadow-sm mb-3"
                        onclick="return confirm('Apakah anda ingin menghapus data ({{ $investasi->nama_investasi }})?')">
                        <i class="fas fa-trash fa-sm text-white-50"></i> Hapus
                    </a>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Investasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/investasi/add" method="POST">
                    @csrf
                    <div class="form-group {{ $errors->has('investasi') ? ' has-error': '' }}">
                        <label>Jenis Investasi</label>
                        <select class="form-control" name="investasi" required>
                            <option value="">Pilih Jenis Investasi</option>
                            <option value="beli" {{ (old('investasi') == 'beli') ? 'selected' : '' }}>Beli</option>
                            <option value="jual" {{ (old('investasi') == 'jual') ? 'selected' : '' }}>Jual</option>
                        </select>
                        @if($errors->has('investasi'))
                        <span class="help-block">{{ $errors->first('investasi') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('nama_investasi') ? ' has-error': '' }}">
                        <label>Nama Investasi</label>
                        <input type="text" name="nama_investasi" class="form-control form-control-user"
                            value="{{ old('nama_investasi') }}" placeholder="Masukan Nama Investasi" required>
                        @if($errors->has('nama_investasi'))
                        <span class="help-block">{{ $errors->first('nama_investasi') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('nama_bank') ? ' has-error': '' }}">
                        <label>Nama Bank</label>
                        <select class="form-control" name="nama_bank" required>
                            <option value="">Pilih Nama Bank</option>
                            <option value="BCA" {{ (old('nama_bank') == 'BCA') ? 'selected' : '' }}>BCA</option>
                            <option value="BRI" {{ (old('nama_bank') == 'BRI') ? 'selected' : '' }}>BRI</option>
                            <option value="BNI" {{ (old('nama_bank') == 'BNI') ? 'selected' : '' }}>BNI</option>
                            <option value="Mandiri" {{ (old('nama_bank') == 'Mandiri') ? 'selected' : '' }}>Mandiri</option>
                        </select>
                        @if($errors->has('nama_bank'))
                        <span class="help-block">{{ $errors->first('nama_bank') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('date') ? ' has-error': '' }}">
                        <label>Tanggal Investasi</label>
                        <input type="date" name="date" class="form-control form-control-user"
                            value="{{ old('date') }}" required>
                        @if($errors->has('date'))
                        <span class="help-block">{{ $errors->first('date') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('time') ? ' has-error': '' }}">
                        <label>Waktu Investasi</label>
                        <input type="time" name="time" class="form-control form-control-user"
                            value="{{ old('time') }}" required>
                        @if($errors->has('time'))
                        <span class="help-block">{{ $errors->first('time') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('nominal_modal') ? ' has-error': '' }}">
                        <label>Nominal Modal</label>
                        <input type="number" name="nominal_modal" class="form-control form-control-user"
                            value="{{ old('nominal_modal') }}" placeholder="Masukkan Nominal Modal" required>
                        @if($errors->has('nominal_modal'))
                        <span class="help-block">{{ $errors->first('nominal_modal') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('nominal_investasi') ? ' has-error': '' }}">
                        <label>Nominal Investasi</label>
                        <input type="number" name="nominal_investasi" class="form-control form-control-user"
                            value="{{ old('nominal_investasi') }}" placeholder="Masukkan Nominal Investasi" required>
                        @if($errors->has('nominal_investasi'))
                        <span class="help-block">{{ $errors->first('nominal_investasi') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('jumlah') ? ' has-error': '' }}">
                        <label>Jumlah Unit</label>
                        <input type="number" name="jumlah" class="form-control form-control-user"
                            value="{{ old('jumlah') }}" placeholder="Masukkan Jumlah Unit" required>
                        @if($errors->has('jumlah'))
                        <span class="help-block">{{ $errors->first('jumlah') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('status') ? ' has-error': '' }}">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="Loss" {{ (old('status') == 'Loss') ? 'selected' : '' }}>Loss</option>
                            <option value="Profit" {{ (old('status') == 'Profit') ? 'selected' : '' }}>Profit</option>
                        </select>
                        @if($errors->has('status'))
                        <span class="help-block">{{ $errors->first('status') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('keterangan') ? ' has-error': '' }}">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control form-control-user"
                            placeholder="Masukkan Keterangan">{{ old('keterangan') }}</textarea>
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
