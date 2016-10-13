<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public static function find($key)
    {
        try {
        $result = \DB::select("SELECT t.id AS t_id, t.name AS task_name, t.description AS task_description,
                        t.postal_code, t.start_date, t.start_time, t.cash_value, t.duration, t.location,
                        c.name AS category_name, u.id AS user_id, u.username, u.profile_photo,
                        u.reputation
                        FROM Task t, Category c, Users u 
                        WHERE t.category = c.id 
                        AND t.posted_by = u.id
                        AND t.id = :id",
        [
            'id' => $key,
        ]);
        } catch(QueryException $e) {
            return false;
        }

        return $result;
    }
}
