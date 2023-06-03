<?php

declare(strict_types=1);

namespace App\Notifications\Traits;


trait OptOutable
{
    public function via($notifiable)
    {
        if ($this->optOut($notifiable)) {
            return [];
        }

        return ['mail'];
    }

    public function optOut($notifiable)
    {
        return false;
    }
}
