
@section('title', 'Expired tasks')

<div>

<div class="p-4 sm:ml-64">

  {{-- content --}}
    <div class="p-2 text-center">

        @livewire('task.tasks-list', ['list' => 'expired'])
    </div>
</div>

</div>
