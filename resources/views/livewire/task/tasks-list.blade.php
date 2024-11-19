<div>
  <div  class="flex items-center justify-center" x-data="{modify: false}" x-init="$watch('modify', value => { if (value == false) $wire.updataTaskListName(); })">
    <h1 x-show="!modify" class="text-2xl font-bold relative">
      {{$title}}
    </h1>
    <input @mousedown.outside="modify=false" x-show="modify" x-on:change="$wire.updataTaskListName()" wire:model="title" type="text" class="py-0 px-2 text-xl font-bold input input-bordered">
    @if($showTaskListButtons)
    <button x-on:click="modify = !modify" class=" ml-2 btn  btn-sm btn-circle btn-ghost hover:bg-base-content text-gray-400 hover:text-white">
      <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
      </svg>      
    </button>
    <button wire:click="deleteList()" wire:confirm="Are you sure you want to permanently delete this task list (and its relative tasks)?" class="btn btn-sm btn-circle btn-ghost hover:bg-error text-gray-400 hover:text-white">
      <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
      </svg>
    </button>    
    @endif
  </div>

  <div class="mt-2 flex flex-col items-center gap-1 mb-16">
    @forelse($tasks as $task)
      <div x-data="{showButtons : false}" wire:key="{{ $task->id }}" x-on:click="showButtons = !showButtons" x-on:mousedown.outside="showButtons = false"  class="bg-base-100 w-96 border task-{{Str::kebab($task->priority)}} {{ "bg-".$task->color."/25"}} {{ "border-".$task->color."/35"}} rounded-lg py-2 px-4 text-left  hover:shadow hover:cursor-pointer">
        <div class="flex justify-between items-center">
          <div>
            <p class="font-semibold @if($task->done_at) line-through text-gray-500 @endif">{{$task->title}} </p>

            <div class="flex">


              @if($task->due_date)
              <p class="text-xs flex text-gray-600 items-center mr-2">
                <svg class="h-3 w-3 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                  <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z" clip-rule="evenodd" />
                </svg>    
                        
                {{  Carbon\Carbon::today()->diffInDays($task->due_date) == 0 ? 'today' : $task->due_date->diffForHumans() }}
              </p>
              @endif

            </div>
          </div>
          
          {{-- alert icon --}}          
          @if( $task->isExpired )
          <div class="tooltip"  data-tip="Expired">
            <svg class="h5 w-5 text-warning" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
              <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
            </svg>     
          </div>     
          @elseif ((new App\Services\TaskService())->needAttention($task) )
          <svg class="h-5 w-5 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
            <path fill-rule="evenodd" d="M12.963 2.286a.75.75 0 0 0-1.071-.136 9.742 9.742 0 0 0-3.539 6.176 7.547 7.547 0 0 1-1.705-1.715.75.75 0 0 0-1.152-.082A9 9 0 1 0 15.68 4.534a7.46 7.46 0 0 1-2.717-2.248ZM15.75 14.25a3.75 3.75 0 1 1-7.313-1.172c.628.465 1.35.81 2.133 1a5.99 5.99 0 0 1 1.925-3.546 3.75 3.75 0 0 1 3.255 3.718Z" clip-rule="evenodd" />
          </svg>
          @endif
          
        </div>

        {{-- buttons --}}
        <div x-cloak x-show="showButtons" class="flex flex-row justify-between items-center mt-2" x-transition.opacity>

          <div class="badge badge-xs badge-neutral badge-outline p-2">{{$task->taskList->title}}</div>          

          <div class="flex flex-row justify-end gap-1">
            
            @if(!$task->done_at)
              <button wire:click="markAsDone({{$task}})" class="btn btn-sm btn-circle btn-ghost hover:bg-base-content hover:text-white">
                <svg  class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>              
              </button>
            @else
              <button wire:click="markAsUndone({{$task}})" class="btn btn-sm btn-circle btn-ghost hover:bg-base-content hover:text-white">
                <svg class="h-4 w-4"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m15 15-6 6m0 0-6-6m6 6V9a6 6 0 0 1 12 0v3" />
                </svg>       
              </button>
            @endif
            <a href="{{url('task/'.$task->id)}}" wire:navigate class="btn btn-sm btn-circle btn-ghost hover:bg-base-content hover:text-white">
              <svg  class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" >
                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
              </svg>
            </a>
            <button wire:click="deleteTask({{$task}})" class="btn  btn-sm btn-circle btn-ghost hover:bg-error hover:text-white">
              <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>
          
          
          
          
        </div>
        
      </div>

       
    @empty
      <p class="text-gray-500 font-light mt-4">No tasks here!</p>
    @endforelse

    @if ($showTaskListButtons && collect($tasks)->whereNotNull('done_at')->count())
    <button wire:click="deleteCompletedTasks()" wire:confirm="Are you sure?" class="btn btn-sm btn-circle btn-ghost hover:bg-black text-gray-400 hover:text-white">
      <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M566.6 54.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192-34.7-34.7c-4.2-4.2-10-6.6-16-6.6c-12.5 0-22.6 10.1-22.6 22.6l0 29.1L364.3 320l29.1 0c12.5 0 22.6-10.1 22.6-22.6c0-6-2.4-11.8-6.6-16l-34.7-34.7 192-192zM341.1 353.4L222.6 234.9c-42.7-3.7-85.2 11.7-115.8 42.3l-8 8C76.5 307.5 64 337.7 64 369.2c0 6.8 7.1 11.2 13.2 8.2l51.1-25.5c5-2.5 9.5 4.1 5.4 7.9L7.3 473.4C2.7 477.6 0 483.6 0 489.9C0 502.1 9.9 512 22.1 512l173.3 0c38.8 0 75.9-15.4 103.4-42.8c30.6-30.6 45.9-73.1 42.3-115.8z"/></svg>
    </button>
    @endif 
  </div>
</div>
