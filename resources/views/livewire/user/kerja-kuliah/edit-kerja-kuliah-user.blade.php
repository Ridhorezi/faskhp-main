<div>

    <section wire:ignore id="hero">
        <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
            <h1 class="mb-4 pb-0 pop">Fomulir Edit Data Kerja - Kuliah</h1>
            {{-- <a href="#fomulir" class="about-btn scrollto"><i class="bi bi-arrow-down"></i></a> --}}
            <a class="mouse-icon scrollto" href="#fomulir">
                <svg width="19" height="30" viewBox="0 0 19 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M16.875 20.625V9.375C16.875 7.38588 16.0848 5.47822 14.6783 4.0717C13.2718 2.66518 11.3641 1.875 9.375 1.875C7.38588 1.875 5.47822 2.66518 4.0717 4.0717C2.66518 5.47822 1.875 7.38588 1.875 9.375V20.625C1.875 22.6141 2.66518 24.5218 4.0717 25.9283C5.47822 27.3348 7.38588 28.125 9.375 28.125C11.3641 28.125 13.2718 27.3348 14.6783 25.9283C16.0848 24.5218 16.875 22.6141 16.875 20.625ZM9.375 0C6.8886 0 4.50403 0.98772 2.74587 2.74587C0.98772 4.50403 0 6.8886 0 9.375V20.625C0 23.1114 0.98772 25.496 2.74587 27.2541C4.50403 29.0123 6.8886 30 9.375 30C11.8614 30 14.246 29.0123 16.0041 27.2541C17.7623 25.496 18.75 23.1114 18.75 20.625V9.375C18.75 6.8886 17.7623 4.50403 16.0041 2.74587C14.246 0.98772 11.8614 0 9.375 0Z"
                        fill="white" class="mouse"></path>
                    <path
                        d="M10.0379 7.39959C9.8621 7.22377 9.62364 7.125 9.375 7.125C9.12636 7.125 8.8879 7.22377 8.71209 7.39959C8.53627 7.5754 8.4375 7.81386 8.4375 8.0625V11.8125C8.4375 12.0611 8.53627 12.2996 8.71209 12.4754C8.8879 12.6512 9.12636 12.75 9.375 12.75C9.62364 12.75 9.8621 12.6512 10.0379 12.4754C10.2137 12.2996 10.3125 12.0611 10.3125 11.8125V8.0625C10.3125 7.81386 10.2137 7.5754 10.0379 7.39959Z"
                        fill="white" class="cursor"></path>
                </svg>
            </a>
        </div>
    </section>

    <main id="main" style="margin-top:13em; margin-bottom:13em;">

        <section class="m-3 mb-3 vh-100 d-flex align-items-center justify-content-center" id="fomulir">
            <div class="container" wire:ignore.self data-aos="fade-up">
                <div class="section-header">
                    <h4 class="text-center">Fomulir Alumni Bekerja dan Kuliah</h4>
                </div>
                <div class="card shadow" style="margin-left: 7%;">
                    <div class="card-header">
                        Edit Data Kerja Kuliah
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent='update' enctype="multipart/form-data">
                            <div class="row row-cols-2">
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="nama">Nama: </label>
                                    <input type="text"
                                        class="form-control @error('name') is-invalid @elseif($name != '') is-valid @enderror"
                                        name="name" {!! wireModel('name') !!}>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
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
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="np">Nama Perusahaan: </label>
                                    <input type="text"
                                        class="form-control @error('nama_perusahaan') is-invalid @elseif($nama_perusahaan != '') is-valid @enderror"
                                        name="nama_perusahaan" {!! wireModel('nama_perusahaan') !!}>
                                    @error('nama_perusahaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="jabatan">Jabatan: </label>
                                    <input type="text"
                                        class="form-control @error('jabatan') is-invalid @elseif($jabatan != '') is-valid @enderror"
                                        name="jabatan" {!! wireModel('jabatan') !!}>
                                    @error('jabatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="tk">Tahun Kerja: </label>
                                    <input type="number" min="2000" value="2000"
                                        class="form-control @error('tahun_kerja') is-invalid @elseif($tahun_kerja != '') is-valid @enderror"
                                        name="tahun_kerja" {!! wireModel('tahun_kerja') !!}>
                                    @error('tahun_kerja')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="np">Nama Universitas: </label>
                                    <input type="text"
                                        class="form-control @error('nama_universitas') is-invalid @elseif($nama_universitas != '') is-valid @enderror"
                                        name="nama_universitas" {!! wireModel('nama_universitas') !!}>
                                    @error('nama_universitas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="jurusan">Jurusan: </label>
                                    <input type="text"
                                        class="form-control @error('jurusan') is-invalid @elseif($jurusan != '') is-valid @enderror"
                                        name="jurusan" {!! wireModel('jurusan') !!}>
                                    @error('jurusan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="gambar">Gambar</label>
                                    <input type="file" name="gambar"
                                        class="form-control @error('gambar') is-invalid @elseif($gambar != '') is-valid @enderror"
                                        {!! wireModel('gambar') !!} wire:loading.remove wire:target="gambar">
                                    <div class="alert alert-primary shadow text-light" wire:loading
                                        wire:target="gambar">Uploading...
                                    </div>
                                    @error('gambar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    @if ($gambarUpdated)
                                        <p>Preview:</p>
                                        <img src="{{ $gambar->temporaryUrl() }}"
                                            style="max-width:110px;max-height:110px;border-radius:5px;" alt="preview">
                                    @else
                                        <p>Current:</p>
                                        @if ($gambar)
                                            <img src="{{ asset('storage/kerjakuliah/' . $gambar) }}" alt="preview"
                                                style="max-width:110px;max-height:110px;border-radius:5px;">
                                        @else
                                            <p>Tidak ada gambar</p>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <button class="btn btn-sm btn-primary" type="submit">Edit</button>
                            <button class="btn btn-sm btn-secondary" type="button"
                                onclick="location.href='{{ route('user.kerjakuliah') }}'">Back</button>
                        </form>
                    </div>
                </div>
        </section>

    </main>

    <!--End Body-->
</div>
