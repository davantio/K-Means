@extends('template')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Data Produksi</h4>
        </div>

        <div class="card-body">
            <form action="{{url('/produksi/update/'.$produksi->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="basicInput">Tahun</label>
                            <input type="text" class="form-control" id="basicInput" name="tahun" value="{{$produksi->tahun}}">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Kecamatan</label>
                            <input type="text" class="form-control" id="basicInput" name="kecamatan" value="{{$produksi->kecamatan}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="basicInput">Luas Panen (ha)</label>
                            <input type="text" class="form-control" id="basicInput" name="luas_panen" value="{{$produksi->luas_panen}}">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Hasil Produksi (ton)</label>
                            <input type="text" class="form-control" id="basicInput" name="hasil" value="{{$produksi->hasil}}">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <button class="btn btn-success" type="submit">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            @if (session('errors'))
                var errors = @json(session('errors')->all());
                var errorMessage = errors;
                var indonesianMessages = {
                    'The tahun field is required.': 'Kolom Tahun Harus Di Isi',
                    'The kecamatan field is required.': 'Kolom Kecamatan Harus Di Isi',
                    'The luas_panen field is required.': 'Kolom Luas Panen Harus Di Isi',
                    'The hasil field is required.': 'Kolom Hasil Produksi Harus Di Isi',
                    'The luas_panen field must be a number.' : 'Luas Panen Harus Angka',
                    'The hasil field must be a number.' : 'Hasil Produksi Harus Angka'
                };
                for (var key in indonesianMessages) {
                    if (indonesianMessages.hasOwnProperty(key) && errorMessage.includes(key)) {
                        errorMessage = indonesianMessages[key];
                        break;
                    }
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                });
            @endif
        });
    </script>
@endsection