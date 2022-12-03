<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first',
        'honorific_id',
        'last',
        'middle',
        'email',
        'password',
        'suffix',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * eager loading
     */
    protected $with = [
        'person','person.school',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function accepted(): bool
    {
        return (bool)$this->hasMany(Accepted::class)
            ->where('event_id', CurrentEvent::currentEvent()->id)->first();
    }

    public function getAcceptedStatusAttribute(): string
    {
        return (Accepted::where('user_id', $this->id)->where('event_id', CurrentEvent::currentEvent()->id)->exists())
            ? 'accepted'
            : 'accept';
    }

    public function getApplicationStatusAttribute(): bool
    {
        $eventid = CurrentEvent::currentEvent()->id;

        return EventSchool::where('school_id',$this->person->school_id)
            ->where('event_id', $eventid)
            ->exists();
    }

    public function getEventInvitationsAttribute(): Collection
    {
        return Invitation::where('user_id', $this->id)
            ->where('event_id', CurrentEvent::currentEvent()->id)
            ->get();
    }

    public function getEventInvitationsButtonTitleAttribute(): string
    {
        $crlf = " \x0A ";
        //Check for pending invitation emails
        $pendingemails = $this->pendingemails->where('pendingemailtype_id', Pendingemailtype::INVITATION);
        $str = 'Invitations: ';
        $str .= ($pendingemails->count()) ? 'Pending: '.$pendingemails->count().$crlf : "None Pending".$crlf;

        //Check for invitation emails sent
        $count = $this->getEventInvitationsCountAttribute();

        //early exit
        if (!$count) {
            return $str;
        }

        //Check for sent invitations
        $a = [];
        foreach ($this->getEventInvitationsAttribute() as $invitation){
            $a[] = $invitation->humanUpdatedAt;
        }

        $str .= ($count > 1) ? "Invitations Sent: " : "Invitation Sent: ";
        $str .= implode($crlf,$a);

        return $str;
    }

    public function getEventInvitationsCountAttribute(): int
    {
        return Invitation::where('user_id', $this->id)
            ->where('event_id', CurrentEvent::currentEvent()->id)
            ->count();
    }

    public function getInvitationStatusAttribute(): string
    {
        $eventid = CurrentEvent::currentEvent()->id;

        if(Pendingemail::where('user_id', $this->id)->where('pendingemailtype_id', Pendingemailtype::INVITATION)->count()){

            return 'pending';
        }

        if(Invitation::where('user_id', $this->id)->where('event_id', $eventid)->count()){
            return 'invited';
        }

        return 'invite';
    }

    public function getNameAlphaAttribute() : string
    {
        return $this->last
            . (strlen($this->suffix) ? ' '.$this->suffix : '')
            . ', '.$this->first
            . (strlen($this->middle) ? ' '.$this->middle : '')
            . ' ('.$this->honorific->descr.')';
    }

    public function getNameFullAttribute() : string
    {
        return $this->honorific->descr.' '
            . $this->first.' '
            . (strlen($this->middle) ? $this->middle.' ' : '')
            . $this->last
            . (strlen($this->suffix) ? ' '.$this->suffix : '');
    }

    public function getIsAdminAttribute() : bool
    {
        return (bool)(
            $this->roles->where('id',ROLE::OWNER)->first() ||
            $this->roles->where('id', ROLE::LEADTEACHER)->first() ||
            $this->roles->where('id', ROLE::EVENTADMIN)->first()
        );
    }

    public function getPhoneMobileAttribute() : string
    {
        return  Phone::where('user_id', $this->id)
            ->where('mobile',1)
            ->exists()
            ? Phone::where('user_id', $this->id)->where('mobile',1)->first()->phone
            : 'none';
    }

    public function getPhoneWorkAttribute() : string
    {
        return Phone::where('user_id', $this->id)
            ->where('mobile',0)
            ->exists()
            ? Phone::where('user_id', $this->id)->where('mobile',0)->first()->phone
            : 'none';
    }

    public function getWithdrawStatusAttribute(): string
    {
        return (Withdraw::where('user_id', $this->id)->where('event_id', CurrentEvent::currentEvent()->id)->exists())
            ? 'withdrew'
            : 'withdraw';
    }

    public function honorific()
    {
        return $this->belongsTo(Honorific::class);
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function pendingemails()
    {
        return $this->hasMany(Pendingemail::class);
    }

    public function person()
    {
        return $this->hasOne(Person::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)
            ->withPivot('event_id');
    }

    public function school()
    {
        return School::find($this->person->school_id);
    }

}
