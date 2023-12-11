<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Room_Reservation;
use Carbon\Carbon;

class DeleteBook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'book:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $books=Room_Reservation::where('confirmed',false)->get();

        foreach($books as $book)
        {
            $o=$book->created_at;
            $b= Carbon::now()->subDays(3);
            if( $o< $b){
            $book->delete();
            }
        }
    }
}
