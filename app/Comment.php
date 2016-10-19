<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  public static function find($key) {
    try {
      $query = \DB::select("SELECT u.username, c.detail
                        FROM comment c, users u
                        WHERE c.t_id = :id
                        AND c.u_id = u.id",
      [
          'id' => $key,
      ]);


    } catch(QueryException $e) {
      return false;
    }

    dd($query);
    return $comment;
  }
}
