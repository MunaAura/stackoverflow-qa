<?php
namespace App;
trait VotableTrait{
    public function votes()
    {
        return $this->morphToMany(User::class,'votable');
    }
    public function upVotes()
    {
        $this->votes()->wherePivot('vote',1);
    }
    public function downVotes()
    {
        $this->votes()->wherePivot('vote',-1);
    }
}