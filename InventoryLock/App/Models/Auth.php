<?php

namespace App\Models;

use App\Database\Database;

class Auth{
    public ?string $user_name = '';
    public ?string $user_email = '';
    public ?string $user_token = '';

    protected $error = '';

    public function __construct(array $data=[]){      
        $this->fill($data);
    }

    public function fill(array $data = []){
        if ($data){        
            $this->user_name = $data['user_name'] ?? '';
            $this->user_email = $data['user_email'] ?? '';
        } 
    }

    public function validate() : bool{

        $this -> error = '';
        //проверка на заполненности полей   
        if (!$this -> user_name || !$this -> user_email){
            $this -> error='Поля не заполнены';
        }
        if ($this -> user_email && !preg_match('~^[a-z\d\-_\.]+@[a-z\d\-]+\.[a-z]{2,65}$~',$this -> user_email)){
            //Регулярка email
            $this -> error='Введен некоретный электронный адрес';
        }
        return empty($this->error);
    }

    public function hasError() : bool{
        return ! empty($this->error);
    }
    
    public function getError(): string{
        return $this->error; 
    }

    public function save(): string{
        $this->user_token = uniqid();

        $sql = Database::prepare('INSERT INTO `authentications` (`user_name`, `user_email`, `user_token`, `authentificated_at`) 
        VALUES (:user_name, :user_email, :user_token, NOW());');
        $sql->execute([
            'user_name' => $this->user_name,
            'user_email' => $this->user_email,
            'user_token' => $this->user_token,
        ]);

        return $this->user_token;
    }




}