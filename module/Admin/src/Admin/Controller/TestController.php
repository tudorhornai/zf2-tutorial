<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel;
    
class TestController extends ActionController
{
	public function indexAction()
    {
		echo "ADMIN TEST";
        return new ViewModel();
    }
    
}