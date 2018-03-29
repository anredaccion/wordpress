<?php

/*
** TODO:
** - Modificar la función para que se pueda utilizar sin pasar el post id
*/
class Deduplicator {
	private static $published = array();

	public static function add($id) {
		if ( !in_array( $id, self::$published ) )
			array_push( self::$published, $id );
	}

	public static function get() {
		return self::$published;
	}
}