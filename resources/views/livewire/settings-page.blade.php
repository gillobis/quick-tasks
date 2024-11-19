@section('title', 'Settings')

<div>
    <div class="p-6 sm:ml-64 mb-10">
        <form wire:submit="save()">
            <div class="space-y-12">

                <div class="border-b border-gray-900/10 pb-12">
                    <div class="text-center"><h1 class="text-2xl font-bold leading-7 text-gray-900">Settings</h1></div>
                    


                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 ">

                        @if (session('message'))
                            <div class="alert alert-success text-white">
                                {{ session('message') }}
                            </div>
                        @endif
                        {{-- <div class="sm:col-span-4">
                            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                            <div class="mt-2">                            
                                <input type="text" name="username" id="username" autocomplete="username" class="input input-bordered" placeholder="" required>
                            </div>
                        </div> --}}

                        {{-- <div class="col-span-full">
                            <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Photo</label>
                            <div class="mt-2 flex items-center gap-x-3">
                                <svg class="h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                                </svg>
                                <button type="button" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Change</button>
                            </div>
                        </div> --}}

                        <div class="sm:col-span-4">
                            <label for="email" class="block text-base font-semibold leading-6 text-gray-900">Email</label>
                            <div class="mt-2">                            
                                <input type="email" name="email" id="email" autocomplete="email" class="input input-bordered w-full" placeholder="" wire:model="email" required>
                                @error('email') <span class="text-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Notifications</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">We'll always let you know about tasks that are about to expire or some other important events.</p>
                    
                    <div class="mt-10 space-y-10">
                        <fieldset>                           
                            <div class="space-y-6">
                                <div class="relative flex gap-x-3">
                                    <div class="flex h-6 items-center">
                                        <input wire:model="notifyEmail" value="1" @if($notifyEmail) checked @endif  id="comments" name="comments" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                    </div>
                                    <div class="text-sm leading-6">
                                        <label for="comments" class="font-medium text-gray-900">Email</label>                                       
                                    </div>
                                </div>
                                <div class="relative flex gap-x-3">
                                    <div class="flex h-6 items-center">
                                        <input disabled id="candidates" name="candidates" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                    </div>
                                    <div class="text-sm leading-6">
                                        <label for="candidates" class="font-medium text-gray-400">Push notifications (coming soon)</label>
                                    </div>
                                </div>
                                
                            </div>
                        </fieldset>                        
                    </div>
                </div>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <button type="button" wire:click="deleteUser()" wire:confirm="Are you sure to delete your profile? (This action is irreversible)" class="btn btn-error btn-sm text-white">Delete profile</button>
                    <div class="flex justify-end  gap-x-3">
                        <a href="{{route('dashboard')}}" wire:navigate type="button" class="btn btn-ghost btn-sm">Cancel</a>
                        <button type="submit" class="btn btn-sm btn-success text-white">Save</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
