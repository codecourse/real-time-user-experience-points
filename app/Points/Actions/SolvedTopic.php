<?php

namespace App\Points\Actions;

use App\Points\Actions\ActionAbstract;

class SolvedTopic extends ActionAbstract
{
    public function key()
    {
        return 'solved-topic';
    }
}
