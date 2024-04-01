@extends('template')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endsection

@section('title')
    <h3>Data Produksi</h3>
    <br>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Tabel Luas Panen dan Hasil Produksi Jagung
            </h5>
        </div>
            <div class="card-body">
                <div class="table-responsive">
                    <a class="btn btn-primary mb-2" href="/produksi/tambah" role="button">Tambah Data</a>
                    <a class="btn btn-secondary mb-2" href="/produksi/cetak" role="button">Cetak Data</a>
                    <br>
                    <br>
                    <table id="example" class="table table-striped table-bordered datatables" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun</th>
                                <th>Kecamatan</th>
                                <th>Luas Panen (ha)</th>
                                <th>Produksi (ton)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$produksi->isEmpty())
                                @foreach ($produksi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tahun }}</td>
                                    <td>{{ $item->kecamatan }}</td>
                                    <td>{{ $item->luas_panen }}</td>
                                    <td>{{ $item->hasil }}</td>
                                    <td><a class="btn btn-warning" href="/produksi/edit/{{$item->id}}" role="button">Edit</a> <a class="btn btn-danger" href="/produksi/delete/{{$item->id}}" role="button">Delete</a></td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Tahun</th>
                                <th>Kecamatan</th>
                                <th>Luas Panen (ha)</th>
                                <th>Produksi (ton)</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.7.0.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        new DataTable('#example');
    </script>
    <script>
        $('.btn-danger').on('click', function(e) {
            e.preventDefault();
            var href = $(this).attr('href');

            Swal.fire({
                title: "Are you sure?",
                text: "Yakin Hapus Data?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            });
        @endif
    </script>
@endsection