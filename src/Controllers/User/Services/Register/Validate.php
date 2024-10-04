<?php
namespace Regivaldo\Videos\Controllers\User\Services\Register;

class Validate
{
    public function execute($data)
    {
        $sucess = true;
        foreach($this->getFileds() as $key => $field){
            if ($field['required'] == false) {
                continue;
            }

            if (!isset($data[$key]) || empty($data[$key])) {
                $sucess = false;
            }
        }

        return $sucess;
    }

    private function getFileds()
    {
        return [
                'name' => [
                    'required' => true
                ],
                'email' => [
                    'required' => true
                ],
                'password' => [
                    'required' => true
                ],
                'phone' => [
                    'required' => true
                ]
            ];
    }
}