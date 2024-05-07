@extends('template')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endsection

@section('title')
    <h3>Data Clustering</h3>
    <br>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Tabel Hasil Clustering
            </h5>
        </div>
            <div class="card-body">
                <div class="alert alert-{{ $notificationType }}">
                    @if($notificationType === 'success')
                        <i class="bi bi-check-circle"></i> {{ $notificationMessage }}
                    @else
                        <i class="bi bi-exclamation-triangle"></i> {{ $notificationMessage }}
                    @endif
                </div>
                <div class="table-responsive">
                    <form id="add" action="{{url('/clustering/tambah')}}" method="post">
                        @csrf
                        @method('post')
                        <button type="submit" class="btn btn-primary mb-2">Proses Clustering Data</button>
                    </form>
                    <br>
                    <table id="example" class="table table-striped table-bordered datatables" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun</th>
                                <th>Kecamatan</th>
                                <th>Luas Panen (ha)</th>
                                <th>Produksi (ton)</th>
                                <th>Klaster</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$clustering->isEmpty())
                                @foreach ($clustering as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tahun }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->luas_panen }}</td>
                                    <td>{{ $item->hasil }}</td>
                                    <td>{{ $item->cluster }}</td>
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
                                <th>Klaster</th>
                            </tr>
                        </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Informasi Hasil Clustering
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Total C1 (Produktivitas Rendah): </strong> {{ $totalCluster1 }}
                    </div>
                    <div class="form-group">
                        <strong>Total C2 (Produktivitas Sedang): </strong> {{ $totalCluster2 }}
                    </div>
                    <div class="form-group">
                        <strong>Total C3 (Produktivitas Tinggi): </strong> {{ $totalCluster3 }}
                    </div>
                </div>
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
        // Fungsi untuk menampilkan notifikasi konfirmasi saat tombol ptoses diklik
        $('#add').on('submit', function (e) {
            e.preventDefault(); // Mencegah formulir dikirim secara langsung

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Pastikan semua data sudah benar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Proses Clustering!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Submit formulir jika pengguna menekan tombol "Ya, hapus!"
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
