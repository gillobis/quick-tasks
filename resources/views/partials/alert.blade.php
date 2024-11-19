{{-- feeback alert --}}
<div x-data="{show:false, message : ''}" x-cloak x-transition:enter.duration.200ms x-transition:leave.opacity.duration.500ms  x-show="show" role="alert" class="alert py-2 alert-info absolute top-2 w-fit right-2 flex text-white"
    @notify.window="show = true; message = $event.detail.message; setTimeout(() => { message = ''; show = false }, 1500)">
<svg
    xmlns="http://www.w3.org/2000/svg"
    class="h-6 w-6 shrink-0 stroke-current"
    fill="none"
    viewBox="0 0 24 24">
    <path
    stroke-linecap="round"
    stroke-linejoin="round"
    stroke-width="2"
    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>
<span x-text="message"></span>
</div>