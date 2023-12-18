@extends('dashboard.layout.reportmaster')

@section('title_content')
Wishlist
@endsection

@section('content')
<table class="table table-bordered" style="margin-top: 10px">
    <thead class="thead-dark">
        <tr>
        <th>Nama Wishlist</th>
                <th>Kategori</th>
                <th>Tanggal Wishlist Dibuat</th>
                <th>Nominal</th>
                <th>Tanggal Target</th>
                <th>Keterangan</th>
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
        </tr>
        @endforeach
    </tbody>
</table>
@endsection