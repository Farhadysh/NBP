<?php

namespace App\Jobs;

use App\Position;
use App\User;
use App\WalletLog;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class mlm implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $positions = new Position();
        $positions = $positions->get();

        foreach ($positions as $position) {
            if ($position->r_hand >= 1 && $position->l_hand >= 1) {
                $r_hand_k = intdiv($position->r_hand, 1);
                $l_hand_k = intdiv($position->l_hand, 1);

                while ($r_hand_k >= 1 && $l_hand_k >= 1) {
                    $position->wallet += 130000;
                    $position->save();

                    WalletLog::create([
                        'user_id' => $position->user_id,
                        'price' => 130000,
                        'subject' => 'پاداش مشاور',
                    ]);

                    $r_hand_k--;
                    $l_hand_k--;
                }

                $r_hand_b = fmod($position->r_hand, 1);
                $l_hand_b = fmod($position->l_hand, 1);

                $position->r_hand = $r_hand_k * 1;
                $position->l_hand = $l_hand_k * 1;
                $position->save();

                $position->r_hand += $r_hand_b;
                $position->l_hand += $l_hand_b;
                $position->save();
            }
        }
    }
}
