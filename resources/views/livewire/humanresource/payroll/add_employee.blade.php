<div class="card">
    <div class="card-body">
        <form class="mt-2 position-relative mb-1">
            <div class="input-group">
                <input type="text" wire:model.debounce.300ms="search" class="form-control" placeholder="Search">
            </div>
        </form>
        <div class="scrollable list-group list-group-flush">
            @forelse ($employees as $key => $employee)
                <a href="javascript:void(0)" wire:click="addPrepperEmployee({{ $employee->id }})"
                    class="list-group-item d-flex align-items-center mb-1">
                    <span>{{ $employee->fullname }}</span><span class="badge bg-primary  ms-auto">Add</span></a>
            @empty
                <p>No employees</p>
            @endforelse

        </div>
    </div>
</div>
