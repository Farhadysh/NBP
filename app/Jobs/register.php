<?php

namespace App\Jobs;


use App\Position;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class register implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;

    protected $position;

    /**
     * Create a new job instance.
     *
     * @param Position $position
     */
    public function __construct(Position $position)
    {
        $this->position = $position;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $positions = new Position();
        $count = $positions->where('Consultant_code',
            $this->position->Consultant_code)->count();
        $parent = $this->position->load('allParent');

        if ($count == 1) {
            $this->position->hand_id = 1;
            $this->position->save();
        } else if ($count == 2) {
            $this->position->hand_id = 2;
            $this->position->save();
        }

        while ($parent) {
            if ($parent->parent) {
                if ($parent->hand_id == 1) {
                    $parent->parent->r_hand++;
                    $parent->parent->rightCount++;
                    $parent->parent->save();
                } else if ($parent->hand_id == 2) {
                    $parent->parent->l_hand++;
                    $parent->parent->leftCount++;
                    $parent->parent->save();
                }
            }
            $parent = $parent->parent;
        }
    }
}
