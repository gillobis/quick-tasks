
@section('title', $title)

<div>

<div class="p-4 sm:ml-64">

  {{-- add task form --}}
  @livewire('task.add-form', ['list' => $listName])

  {{-- content --}}
  <div class="p-2 text-center">

    @livewire('task.tasks-list', ['list' => $listName])
    
      
  </div>
</div>

</div>
