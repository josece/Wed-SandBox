<?php
 
class Profile extends Eloquent {
 
 	/*
	* Definicion de relaciones
	*/
    public function user()
    {
        return $this->belongsTo('User');
    }
	
}
