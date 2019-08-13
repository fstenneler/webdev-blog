<?php

namespace app\lib;
use app\lib\Form;

abstract class FormComponent
{
  protected $form;
 
  public function __construct(Form $form)
  {
    $this->form = $form;
  }
     
  protected function form()
  {
    return $this->form;
  }
 
  protected function app()
  {
    return $this->form->app();
  }
   
  protected function formBuilder()
  {
    return $this->form->formBuilder();
  }
   
  protected function formHandler()
  {
    return $this->form->formHandler();
  }
   
  protected function formManager()
  {
    return $this->form->formManager();
  }

}
