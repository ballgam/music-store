<?php

class MusicStoreController extends \BaseController {

	public function artist_index()
	{
		$artists = Artist::where('active', '=', 1)->paginate(PAGE_SIZE);

		return View::make('music.artist-index', compact('artists'));
	}

	public function artist_store()
	{
		//die('artist store');
		$data = Input::all();
		$validator = Validator::make($data, Artist::rules());

		if($validator->passes())
		{
			$artist = Artist::create($data);
			if($artist)
			{
				return Redirect::route('music-artist')
				->with('message', 'New artist added successfully')
				->with('type', 'success');
			}
			else
			{
				return Redirect::route('music-artist')
				->with('message', 'An error occured while saving the record. Please try again later')
				->with('type', 'danger');
			}
		}
		else
		{
			return Redirect::route('music-artist')
			->withInputs()
			->withErrors($validator)
			->with('message', 'Invalid entries. Please try again later')
			->with('type', 'danger');
		}
	}

	public function artist_update($artist_id)
	{
		$data = Input::all();
		$validator = Validator::make($data, Artist::rules());

		if($validator->passes())
		{
			$artist = Artist::find($artist_id);
			if($artist)
			{
				$artist->name = $data['name'];
				$artist->about = $data['about'];
				$artist->save();

				return Redirect::route('music-artist')
				->with('message', 'Artist updated successfully')
				->with('type', 'success');
			}
			else
			{
				return Redirect::route('music-artist')
				->with('message', 'The specified artist cannot be found')
				->with('type', 'danger');
			}
		}
		else
		{
			return Redirect::route('music-artist')
			->withInputs()
			->withErrors($validator)
			->with('message', 'Invalid entries. Please try again later')
			->with('type', 'danger');
		}
	}

	public function album_index($artist_id)
	{
		$artist = Artist::find($artist_id);
		if($artist)
		{
			$albums = $artist->albums()->with('artist')->where('active', '=', 1)->paginate(PAGE_SIZE);
			return View::make('music.album-index', compact('albums'))
			->with('artist_id', $artist_id)
			->with('artist_name', $artist->name);
		}
		else
		{
			abort(404);
		}
	}

	public function track_index($artist_id, $album_id)
	{
		$album = Album::find($album_id);
		//var_dump(DB::getQueryLog());die();
		$tracks = Track::join('albums', 'albums.id', '=', 'tracks.album_id')
		->join('artists', 'artists.id', '=', 'albums.artist_id')
		->select(array(
			'tracks.id',
			'albums.name as album_name',
			'tracks.name as track_name',
			'artists.name as artist_name'))
		->where('tracks.artist_id', '=', $artist_id)
		->where('tracks.album_id', '=', $album_id)
		->paginate(PAGE_SIZE);

			//var_dump($tracks);die();
		return View::make('music.track-index', compact('tracks'))
		->with('artist_id', $artist_id)
		->with('album_id', $album_id)
		->with('artist_name', $album->artist->name)
		->with('album_name', $album->name);
	}

	public function track_store($artist_id, $album_id)
	{
		$data = Input::all();
		$validator = Validator::make($data, Album::rules());

		if($validator->passes())
		{
			$album = Album::find($album_id);
			if($album)
			{
				$track = new Track(array(
					'name' 		=> 	$data['name'],
					'artist_id'	=>	$album->artist->id));

				//var_dump($track);die();
				$album->tracks()->save($track);
				return Redirect::route('music-tracks', array('artist_id' => $artist_id, 'album_id' => $album_id))
				->with('message', 'New Track added successfully')
				->with('type', 'success');
			}
			else
			{
				return Redirect::route('music-tracks', array('artist_id' => $artist_id, 'album_id' => $album_id))
				->with('message', 'Cannot add track to the album because the specified album does not exist')
				->with('type', 'success');
			}
		}
		else
		{
			return Redirect::route('music-tracks', array('artist_id' => $artist_id, 'album_id' => $album_id))
			->withInputs()
			->withErrors($validator)
			->with('message', 'Invalid entries. Please try again later')
			->with('type', 'danger');
		}
	}

	public function track_update($artist_id, $album_id, $track_id)
	{
		$data = Input::all();
		$validator = Validator::make($data, Track::rules());

		if($validator->passes())
		{
			$track = Track::find($track_id);
			if($track)
			{
				$track->name = $data['name'];
				$track->save();

				return Redirect::route('music-tracks', array('artist_id' => $artist_id, 'album_id' => $album_id))
				->with('message', 'track updated successfully')
				->with('type', 'success');
			}
			else
			{
				return Redirect::route('music-tracks', array('artist_id' => $artist_id, 'album_id' => $album_id))
				->with('message', 'The specified track cannot be found')
				->with('type', 'danger');
			}
		}
		else
		{
			return Redirect::route('music-tracks', array('artist_id' => $artist_id, 'album_id' => $album_id))
			->withInputs()
			->withErrors($validator)
			->with('message', 'Invalid entries. Please try again later')
			->with('type', 'danger');
		}
	}

	public function album_store($artist_id)
	{
		//die('album store');
		$data = Input::all();
		$validator = Validator::make($data, Album::rules());

		if($validator->passes())
		{
			$artist = Artist::find($artist_id);
			$album = new Album(array('name' => $data['name']));

			$artist->albums()->save($album);
			return Redirect::route('music-albums', array('artist_id' => $artist_id))
			->with('message', 'New Album added successfully')
			->with('type', 'success');
		}
		else
		{
			return Redirect::route('music-albums', array('artist_id' => $artist_id))
			->withInputs()
			->withErrors($validator)
			->with('message', 'Invalid entries. Please try again later')
			->with('type', 'danger');
		}
	}

	public function album_update($artist_id, $album_id)
	{
		$data = Input::all();
		$validator = Validator::make($data, Album::rules());

		if($validator->passes())
		{
			$album = Album::find($album_id);
			if($album)
			{
				$album->name = $data['name'];
				$album->save();

				return Redirect::route('music-albums', array('artist_id' => $artist_id))
				->with('message', 'Album updated successfully')
				->with('type', 'success');
			}
			else
			{
				return Redirect::route('music-albums', array('artist_id' => $artist_id))
				->with('message', 'The specified album cannot be found')
				->with('type', 'danger');
			}
		}
		else
		{
			return Redirect::route('music-albums', array('artist_id' => $artist_id))
			->withInputs()
			->withErrors($validator)
			->with('message', 'Invalid entries. Please try again later')
			->with('type', 'danger');
		}
	}

	public function artist_destroy($artist_id)
	{
		$artist = Artist::find($artist_id);
		if($artist)
		{
			$artist->active = 0;
			$artist->save();

			return Redirect::route('music-artist')
			->with('message', '\'' .  $artist->name . '\'' . ' removed successfully.')
			->with('type', 'success');
		}
		else
		{
			abort(404);
		}
	}

	public function album_destroy($artist_id, $album_id)
	{
		$album = Album::find($album_id);
		if($album)
		{
			$album->active = 0;
			$album->save();

			return Redirect::route('music-albums', array('artist_id' => $artist_id))
			->with('message', '\'' .  $album->name . '\'' . ' album removed successfully.')
			->with('type', 'success');
		}
		else
		{
			return Redirect::route('music-albums', array('artist_id' => $artist_id))
			->with('message', 'Could not find the specified record')
			->with('type', 'warning');
		}
	}

	public function track_destroy($artist_id, $album_id, $track_id)
	{
		$track = Track::find($track_id);
		if($track)
		{
			$track->delete();

			return Redirect::route('music-tracks', array('artist_id' => $artist_id, 'album_id' => $album_id))
			->with('message', '\'' .  $track->name . '\'' . ' deleted successfully.')
			->with('type', 'success');
		}
		else
		{
			return Redirect::route('music-albums', array('artist_id' => $artist_id))
			->with('message', 'Could not find the specified record')
			->with('type', 'warning');
		}
	}


	public function api_get_albums()
	{

	}

	public function api_get_albums()
	{

	}

	public function api_get_tracks()
	{

	}
	
	public function api_get_artist_by_id($artist_id)
	{
		$artist = Artist::find($artist_id);

		return Response::json($artist);
	}

	public function api_get_album_by_id($album_id)
	{
		$album = Album::find($album_id);

		$data = array(
			'id'			=> 	$album_id,
			'name' 			=> 	$album->name,
			'artist_name'	=>	$album->artist->name);

		return Response::json($data);
	}

	public function api_get_track_by_id($track_id)
	{
		$track = Track::find($track_id);

		$data = array(
			'id'			=> 	$track_id,
			'name'			=>	$track->name,
			'artist_name'	=> 	$track->artist->name,
			'album_name'	=>	$track->album->name);

		return Response::json($data);
	}

}
