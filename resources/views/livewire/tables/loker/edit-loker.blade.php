@section('title', 'Edit Data Loker')
<div>
    <div class="card">
        <div class="card-header">
            Edit Data Loker
        </div>
        <div class="card-body">
            <form wire:submit.prevent='update' enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title: </label>
                    <input type="text"
                        class="form-control @error('title') is-invalid @elseif($title != '') is-valid @enderror"
                        name="title" {!! wireModel('title') !!}>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description: </label>
                    <input type="text"
                        class="form-control @error('description') is-invalid @elseif($description != '') is-valid @enderror"
                        name="description" {!! wireModel('description') !!}>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div wire:ignore class="form-group">
                    <label for="qualification">Qualification: </label>
                    <input type="text"
                        class="form-control @error('qualification') is-invalid @elseif($qualification != '') is-valid @enderror"
                        name="qualification" id="qualification" {!! wireModel('qualification') !!}>
                    @error('qualification')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="contact">Contact: </label>
                    <input type="text"
                        class="form-control @error('contact') is-invalid @elseif($contact != '') is-valid @enderror"
                        name="contact" {!! wireModel('contact') !!}>
                    @error('contact')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-sm btn-primary" type="submit">Edit</button>
                <button class="btn btn-sm btn-secondary" type="button"
                    onclick="location.href='{{ route('table.loker.index') }}'">Back</button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#qualification'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('qualification', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
