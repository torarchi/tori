<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'location',
        'image',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getName(){
        if ($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        }
        if ($this->first_name) {
            return $this->first_name;
        }
        return null;
    }

    public function getNameOrUsername(){
        return $this->getName() ?: $this->username;
    }

    public function getFirstNameOrUsername(){
        return $this->first_name ?: $this->username;
    }

    public function statuses(){
        return $this->hasMany('App\Models\Status', 'user_id');
    }

    public function getAvatarUrl(){
        if ($this->image) {
            return asset($this->image);
        } else {
            return "https://www.gravatar.com/avatar/{{ md5($this->email) }}?d=mm&s=70";
        }

    }

    public function friendOfMine(){
        return $this->belongsToMany('App\Models\User', 'friends', 'user_id', 'friends_id');
    }

    public function friendOf(){
        return $this->belongsToMany('App\Models\User', 'friends', 'friends_id', 'user_id');
    }

    public function friends(){
        return $this->friendOfMine()->wherePivot('accepted', true)->get()->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }

    public function friendRequest(){
        return $this->friendOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestPending(){
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user){
        return (bool) $this->friendRequestPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user){
        return (bool) $this->friendRequest()->where('id', $user->id)->count();
    }

    public function addFriend(User $user){
        $this->friendOf()->attach($user->id);
    }

    public function deleteFriend(User $user){
        $this->friendOf()->detach($user->id);
        $this->friendOfMine()->detach($user->id);
    }

    public function acceptFriendRequest(User $user){
        $this->friendRequest()->where('id', $user->id)->first()->pivot->update([
            'accepted' => true,
        ]);
    }

    public function isFriendWith(User $user){
        return (bool) $this->friends()->where('id', $user->id)->count();
    }




}
