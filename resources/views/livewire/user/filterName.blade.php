<div class="form-group">
    <label>Name</label>
    <input type="text" placeholder="2000" name="from" wire:model.lazy='from'
        class="form-control @error('from') is-invalid @enderror">
    @error('from')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
