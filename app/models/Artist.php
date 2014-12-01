<?php 

class Artist extends Eloquent
{

protected $fillable = array(
		'name',
		'about',
		);

	public static function rules ($id=0) {
		return  [
		'name'					=>	'required|max:30',
		'about'					=>	'required|max:50',
		];
	}

	protected $table = 'artists';

	public function albums()
	{
		return $this->hasMany('Album');
	}

	public function tracks()
	{
		return $this->hasMany('Track');
	}

}