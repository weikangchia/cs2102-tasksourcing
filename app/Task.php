<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  public function save(array $data = array(), array $options = array())
  {
    try {
      \DB::update("UPDATE task
        SET name = :name,
            postal_code = :postal_code,
            description = :description,
            start_date = :start_date,
            start_time = :start_time,
            cash_value = :cash_value,
            duration = :duration,
            category = :category,
            location = :location,
            updated_at = :updated_at WHERE id = :id",
      [
        'id' => $this->id,
        'name' => $this->name,
        'postal_code' => $this->postal_code,
        'description' => $this->description,
        'start_date' => $this->start_date,
        'start_time' => $this->start_time,
        'cash_value' => $this->cash_value,
        'duration' => $this->duration,
        'category' => $this->category,
        'location' => $this->location,
        'updated_at' => new \DateTime()
      ]);
    } catch(QueryException $e) {
      return false;
    }

    return true;
  }

  public static function find($key) {
    try {
      $query = \DB::select("SELECT * FROM task WHERE id = :id",
      [
        'id' => $key,
      ]);
      $task = new Task();
      $task->id = $query[0]->id;
      $task->name = $query[0]->name;
      $task->postal_code = $query[0]->postal_code;
      $task->description = $query[0]->description;
      $task->created_at = $query[0]->created_at;
      $task->updated_at = $query[0]->updated_at;
      $task->start_date = $query[0]->start_date;
      $task->start_time = $query[0]->start_time;
      $task->cash_value = $query[0]->cash_value;
      $task->duration = $query[0]->duration;
      $task->category = $query[0]->category;
      $task->posted_by = $query[0]->posted_by;
      $task->location = $query[0]->location;

      $task->start_day = substr($query[0]->created_at, 8);
      $task->start_month = intval(substr($query[0]->created_at, 5, 2));
      $task->start_year = substr($query[0]->created_at, 0, 4);
    } catch(QueryException $e) {
      return false;
    }

    return $task;
  }
}
