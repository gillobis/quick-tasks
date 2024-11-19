<div wire:ignore>    
  <dialog id="modal_create_tasks_list" class="modal" >
    <div class="modal-box">
      <h3 class="text-lg font-bold">Create a new list</h3>
        <input wire:model="title" required type="text" placeholder="List name" class="input w-full mt-2" @error('title') input-error @enderror />
        @error('title') <span class="text-error">{{ $message }}</span> @enderror 
      
        <div class="modal-action">        
          <form method="dialog">
            <button class="btn btn-success text-white" wire:click="createTasksList">Create</button>
            <!-- if there is a button in form, it will close the modal -->
            <button class="btn">Close</button>
          </form>
        </div>         
    </div>
    <form method="dialog"  class="modal-backdrop">
      <button>close</button>
    </form>
  </dialog>
</div>
