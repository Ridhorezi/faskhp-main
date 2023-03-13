@section('title', 'Table Kuliah')
<div>
    <div class="card shadow">
        <div class="card-header">
            Table Kuliah
            <div>
                <button class="btn btn-primary" onclick="location.href='{{ route('table.kuliah.add') }}'"><i
                        class="fa fa-plus p-1"></i> Create</button>
                @include('livewire.tables.exportKuliah')
                @include('livewire.tables.search')
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th class="text-center">Select</th>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Nama Universitas</th>
                            <th>Jurusan</th>
                            <th>Dibuat oleh</th>
                            <th>Terdaftar</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($kuliahs as $kuliah)
                            <tr>
                                <form wire:submit.prevent>
                                    <td class="text-center"><input type="checkbox" name="items" wire:model='items'
                                            value="{{ $kuliah->id }}" wire:key='select-{{ $kuliah->id }}'></td>
                                </form>
                                <td class="text-center">
                                    {{ ($kuliahs->currentpage() - 1) * $kuliahs->perpage() + $loop->index + 1 }}</td>
                                <td class="text-center">{{ $kuliah->name }}</td>
                                <td class="text-center">{{ $kuliah->jenis_kelamin == 'l' ? 'Pria' : 'Wanita' }}</td>
                                <td class="text-center">{{ $kuliah->nama_universitas }}</td>
                                <td class="text-center">{{ $kuliah->jurusan }}</td>
                                <td class="text-center">
                                    @if ($kuliah->dibuat == 1)
                                        {{ 'Administrator' }}
                                    @else
                                        {{ $kuliah->dibuat }}
                                    @endif
                                </td>
                                <td class="text-center">{{ $kuliah->created_at->diffForHumans() }}</td>
                                @if ($kuliah->gambar)
                                    <td class="text-center"><button class="btn btn-sm btn-info"
                                            wire:click='openImg({{ $kuliah->id }})'
                                            wire:key='open-img-modal-{{ $kuliah->id }}'><i
                                                class="fa-solid fa-image"></i></button></td>
                                @else
                                    <td class="text-center"> <button class="btn btn-sm btn-secondary" disabled><i
                                                class="fa-solid fa-image"></i></button>
                                    </td>
                                @endif
                                <td class="text-center"><button class="btn btn-sm btn-primary"
                                        onclick="location.href='{{ route('table.kuliah.edit', $kuliah->slug) }}'"><i
                                            class="fas fa-pen"></i></button></td>
                                <td class="text-center"><button class="btn btn-sm btn-danger"
                                        wire:click='openDelete({{ $kuliah->id }})'
                                        wire:key='open-delete-modal-{{ $kuliah->id }}'><i
                                            class="fa-solid fa-trash"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $kuliahs->withQueryString()->links() }}
            </div>

            @if ($imgPreview)
                <div class="modal fade" wire:key='open-img-modal' id="imgPreview" tabindex="-1"
                    aria-labelledby="imgPreviewLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imgPreviewLabel">Image Preview, {{ $name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset('storage/kuliah/' . $imgPreview) }}" class="img-fluid" style="border-radius:10px;">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($deleteOpened)
                <div class="modal fade" wire:key='open-delete-modal' id="deletePreview" tabindex="-1"
                    aria-labelledby="deletePreviewLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deletePreviewLabel">Hapus Data?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Yakin hapus data, {{ $name }} ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <form wire:submit.prevent='deleteData()'>
                                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal"><i
                                            class="fa-solid fa-trash"></i> Delete It!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
