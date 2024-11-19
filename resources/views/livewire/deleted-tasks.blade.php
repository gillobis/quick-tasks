
@section('title', 'Deleted tasks')

<div>

<div class="p-4 sm:ml-64">

  {{-- content --}}
  <div class="p-2 text-center">
      <h1 class="text-2xl font-bold">Deleted tasks</h1>

      <div>
        <div class="mt-2 flex flex-col items-center gap-1">
          @foreach($tasks as $task)
            @livewire('task.deleted-task', ['task' => $task], key($task->id))
          @endforeach
        </div>
      </div>
      
  </div>
</div>

</div>
