<?php

namespace app\lib;
use app\App;
use app\lib\FormBuilder;
use app\lib\FormHandler;
use app\lib\FormManager;

abstract class FormClassBuilder
{
    private $mode;
    private $formId;
    private $destination;
    private $mandatoryFields = array();
    private $defaultValues = array();
    private $dbRowId;
    private $formBuilder;
    private $formHandler;
    private $formManager;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->formBuilder = new FormBuilder($this);
        $this->formHandler = new FormHandler($this);
        $this->formManager = new formManager($this);
        $this->formId = 0;
   }

	/**
     * Méthode pour retourner l'instanciation de la classe App
	 *
	 */
    public function app()
    {
        return $this->app;
    }

	/**
     * Méthode pour retourner l'instanciation de la classe FormBuilder
	 *
	 */
    public function formBuilder()
    {
        return $this->formBuilder;
    }

	/**
     * Méthode pour retourner l'instanciation de la classe FormHandler
	 *
	 */
    public function formHandler()
    {
        return $this->formHandler;
    }

	/**
     * Méthode pour retourner l'instanciation de la classe FormManager
	 *
	 */
    public function formManager()
    {
        return $this->formManager;
    }

	/**
     * Méthode pour définir si on fait de l'insert ou de l'update
	 *
	 */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    public function getMode()
    {
        return $this->mode;
    }

	/**
     * Méthode pour définir l'identifiant du formulaire, si plusieurs formulaires sur la meme page
	 *
	 */
    public function setFormId($formId)
    {
        $this->formId = $formId;
    }

    public function getFormId()
    {
        return $this->formId;
    }

	/**
     * Méthode pour définir la table visée par le formulaire créé
	 *
	 */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    public function getDestination()
    {
        return $this->destination;
    }

	/**
     * Méthode pour définir les champs obligatoires du formulaire (tableau avec le nom des champs)
	 *
	 */
    public function setMandatoryFields($mandatoryFields)
    {
        $this->mandatoryFields = $mandatoryFields;

    }

    public function getMandatoryFields()
    {
        return $this->mandatoryFields;
    }

	/**
     * Méthode pour définir les valeurs par défaut des champs du formulaire (tableau avec le nom du champ et sa valeur par défaut)
	 *
	 */
    public function setDefaultValues($defaultValues)
    {
        $this->defaultValues = $defaultValues;

    }

    public function getDefaultValues()
    {
        return $this->defaultValues;
    }

	/**
     * Méthode pour définir quelle ligne de la base est concernée par le formulaire (valeur de la colonne id)
	 *
	 */
    public function setDbRowId($dbRowId)
    {
        $this->dbRowId = $dbRowId;

    }

    public function getDbRowId()
    {
        return $this->dbRowId;
    }

}
