@section('title', 'Table Loker')
<div class="container-fluid py-4">
    <div class="col-12">
        <div class="card shadow mb-2">
            <div class="card-header pb-0">
                {{-- Table Loker --}}
                <div>
                    <button class="btn btn-primary" onclick="location.href='{{ route('table.loker.add') }}'"><i
                            class="fa fa-plus p-1"></i> Create</button>
                    @include('livewire.tables.exportLoker')
                    @include('livewire.tables.search')
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="datatable">
                        <thead class="text-center">
                            <tr>
                                <th class="text-center">Select</th>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Qualification</th>
                                <th>Contact</th>
                                <th>Terdaftar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($lokers as $loker)
                                <tr>
                                    <form wire:submit.prevent>
                                        <td class="text-center"><input type="checkbox" name="items" wire:model='items'
                                                value="{{ $loker->id }}" wire:key='select-{{ $loker->id }}'></td>
                                    </form>
                                    <td class="text-center">
                                        {{ ($lokers->currentpage() - 1) * $lokers->perpage() + $loop->index + 1 }}</td>
                                    <td class="text-center text-truncate" style="max-width: 150px;">{{ $loker->title }}
                                    </td>
                                    <td class="text-center text-truncate" style="max-width: 150px;">
                                        {{ $loker->description }}</td>
                                    <td class="text-center text-truncate disp" style="max-width: 150px;">
                                        {!! $loker->qualification !!}
                                        {{-- {{ $loker->qualification }}</td> --}}
                                    </td>
                                    <td class="text-center">{{ $loker->contact }}</td>
                                    <td class="text-center">{{ $loker->created_at->diffForHumans() }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary"
                                            onclick="location.href='{{ route('table.loker.edit', $loker->slug) }}'"><i
                                                class="fas fa-pen"></i></button>
                                        <button class="btn btn-sm btn-danger"
                                            wire:click='openDelete({{ $loker->id }})'
                                            wire:key='open-delete-modal-{{ $loker->id }}'><i
                                                class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $lokers->withQueryString()->links() }}
                </div>

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
                                    Yakin hapus data, {{ $title }} ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
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
</div>
