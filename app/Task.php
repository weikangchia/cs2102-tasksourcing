<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Task extends Model
{
  public function save(array $data = array(), array $options = array())
  {
    try {
      \DB::update("UPDATE task
        SET name = :name,
            postal_code = :postal_code,
            description = :description,
            cash_value = :cash_value,
            duration = :duration,
            category = :category,
            location = :location,
            start_time = :start_time,
            start_date = :start_date,
            updated_at = :updated_at
        WHERE id = :id",
      [
        'id' => $this->t_id,
        'name' => $this->task_name,
        'postal_code' => $this->postal_code,
        'description' => $this->task_description,
        'cash_value' => $this->cash_value,
        'duration' => $this->duration,
        'category' => $this->category_id,
        'location' => $this->location,
        'start_time' => $this->start_time,
        'start_date' => $this->start_date,
        'updated_at' => new DateTime()
      ]);
    } catch(QueryException $e) {
      dd($e);
      return false;
    }

    return true;
  }

  public static function find($key) {
    try {
      $query = \DB::select("SELECT t.id AS t_id, t.name AS task_name, t.description AS task_description,
                        t.postal_code, t.start_date, t.start_time, t.cash_value, t.duration, t.location,
                        c.id AS category_id, c.name AS category_name, u.id AS user_id, u.username,
                        u.profile_photo, u.reputation
                        FROM Task t, Category c, Users u 
                        WHERE t.category = c.id 
                        AND t.posted_by = u.id
                        AND t.id = :id",
      [
          'id' => $key,
      ]);
      $task = new Task();
      $task->t_id = $query[0]->t_id;
      $task->task_name = $query[0]->task_name;
      $task->postal_code = $query[0]->postal_code;
      $task->task_description = $query[0]->task_description;
      $task->cash_value = $query[0]->cash_value;
      $task->duration = $query[0]->duration;
      $task->location = $query[0]->location;
      $task->category_id = $query[0]->category_id;
      $task->category_name = $query[0]->category_name;
      $task->posted_by_id = $query[0]->user_id;
      $task->posted_by_username = $query[0]->username;
      $task->posted_by_profile_photo = $query[0]->profile_photo;
      $task->posted_by_reputation = $query[0]->reputation;
      $task->start_date = $query[0]->start_date;
      $task->start_time = $query[0]->start_time;
      $task->duration = $query[0]->duration;

      $task->start_hour = substr($query[0]->start_time, 0, 2);
      $task->start_minute = substr($query[0]->start_time, 3, 2);
    } catch(QueryException $e) {
      return false;
    }

    return $task;
  }
}
