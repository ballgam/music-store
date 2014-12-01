<?php 

class Track extends Eloquent
{

protected $fillable = array(
		'name',
		'artist_id'
		);

	public static function rules ($id=0) {
		return  [
		'name'					=>	'required|max:30',
		];
	}

	protected $table = 'tracks';

	public function artist()
	{
		return $this->belongsTo('Artist');
	}

	public function album()
	{
		return $this->belongsTo('Album');
	}

}