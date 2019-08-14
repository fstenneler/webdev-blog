<?php

namespace app\lib;
use app\lib\FormComponent;
use app\model\UserModel;
use app\model\CommentModel;

class FormManager Extends FormComponent
{

    public function save()
    {
        $attributes = array();
        foreach($this->formBuilder()->getFields() as $fieldName => $field) {
            $attributes[$fieldName] = $field->getValue();
        }

        if($this->form()->getDestination() === 'user') {

            if($this->form()->getMode() === 'insert') {
                $attributes['id'] = 0;
                $attributes['description'] = null;
                $attributes['registration_date'] = date('Y-m-d');
                $attributes['role'] = 'Visiteur';
            } else {
                $attributes['id'] = $this->app()->httpRequest()->getSession('user')->id;
            }
            return UserModel::setUser($attributes, $userId);

        } elseif($this->form()->getDestination() === 'comment') {

            if($this->form()->getMode() === 'insert') {
                $attributes['id'] = 0;
                $attributes['status'] = 'Attente';
                $attributes['date'] = date('Y-m-d');
                $attributes['user_id'] = (int) $this->app()->httpRequest()->getSession('user')->id;
            }
            $attributes['post_id'] = (int) $this->app()->httpRequest()->getData('postId');
            return CommentModel::setComment($attributes);
            
        }
    }

    public function loadData()
    {
        $data = array();

        if($this->form()->getDestination() === 'user') {
            $model = UserModel::getUser($this->app()->httpRequest()->getSession('user')->email);
        } elseif($this->form()->getDestination() === 'comment') {
            $model = CommentModel::getComment($this->app()->httpRequest()->postData('id'));
        }

        foreach($this->formBuilder()->getFields() as $fieldName => $field) {
            if(isset($model->$fieldName)) {
                $data[$fieldName] = $model->$fieldName;
            }
        }

        return $data;
    }

}
