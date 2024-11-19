<div>
  The task {{$task->title}} is expiring in {{ Carbon\Carbon::today()->diffInDays($task->due_date) }} days!
</div>
<a href="">link</a>