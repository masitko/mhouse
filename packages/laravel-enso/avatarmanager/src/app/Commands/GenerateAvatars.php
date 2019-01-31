<?php

namespace LaravelEnso\AvatarManager\app\Commands;

use Illuminate\Console\Command;
use LaravelEnso\Core\app\Models\User;

class GenerateAvatars extends Command
{
    protected $signature = 'enso:avatars:generate';

    protected $description = 'Generates missing avatars for users';

    public function handle()
    {
        auth()->onceUsingId(User::first()->id);

        User::doesntHave('avatar')
            ->get()
            ->each
            ->generateAvatar();

        $this->info('Avatars generated successfully');
    }
}
