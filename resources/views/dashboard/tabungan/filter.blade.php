@extends('dashboard.layout.master')

@section('title_content')
    <h6 class="m-0 font-weight-bold text-primary">Filter Data Tabungan</h6>
@endsection

@section('content')
    @if(session('status'))
        <div class="alert alert-info" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form action="/tabungan/filter" method="POST" style="display:inline">
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
    @if (!$tabungan->isEmpty())
        @if (!empty($startdate) && !empty($enddate))
            <form action="/tabungan/print" method="POST" target="_blank" style="display:inline">
                @csrf
                <input type="hidden" value="{{ $startdate }}" name="startdate">
                <input type="hidden" value="{{ $enddate }}" name="enddate">
                <button type="submit" class="btn btn-warning">Cetak Filter Data</button>
            </form>
        @else
            <a href="/tabungan/print" target="_blank" class="btn btn-warning">Cetak Semua Data</a>
        @endif
    @else
        <center>
            <h5>Maaf Anda tidak mempunyai data apapun untuk dicetak</h5>
        </center>
    @endif
    <br><br>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nama Tabungan</th>
                    <th>Tanggal Tabungan</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tabungan as $item)
                    <tr>
                        <td>{{ $item->nama_tabungan }}</td>
                        <td>{{ date("d-m-Y", strtotime($item->tanggal_tabungan)) }}</td>
                        <td>Rp. {{ number_format($item->nominal, 0, ',', '.') }}</td>
                        <td>{{ $item->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
