<div>
    <div x-data="{showButtons : false}" wire:key="{{ $task->id }}" x-on:click="showButtons = !showButtons" x-on:mousedown.outside="showButtons = false" class="bg-base-100 w-96 border bg-{{$task->color}}/25 border-{{$task->color}}/35 rounded-lg py-2 px-4 text-left  hover:shadow hover:cursor-pointer">
        <div class="flex justify-between items-center">
          <div>
            <p class="font-semibold">{{$task->title}} </p>


            @if($task->due_date)
            <p class="text-xs flex text-gray-600 items-center">
              <svg class="h-3 w-3 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z" clip-rule="evenodd" />
              </svg>    
                      
              {{  Carbon\Carbon::today()->diffInDays($task->due_date) == 0 ? 'today' : $task->due_date->diffForHumans() }}
            </p>
            @endif
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

          
          <a href="{{url('app/'.Str::of($task->taskList->title)->slug)}}" wire:navigate class="badge badge-xs badge-neutral p-2 hover:badge-primary">{{$task->taskList->title}}</a>

          <div class="flex flex-row justify-end gap-1">
            <button class="btn btn-sm btn-circle btn-ghost hover:bg-base-content hover:text-white">
              <svg  class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
              </svg>
            </button>
            <button wire:click="delete()" class="btn  btn-sm btn-circle btn-ghost hover:bg-error hover:text-white">
              <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>
          
          
          
          
        </div>
        
    </div>
</div>
