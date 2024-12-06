<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use App\Livewire\Task\AddForm;
use App\Models\Task;
use Carbon\Carbon;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;




uses(RefreshDatabase::class);



    it('can create task', function () {
        $user = User::factory()->create();
     
        actingAs($user);
          
        // Assume form was submitted
        Livewire::test(AddForm::class)
            ->set('title', 'Wrinkly fingers? Try this one weird trick')
            ->set('priority', 1)
            ->set('taskList', $user->taskLists()->first())
            ->set('dueDate', Carbon::tomorrow()->format('d/m/Y'))
            ->call('save');

        // Ensure the task was created in the database for the User
        $this->assertEquals(1, $user->tasks()->count());
    });


it('can update task',function(){
    $user = User::factory()->create();
    $task = Task::factory()->create([
        'user_id' => $user->id,
        'task_list_id' => $user->taskLists()->first()->id
    ]);

    actingAs($user);

    // Make sure the form loads for our User
    get(route('task.edit', $task))
        ->assertStatus(200);

    
});
