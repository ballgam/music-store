<?php 

class Album extends Eloquent
{

protected $fillable = array(
		'name',
		);

	public static function rules ($id=0) {
		return  [
		'name'					=>	'required|max:30',
		];
	}

	protected $table = 'albums';

	public function artist()
	{
		return $this->belongsTo('Artist');
	}

	public function tracks()
	{
		return $this->hasMany('Track');
	}

}