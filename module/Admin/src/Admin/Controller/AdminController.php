<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel;
    
class AdminController extends ActionController
{
    public function indexAction()
    {
	echo 111111111;
        return new ViewModel();
    }
    
}