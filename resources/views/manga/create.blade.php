@extends('layouts.dashboard')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('judul')
  <h1 class="h3 mb-4 text-gray-800">Manga</h1>
@endsection

@section('konten')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Create</h6>
  </div>

  <div class="card-body">
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif

    <form action="{{ route('post.proses-tambah.manga') }}" method="post">
      @csrf

      <div class="form-group row">
        <label for="nama_manga" class="col-sm-2 col-form-label">Nama manga</label>

        <div class="col-sm-10">
          <input type="text" class="form-control @error('nama_manga') is-invalid @enderror" name="nama_manga" value="{{ old('nama_manga', '') }}">

          @error('nama_manga')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>

      </div>

      <div class="form-group row">
        <label for="jumlah_manga" class="col-sm-2 col-form-label">Jumlah Manga</label>

        <div class="col-sm-10">
          <input type="text" class="form-control @error('jumlah_manga') is-invalid @enderror" name="jumlah_manga" value="{{ old('jumlah_manga', '') }}">

          @error('jumlah_manga')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>

      </div>

      <div class="form-group row">
        <label for="jumlah_manga" class="col-sm-2 col-form-label">Pengarang</label>

        <div class="col-sm-10">
          <select class="pengarang-id form-control custom-select" name="pengarang_ke">
            <option value="">Pilih Opsi</option>
            @foreach($data_pengarang as $pengarang)
              <option value="{{ $pengarang->id }}" {{ old('pengarang_id') == $pengarang->id ? 'selected' : '' }}>{{ $pengarang->nama }}</option>
            @endforeach
          </select>

          @error('pengarang_ke')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>

      </div>


      <button type="submit" class="btn btn-success">
        Simpan
      </button>

    </form>

  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $(document).ready(function() {
    $('.pengarang-id').select2();
  });
</script>
@endpush
