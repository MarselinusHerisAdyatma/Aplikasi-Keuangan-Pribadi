@extends('dashboard.layout.reportmaster')

@section('title_content')
    Akun Keuangan
@endsection

@section('content')
    <table class="table table-bordered" style="margin-top: 10px">
        <thead class="thead-dark">
            <tr>
                <th>Nama Rekening</th>
                <th>No Rekening</th>
            </tr>
        </thead>
        <tbody>
            @foreach($akunKeuangans as $akunKeuangan)
                <tr>
                    <td>{{ $akunKeuangan->nama_rekening }}</td>
                    <td>{{ $akunKeuangan->no_rekening }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
