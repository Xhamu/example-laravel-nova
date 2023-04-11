<?php

namespace App\Observers;

use App\Models\User;
use Laravel\Nova\Notifications\NovaNotification;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if ($user->hasRole('admin')) {
            $this->getNovaNotification($user, 'Nuevo usuario: ', 'success');
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        $this->getNovaNotification($user, 'Usuario actualizado: ', 'info');
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $this->getNovaNotification($user, 'Usuario borrado: ', 'warning');
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        $this->getNovaNotification($user, 'Usuario reestablecido: ', 'success');
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        $this->getNovaNotification($user, 'Usuario borrado de forma permanente: ', 'error');
    }

    private function getNovaNotification($user, $message, $type): void
    {
        foreach (User::all() as $u) {
            $u->notify(NovaNotification::make()
                ->message($message . ' ' . $user->name)
                ->icon('user')
                ->type($type));
        }
    }
}
