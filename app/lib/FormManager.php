<?php

namespace app\lib;
use app\lib\FormComponent;
use app\lib\Database;
use app\model\UserModel;
use app\model\CommentModel;
use app\model\PostModel;
use app\model\ContactModel;

/**
* Gestion de la base de données liée au formulaire (chargement et enregistrement des valeurs)
*
*/
class FormManager Extends FormComponent
{

    public function loadDbFields($tableName)
    {
        
        $db = new Database();
        $query = 'SHOW COLUMNS FROM ' .$tableName;
        $dbFields = $db->prepare($query, array());

        foreach($dbFields as $dbField) {

            $dbField->Enum = array();
            $dbField->MinSize = 0;
            $dbField->MaxSize = 0;
            
            //si type Enum, création d'un tableau des valeurs de enum
            if(preg_match('#^enum\((.+)\)$#', $dbField->Type)) {
                $enum = explode(',', preg_replace('#\'#','',preg_replace('#^enum\((.+)\)$#','$1',$dbField->Type)));
                $dbField->Enum = $enum;
            }

            //si taille du champ défnie dans le type, découpage du type et de la taille du champ
            if(preg_match('#\([0-9]+\)$#', $dbField->Type)) {
                $dbField->MaxSize = (int) preg_replace('#(.+)\(([0-9]+)\)$#','$2',$dbField->Type);
                $dbField->Type = preg_replace('#(.+)\(([0-9]+)\)$#','$1',$dbField->Type);
            }

            //Tailles par défaut
            if($dbField->Type === 'blob') {
                $dbField->MinSize = 6;
                $dbField->MaxSize = 20;
            }

            //Types par défaut
            if($dbField->Type === 'int') {
                $dbField->Type = 'integer';
            } elseif($dbField->Type !== 'enum') {
                $dbField->Type = 'string';
            }
        }

        return $dbFields;

    }

    public function loadData()
    {
        $data = array();

        if($this->form()->getDestination() === 'user') {
            $model = UserModel::getUser($this->form()->getDbRowId());
        } elseif($this->form()->getDestination() === 'comment') {
            $model = CommentModel::getComment($this->form()->getDbRowId());
        } elseif($this->form()->getDestination() === 'post') {
            $model = PostModel::getFormPost($this->form()->getDbRowId());
        } elseif($this->form()->getDestination() === 'contact') {
            $model = ContactModel::getContact($this->form()->getDbRowId());
        }

        foreach($model as $fieldName => $fieldValue) {
            $data[$fieldName] = $model->$fieldName;
        }

        return $data;
    }

    public function uploadImages() {

        $success = true;
        foreach($this->formBuilder()->getFields() as $field) {
            if(preg_match('#^image#', $field->getName()) && $_FILES[$field->getName()]['tmp_name'] !== '') {
                if($this->formHandler()->getFileFieldError($field) !== null) {
                    $field->setError($this->formHandler()->getFileFieldError($field));
                    $success = false;
                } else {
                    if(
                        move_uploaded_file(
                            $_FILES[$field->getName()]['tmp_name'],
                            $_SERVER['DOCUMENT_ROOT'] . GALLERY_DIR . $_FILES[$field->getName()]['name']
                        )
                    ) {
                        $field->setValue($_FILES[$field->getName()]['name']);
                    } else {
                        $error = 'Une erreur s\'est produite lors du chargement de l\'image';
                        $error .= '(code erreur : ' . $_FILES[$field->getName()]['error'] . ')';
                        $field->setError($error);
                        $success = false;
                    }
                }
            }
        }
        return $success;

    }

    public function save()
    {

        if($this->uploadImages() === false) {
            return false;
        }

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
        } elseif($this->form()->getDestination() === 'contact') {
            return ContactModel::setContact($attributes);            
        }
        
    }

}
