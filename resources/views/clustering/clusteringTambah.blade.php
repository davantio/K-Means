@extends('template')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Tambah Perhitungan Clustering</h4>
        </div>

        <div class="card-body">
            <form action="{{url('/clustering/tambah')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="basicInput">Tahun</label>
                            <input type="text" class="form-control" id="basicInput" name="tahun"
                            value="{{ old('tahun') }}">
                        </div>
                        <div class="form-group">
                            <label for="centroid1">Cluster 1 (Centroid 1)</label>
                            <input type="number" class="form-control" id="centroid1" name="centroid1"
                            value="{{ old('centroid1') }}">
                        </div>
                        <div class="form-group">
                            <label for="centroid2">Cluster 1 (Centroid 2)</label>
                            <input type="number" class="form-control" id="centroid2" name="centroid2"
                            value="{{ old('centroid2') }}">
                        </div>
                        <div class="form-group">
                            <label for="centroid3">Cluster 2 (Centroid 1)</label>
                            <input type="number" class="form-control" id="centroid3" name="centroid3"
                            value="{{ old('centroid3') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="centroid4">Cluster 2 (Centroid 2)</label>
                            <input type="number" class="form-control" id="centroid4" name="centroid4"
                            value="{{ old('centroid4') }}">
                        </div>
                        <div class="form-group">
                            <label for="centroid5">Cluster 3 (Centroid 1)</label>
                            <input type="number" class="form-control" id="centroid5" name="centroid5"
                            value="{{ old('centroid5') }}">
                        </div>
                        <div class="form-group">
                            <label for="centroid6">Cluster 3 (Centroid 2)</label>
                            <input type="number" class="form-control" id="centroid6" name="centroid6"
                            value="{{ old('centroid6') }}">
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
                    'The tahun field is required.': 'Kolom Tahun Harus Di Isi'
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