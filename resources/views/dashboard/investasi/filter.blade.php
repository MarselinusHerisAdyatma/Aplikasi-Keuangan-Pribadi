@extends('dashboard.layout.master')

@section('title_content')
    <h6 class="m-0 font-weight-bold text-primary">Filter Data Investasi</h6>
@endsection

@section('content')
    @if(session('status'))
        <div class="alert alert-info" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form action="/investasi/filter" method="POST" style="display:inline">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label class="form-control-label">Tanggal Awal</label>
                <div class="input-group">
                    <input id="startdate" type="date" name="startdate" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-control-label">Tanggal Akhir</label>
                <div class="input-group">
                    <input id="enddate" type="date" name="enddate" class="form-control" required>
                </div>
            </div>
        </div><br>
        <button type="submit" class="btn btn-success">Filter Data</button>
    </form>
    @if (!$investasis->isEmpty())
        @if (!empty($startdate) && !empty($enddate))
            <form action="/investasi/print" method="POST" target="_blank" style="display:inline">
                @csrf
                <input type="hidden" value="{{ $startdate }}" name="startdate">
                <input type="hidden" value="{{ $enddate }}" name="enddate">
                <button type="submit" class="btn btn-warning">Cetak Filter Data</button>
            </form>
        @else
            <a href="/investasi/print" target="_blank" class="btn btn-warning">Cetak Semua Data</a>
        @endif
    @else
        <center>
            <h5>Maaf anda tidak mempunyai data apapun untuk dicetak</h5>
        </center>
    @endif
    <br><br>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
