<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array(
	'as'	=>	'home',
	'uses'	=>	'MusicStoreController@artist_index'
	));

Route::group(array('prefix' => 'music'), function(){

	Route::get('artists', array(
		'as'	=>	'music-artist',
		'uses'	=>	'MusicStoreController@artist_index'
		));

	Route::get('artists', array(
		'as'	=>	'music-artist',
		'uses'	=>	'MusicStoreController@artist_index'
		));

	Route::get('albums', array(
		'as'	=>	'music-albums-all',
		'uses'	=>	'MusicStoreController@albums_index'
		));

	Route::get('tracks', array(
		'as'	=>	'music-tracks-all',
		'uses'	=>	'MusicStoreController@tracks_index'
		));

	Route::get('artists/{artist_id}/albums', array(
		'as'	=>	'music-albums',
		'uses'	=>	'MusicStoreController@artist_album_index'
		));

	Route::get('artists/{artist_id}/albums/{album_id}/tracks', array(
		'as'	=>	'music-tracks',
		'uses'	=>	'MusicStoreController@album_track_index'
		));


	Route::get('api/artists', array(
		'as'	=>	'api-artists',
		'uses'	=>	'MusicStoreController@api_get_artists'
		));

	Route::get('api/albums', array(
		'as'	=>	'api-albums',
		'uses'	=>	'MusicStoreController@api_get_albums'
		));

	Route::get('api/tracks', array(
		'as'	=>	'api-tracks',
		'uses'	=>	'MusicStoreController@api_get_tracks'
		));

	Route::get('api/albums/get/{album_id}', array(
		'as'	=>	'api-tracks',
		'uses'	=>	'MusicStoreController@api_get_tracks'
		));

	Route::get('api/tracks/get/{track_id}', array(
		'as'	=>	'api-track-by-id',
		'uses'	=>	'MusicStoreController@api_get_track_by_id'
		));

	Route::group(array('before' => 'csrf'), function(){
		Route::post('artists', array(
			'as'	=>	'music-artist',
			'uses'	=>	'MusicStoreController@artist_store'
			));

		Route::post('albums', array(
			'as'	=>	'music-albums-all',
			'uses'	=>	'MusicStoreController@albums_search'
			));

		Route::post('artists/{artist_id}', array(
			'as'	=>	'music-artist-update',
			'uses'	=>	'MusicStoreController@artist_update'
			));

		Route::post('artists/delete/{artist_id}', array(
			'as'	=>	'music-artist-delete',
			'uses'	=>	'MusicStoreController@artist_destroy'
			));

		Route::post('artists/{artist_id}/albums', array(
			'as'	=>	'music-albums',
			'uses'	=>	'MusicStoreController@album_store'
			));

		Route::post('artists/{artist_id}/albums/{album_id}', array(
			'as'	=>	'music-albums-update',
			'uses'	=>	'MusicStoreController@album_update'
			));

		Route::post('artists/{artist_id}/albums/delete/{album_id}', array(
			'as'	=>	'music-albums-update',
			'uses'	=>	'MusicStoreController@album_destroy'
			));

		Route::post('artists/{artist_id}/albums/{album_id}/tracks', array(
			'as'	=>	'music-tracks',
			'uses'	=>	'MusicStoreController@track_store'
			));

		Route::post('artists/{artist_id}/albums/{album_id}/tracks/{track_id}', array(
			'as'	=>	'music-tracks-update',
			'uses'	=>	'MusicStoreController@track_update'
			));

		Route::post('artists/{artist_id}/albums/{album_id}/tracks/delete/{track_id}', array(
			'as'	=>	'music-tracks-delete',
			'uses'	=>	'MusicStoreController@track_destroy'
			));

	});

});

define('PAGE_SIZE', 10);
