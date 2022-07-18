<?php
   
namespace App\Console\Commands;
   
use Illuminate\Console\Command;
use App\Models\Task\Task;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon as Carbon;
   
class TaskCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:cron';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cykliczna aktualizacja statusu zadań.';
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tasks = Task::all();
        
        foreach ($tasks as $task) {
            if(Carbon::parse($task->start)->lessThan(Carbon::now())){
                    $task->status = 3;
                } else if(Carbon::parse($task->start)->greaterThan(Carbon::now()) && Carbon::parse($task->start)->lessThan(Carbon::now()->addDays(30))){
                    $task->status = 2;
                } else if(Carbon::parse($task->start) < Carbon::now()->addDays(30)){
                    $task->status = 1;
                } else {
                    $task->status = 0;
                }

                $task->save();
        }
        
        Log::debug(Carbon::now().': Statusy zadań zaktualizowane.');
    }
}