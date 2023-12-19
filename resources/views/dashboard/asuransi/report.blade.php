@extends('dashboard.layout.reportmaster')

@section('title_content')
Asuransi
@endsection

@section('content')
<table class="table table-bordered" style="margin-top: 10px">
    <thead class="thead-dark">
        <tr>
                <th>Nama Asuransi</th>
                <th>Kategori</th>
                <th>Tanggal Mulai Asuransi</th>
                <th>Nominal</th>
                <th>Periode</th>
                <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($asuransi as $asuransi)
        <tr>
                <td>{{ $asuransi->nama_asuransi }}</td>
                <td>{{ $asuransi->kategori }}</td>
                <td>{{ date("d-m-Y", strtotime($asuransi->tanggal_asuransi)) }}</td>
                <td>Rp. {{ number_format($asuransi->nominal, 0, ',', '.') }}</td>
                <td>{{ $asuransi->periode }}</td>
                <td>{{ $asuransi->keterangan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection