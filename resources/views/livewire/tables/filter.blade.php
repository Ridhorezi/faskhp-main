<button
    @if (isset($class)) class="{{ $class }}"
@else
class="btn btn-sm btn-secondary inline" @endif
    data-bs-toggle="collapse" data-bs-target="#toggleFilter" aria-expanded="false" aria-controls="toggleFilter">
    @if (isset($btnContent))
        {{ $btnContent }}
    @else
        <i class="fas fa-filter"></i>
    @endif
</button>
<div wire:ignore.self class="collapse m-1" id="toggleFilter">
    <div class="card card-body">
        <form wire:submit.prevent class="inline">
            @if (isset($custom))
                @include($custom)
            @endif
            @if (!isset($preventDefault))
                <div class="form-group">
                    <label>Dari</label>
                    <input type="date" name="from" wire:model.lazy='from'
                        class="form-control @error('from') is-invalid @enderror">
                    @error('from')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Ke</label>
                    <input type="date" name="to" wire:model.lazy='to'
                        class="form-control @error('to') is-invalid @enderror">
                    @error('to')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            @endif
            <button class="btn btn-sm btn-primary mt-2" wire:submit.prevent><i class="fas fa-times"></i>
                Submit</button>

        </form>
        <button class="btn btn-sm btn-light mt-2" wire:click='clearFilter()'><i class="fas fa-times"></i>
            Clear Request</button>
    </div>
</div>
