<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    public static function find($task_id, $user_id)
    {
        try {
            $query = \DB::select("SELECT * FROM bid WHERE u_id = :u_id AND t_id = :t_id",
            [
                'u_id' => $user_id,
                't_id' => $task_id
            ]);
        } catch(QueryException $e) {
            return false;
        }

        return $query;
    }

    public static function findAllTaskBidders($task_id) {
        try{
            $query = \DB::select("SELECT b.status, b.id AS b_id, b.bid_amount, u.id AS u_id, u.username,
                u.profile_photo
                FROM bid b, users u
                WHERE t_id = :t_id
                AND b.u_id = u.id",
            [
                't_id' => $task_id
            ]);
        } catch(QueryException $e) {
            return false;
        }

        return $query;
    }
    
}
