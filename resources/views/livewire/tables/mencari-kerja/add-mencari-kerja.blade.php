@section('title', 'Add Data Mencari Kerja')
<div>
    <div class="card">
        <div class="card-header">
            Add Data Mencari Kerja
        </div>
        <div class="card-body">
            <form wire:submit.prevent='store' enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama">Nama: </label>
                    <input type="text"
                        class="form-control @error('name') is-invalid @elseif($name != '') is-valid @enderror"
                        name="name" {!! wireModel('name') !!}>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jk">Jenis Kelamin: </label>
                    <select
                        class="form-control @error('jenis_kelamin') is-invalid @elseif($jenis_kelamin != '') is-valid @enderror"
                        name="jenis_kelamin" {!! wireModel('jenis_kelamin') !!}>
                        <option value="">-</option>
                        <option value="l">Pria</option>
                        <option value="p">Wanita</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat: </label>
                    <textarea type="text" cols="30" rows="3"
                        class="form-control @error('alamat') is-invalid @elseif($alamat != '') is-valid @enderror"
                        name="alamat"{!! wireModel('alamat') !!}>
                    </textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="alasan_mencari_kerja">Alasan Mencari Kerja: </label>
                    <textarea type="text" cols="30" rows="3"
                        class="form-control @error('alasan_mencari_kerja') is-invalid @elseif($alasan_mencari_kerja != '') is-valid @enderror"
                        name="alasan_mencari_kerja" {!! wireModel('alasan_mencari_kerja') !!}>
                    </textarea>
                    @error('alasan_mencari_kerja')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kontak">Nomor Kontak: </label>
                    <input type="text"
                        class="form-control @error('kontak') is-invalid @elseif($kontak != '') is-valid @enderror"
                        name="kontak" {!! wireModel('kontak') !!}>
                    @error('kontak')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" name="gambar"
                        class="form-control @error('gambar') is-invalid @elseif($gambar != '') is-valid @enderror"
                        {!! wireModel('gambar') !!} wire:loading.remove wire:target="gambar">
                    <div class="alert alert-primary shadow text-light" wire:loading wire:target="gambar">Uploading...
                    </div>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if ($gambar)
                        <p class="mt-2">Preview:</p>
                        <img src="{{ $gambar->temporaryUrl() }}" alt="preview" style="max-width:110px;max-height:110px;border-radius:5px;">
                    @endif
                </div>
                <button class="btn btn-sm btn-primary" type="submit">Create</button>
                <button class="btn btn-sm btn-secondary" type="button"
                    onclick="location.href='{{ route('table.mencari-kerja.index') }}'">Back</button>
            </form>
        </div>
    </div>
</div>

