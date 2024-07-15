<?php

namespace App\Console\Commands;

use App\Models\VehicleEvent;
use App\Notifications\CalendarEvent;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CalendarCheckEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calendar:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email with next events.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $events = VehicleEvent::with([
            'vehicle_event_warning_time',
            'vehicle_item.vehicle_brand',
            'vehicle_item.vehicle_model',
            'vehicle_event_type'
        ])
            ->where([
                'sent' => 0
            ])
            ->get();
    
        foreach ($events as $event) {
            $days = $event->vehicle_event_warning_time->days;
            $limit = Carbon::now()->addDays($days)->format('Y-m-d H:i:s');
            if($event->date < $limit){
                //SEND EMAIL
                \App\Models\User::find(2)->notify(new CalendarEvent($event));
                //FLAG AS SEND
                $event->sent = true;
                $event->save();
            }
        }
        
        return Command::SUCCESS;
    }
}
