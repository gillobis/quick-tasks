<div>
  <div class="p-4 sm:ml-64 text-center">
    <div class="flex flex-col justify-center items-center mb-4 p-2" >
      <div class="card card-compact bg-base-100 w-full md:max-w-sm shadow-md card-bordered" >
        <div class="card-body">         
          <input wire:model="title" x-ref="text" type="text" placeholder="Add a new task..." class="input w-full @error('title') input-error @enderror" />
          @error('title') <span class="text-error">{{ $message }}</span> @enderror 
          <div class="flex gap-1">      
            
            {{-- task list --}}
            <details class="dropdown"  @mousedown.outside="$el.removeAttribute('open'); showInput = false">
              <summary class="btn btn-outline btn-xs border-gray-300 font-normal">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                </svg>
                {{$taskList->title}}
                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>                
              </summary>
              <ul  tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-1 text-sm shadow"  >
                @foreach(App\Models\TaskList::all() as $list)
                <li>
                  <a wire:click="setTaskList({{$list->id}})">{{ $list->title  }}</a>
                </li>
                @endforeach
                <li>
                  <a onclick="modal_create_tasks_list.showModal()"> 
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>                  
                    New list
                  </a>                
                </li>          
              </ul>
            </details>

            {{-- priority --}}
            <details class="dropdown" @mousedown.outside="$el.removeAttribute('open')">
              <summary tabindex="0" role="button" class="btn btn-outline btn-xs text-{{ App\Services\PriorityLevelService::getColor($priority) }}  border-gray-300  font-normal">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                </svg>            
                {{ App\Services\PriorityLevelService::getText($priority) }}
              </summary>
              <ul  tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-1 text-sm shadow"  >
                @foreach(App\Enums\EnumLevel::values() as $key=>$value)
                <li class="{{ App\Enums\LevelColor::{$value}  }}">
                  <a wire:click="$set('priority', {{$key}})"> 
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                    </svg> {{$value}}
                  </a>
                </li>
                @endforeach
              </ul>
            </details>
          </div>
          <div class="card-actions">          
            <div class="flex justify-between w-full items-end">
              <x-date wire:model="dueDate" placeholder="Due date" class="input-xs mt-0 text-black" format="DD/MM/YYYY" />
              {{-- <button class="btn btn-outline btn-xs">
              <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
              </svg>            
              Due date
            </button> --}}

              <button type="button" class="btn btn-primary btn-sm" wire:click="save()">Save</button>
            </div>          
          </div>
        </div>
        
      </div>

      

      <a href="{{ url()->previous() }}" wire:navigate class="btn mt-4">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
        </svg>
        
        Back
      </a>
    </div>
  </div>

  @livewire('task.create-tasks-list')

</div>