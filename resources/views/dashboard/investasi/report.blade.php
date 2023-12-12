@extends('dashboard.layout.reportmaster')

@section('title_content')
Investasi
@endsection

@section('content')
<table class="table table-bordered" style="margin-top: 10px">
    <thead class="thead-dark">
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
@endsection
