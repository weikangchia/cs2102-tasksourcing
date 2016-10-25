<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  public static function findByTaskId($task_id) {
    try {
      $query = \DB::select("SELECT u.username, c.detail, c.posted_date, u.profile_photo
                        FROM comment c, users u
                        WHERE c.t_id = :t_id
                        AND c.u_id = u.id",
      [
          't_id' => $task_id,
      ]);
    } catch(QueryException $e) {
      return false;
    }
    return $query;
  }
}