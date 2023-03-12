<div>
    <!--Body-->
    <section wire:ignore id="hero">
        <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
            <h1 class="mb-4 pb-0 pop">Alumni Berstatus Kerja dan Kuliah</h1>
            <p class="text-muted">Daftar dari Alumni yang berstatus sedang Kerja dan Kuliah</p>
            <a class="mouse-icon scrollto" href="#daftar">
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


    <main id="main">

        <section class="m-3 mb-3" id="daftar">
            <div class="container" wire:ignore.self data-aos="fade-up">
                <div class="row">
                    <div class="col-sm-6 offset-sm-3 mt-4 mb-3">
                        <h2 class="text-center">Daftar Alumni Kerja Dan Kuliah</h2>
                        <p class="text-center">SMK KESEHATAN HUSADA PRATAMA</p>
                    </div>
                </div>
                <div class="section-header">
                    <div class="row justify-content-end">
                        <div class="col-md-2">
                            <div class="input-group rounded size-form">
                                <input type="search" class="form-control rounded" placeholder="🔎 Search Alumni..."
                                    name="search" id="search" wire:model="search" aria-label="Search"
                                    aria-describedby="search-addon"
                                    style="box-shadow: 0px 0px 8px 0px #d4d4d4;  border: 2px solid #5534a5;" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($kerjaKuliah as $data)
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card-box text-center">
                                @if ($data->gambar)
                                    <div class="user-pic">
                                        <img src="{{ asset('storage/kerjakuliah/' . $data->gambar) }}"
                                            class="img-fluid">
                                    </div>
                                @else
                                    <div class="user-pic">
                                        <img src="https://via.placeholder.com/150/000000/FFFFFF/?text=No Image"
                                            style="max-height:12rem" class="image-style" alt="no-image">
                                    </div>
                                @endif
                                <h4> {{ $data->name }}</h4>
                                <hr>
                                <ul class="text-start">
                                    <li>Jenis Kelamin : {{ $data->jenis_kelamin == 'l' ? 'Laki-Laki' : 'Perempuan' }}
                                    </li>
                                    <li>Nama Perusahaan : {{ $data->nama_perusahaan }}</li>
                                    <li>Jabatan : {{ $data->jabatan }}</li>
                                    <li>Nama Universitas : {{ $data->nama_universitas }}</li>
                                    <li>Jurusan : {{ $data->jurusan }}</li>
                                    <li>Tahun Kerja : {{ $data->tahun_kerja }}</li>
                                    <li>Di daftarkan : {{ $data->created_at }}</li>
                                    <li>Di buat :
                                        @if ($data->dibuat == 1)
                                            {{ 'Administrator' }}
                                        @else
                                            {{ $data->dibuat }}
                                        @endif
                                    </li>
                                </ul>
                                <hr>
                                @if ($data->user_id != Auth::user()->id)
                                    <div class="btn-group dropup" style="margin-left:55%;">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            style="border-radius: 8px; cursor: not-allowed;">
                                            <span class="visually-hidden">Toggle Action</span> Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li class="text-center">Not Authorized</li>
                                        </ul>
                                    </div>
                                @else
                                    <div class="btn-group dropup" style="margin-left:55%;">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 8px;">
                                            <span class="visually-hidden">Toggle Action</span> Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('user.edit.kerjakuliah', $data->slug) }}">Request
                                                    Edit</a></li>
                                            <li><a class="dropdown-item" href="{{ route('user.delete') }}">Request
                                                    Delete</a></li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                {{ $kerjaKuliah->withQueryString()->links() }}

            </div>

        </section>

    </main>

    <!--End Body-->
</div>
