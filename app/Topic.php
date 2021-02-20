<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;


//подключение модуля для волидации полей
use \Esensi\Model\Model;

class Topic extends Model
{
    public $primaryKey = 'id';//указываем ключевое поле в таблице topics
    public $table = 'topics';
    public $fillable = ['topicname','created_at','updated_at'];

    //Esensi ограничения для полей

    protected $rules = ['topicname'=>['required', 'max:128','unique']];

}
