<div>
    <div x-data="{showButtons : false}" x-on:click="showButtons = !showButtons" x-on:mousedown.outside="showButtons = false" class="bg-base-100 w-96 border bg-{{App\Services\PriorityLevelService::getColor($task['level'])}}/25 border-{{App\Services\PriorityLevelService::getColor($task['level'])}}/35 rounded-lg py-2 px-4 text-left  hover:shadow hover:cursor-pointer">
        <div class="flex justify-between items-center">
          <div>
            <p class="font-semibold">{{$task['title']}} </p>
            
          </div>          
          
        </div>

        {{-- buttons --}}
        <div x-cloak x-show="showButtons" class="flex flex-row justify-end items-center mt-2" x-transition.opacity>

          <div class="flex flex-row justify-end gap-1">
            <button wire:click="restore()" wire:confirm="Do you want to restore this task?" class="btn btn-sm btn-circle btn-ghost hover:bg-base-content hover:text-white">
              <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m15 15-6 6m0 0-6-6m6 6V9a6 6 0 0 1 12 0v3" />
              </svg>
              
            </button>
            <button wire:click="delete()" wire:confirm="Are you sure you want to permanently delete this task?" class="btn  btn-sm btn-circle btn-ghost hover:bg-error hover:text-white">
              <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>
          
        </div>
        
    </div>
</div>
