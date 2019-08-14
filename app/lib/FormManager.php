<?php

namespace app\lib;
use app\lib\FormComponent;
use app\model\UserModel;
use app\model\CommentModel;
use app\model\PostModel;

class FormManager Extends FormComponent
{

    public function loadData()
    {
        $data = array();

        if($this->form()->getDestination() === 'user') {
            $model = UserModel::getUser($this->app()->httpRequest()->getSession('user')->email);
        } elseif($this->form()->getDestination() === 'comment') {
            $model = CommentModel::getComment($this->form()->getFormId());
        } elseif($this->form()->getDestination() === 'post') {
            $model = PostModel::getFormPost($this->app()->httpRequest()->getData('postId'));
        }

        foreach($model as $fieldName => $fieldValue) {
            $data[$fieldName] = $model->$fieldName;
        }

        return $data;
    }

    public function save()
    {

        $attributes = array();
        foreach($this->formBuilder()->getFields() as $fieldName => $field) {
            if($field->getType() === 'integer') {
                $attributes[$fieldName] = (int) $field->getValue();
            } else {
                $attributes[$fieldName] = (string) $field->getValue();
            }
        }

        if($this->form()->getDestination() === 'user') {
            return UserModel::setUser($attributes);
        } elseif($this->form()->getDestination() === 'comment') {
            return CommentModel::setComment($attributes);            
        } elseif($this->form()->getDestination() === 'post') {
            return PostModel::setPost($attributes);            
        }
        
    }

}
