@extends('dashboard.layout.reportmaster')

@section('title_content')
    Tabungan
@endsection

@section('content')
    <table class="table table-bordered" style="margin-top: 10px">
        <thead class="thead-dark">
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
@endsection
