<?php

namespace app\controller\admin;

use app\ControllerApp;
use app\lib\Form;
use app\model\PostModel;
use app\model\UserModel;
use app\model\CategoryModel;

class PostController extends ControllerApp
{
 
    public function getView()
    {

        //postList
        $parameters = array('number' => 0);
        if($this->app()->httpRequest()->getData('postId') > 0) {
            $parameters['postId'] = $this->app()->httpRequest()->getData('postId');
        }

        $postList = PostModel::getPost($parameters);

        //redirection
        if($this->app()->httpRequest()->getData('postId') > 0 && count($postList) === 0) {
            return $this->app()->route()->setRoute($this->app()->route()->setUrl(array('page' => 'error')));
        }

        //post infos
        $postList = $this->generatePostListDetails($postList);

        if($this->app()->httpRequest()->getData('postId') > 0) {
            $this->app()->setData('postList', $postList[0]);
        } else {
            $this->app()->setData('postList', $postList);
        }


        //categoryList
        $this->app()->setData('categoryList', CategoryModel::getCategoryList());

        //userList
        $this->app()->setData('userList', UserModel::getUserList('Administrateur'));

        //postForm update
        if(
            $this->app()->httpRequest()->getData('action') === 'update'
            && $this->app()->httpRequest()->getData('postId') > 0
        ) {
            $form = new Form($this->app());
            $form->setMode('update');
            $form->setDestination('post');
            $form->setMandatoryFields(array('title', 'header', 'content', 'is_hero', 'user_id', 'category_id'));
            $form->setDefaultValues(array('last_modification_date' => date('Y-m-d')));
            $form->setDbRowId($this->app()->httpRequest()->getData('postId'));
            $form->setForm();
            if($form->setValidation()) {
                return $this->app()->route()->setRoute(
                    'index.php?page=post&action=update&postId=' . $this->app()->httpRequest()->getData('postId')
                );
            }
            $this->app()->setData('form', $form);
        }

        //postForm insert
        if($this->app()->httpRequest()->getData('action') === 'add') {
            $form = new Form($this->app());
            $form->setMode('insert');
            $form->setDestination('post');
            $form->setMandatoryFields(array('title', 'header', 'content', 'is_hero', 'user_id', 'category_id'));
            $form->setDefaultValues(
                array(
                    'id' => 0,
                    'creation_date' => date('Y-m-d'),
                    'last_modification_date' => date('Y-m-d'),
                    'display' => 1
                )
            );
            $form->setForm();
            if($form->setValidation()) {
                return $this->app()->route()->setRoute('index.php?page=post');
            }
            $this->app()->setData('form', $form);
        }

        $pageName = $this->app()->getPageName() . $this->app()->httpRequest()->getData('action');
        return $this->app()->httpResponse()->generateView($pageName);

    }
          
}
