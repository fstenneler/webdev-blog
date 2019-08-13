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
                $attributes['description'] = null;
                $attributes['role'] = 'Visiteur';
                $userId = 0;
            } else {
                $attributes['description'] = $this->app()->httpRequest()->getSession('user')->description;
                $attributes['role'] = $this->app()->httpRequest()->getSession('user')->role;
                $userId = $this->app()->httpRequest()->getSession('user')->id;
            }
            return UserModel::setUser($attributes, $userId);

        } elseif($this->form()->getDestination() === 'comment') {

            $attributes['status'] = 'Attente';
            $attributes['post_id'] = (int) $this->app()->httpRequest()->getData('postId');
            $attributes['user_id'] = (int) $this->app()->httpRequest()->getSession('user')->id;
            return CommentModel::setComment($attributes);
            
        }
    }

    public function loadData()
    {
        $data = array();

        if($this->form()->getDestination() === 'user') {
            $model = UserModel::getUser($this->app()->httpRequest()->getSession('user')->email);
        }

        foreach($this->formBuilder()->getFields() as $fieldName => $field) {
            if(isset($model->$fieldName)) {
                $data[$fieldName] = $model->$fieldName;
            }
        }

        return $data;
    }

}