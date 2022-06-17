<?php

namespace App\Services;


use App\Events\AdminInvitationEvent;
use App\Models\Pendingemailtype;
use App\Models\User;

class TransactionEmailService
{
    private $pendingemailtypedescr;
    private $user;

    public function __construct(Pendingemailtype $pendingemailtype, User $user)
    {
        $this->pendingemailtypedescr = $pendingemailtype->descr;
        $this->user = $user;

        //ex. invitation, etc
        $this->{$this->pendingemailtypedescr}($user);
    }

    private function invitation(User $user)
    {
        $sent = event(new AdminInvitationEvent($user));
    }
}
