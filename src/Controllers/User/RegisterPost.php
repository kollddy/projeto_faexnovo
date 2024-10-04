<?php

namespace Regivaldo\Videos\Controllers\User;

use Regivaldo\Videos\Models\Users\Users;
use Regivaldo\Videos\Controllers\User\Services\Register\Validate;
use Regivaldo\Videos\Helpers\Message\Message;

class RegisterPost
{
    protected Users $users;

    protected Validate $validate;

    protected Message $message;

    public function __construct()
    {
        $this->users = new Users();
        $this->validate = new Validate();
        $this->message = new Message();
    }

    public function execute($data)
    {

        if (!$this->validate->execute($data)){
            $this->message->setMessageError("Verique os campos e tente novamente");
            header('location: /register');
            return;
        }

        $dataUser = $this->users->findOne([
            "email" => $data['email']
        ]);

        if ($dataUser) {
            $this->message->setMessageError("Já existe um usuário com esse email");
            header('location: /register');
            return;
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        if ($this->users->create($data) == false) {
            $this->message->setMessageError("Ocorreu um erro ao registrar, tente novamente");
            header('location: /register');
            return;
        };

        $this->message->setMessageSuccess("Registrado com sucesso");
       
        header('location: /login');
        return;
    }
}