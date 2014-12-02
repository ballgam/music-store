<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $fillable = array(
		'username',
		'password',
		'email',
		'active',
		);

	public static function rules ($id=0) {
		return  [
		'username'		=>	'required|max:20|unique:users'. ($id ? ",$id" : ''),
		'email'			=>	'required|email|max:20|unique:users'. ($id ? ",$id" : ''),
		'password'    		=>	'required|max:60|min:6',
		'password_again'	=>	'required|same:password',
		'active'		=>	'required|integer'
		];
	}

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

}
