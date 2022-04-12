<?php
declare(strict_types=1);

use Phalcon\Mvc\Controller;
use Phalcon\Events\Manager as EventsManager;


class AddproductController extends Controller
{
    public function indexAction()
    {
    
    }
    public function addAction(){
        $products= new Products();
        $eventsManager = new EventsManager();
        $component = new \App\Handler\Aware();
        $component->setEventsManager($eventsManager);
        $category = $this->request->getPost('category');
        $price = $this->request->getPost('price');
        $stock = $this->request->getPost('stock');
          if(!$category){
            $category=0;
        }
        if(!$price){
            $price=0;
        }
        if(!$stock){
            $stock=0;
        }


           $products->assign([
            'product_name'=> $this->request->getPost('name'),
            'product_category'=>$category,
            'price'=> $price,
            'stock'=>$stock,

        ]);
        $success = $products->save();

         if($success){
           $eventsManager->attach(
            'product',
             new \App\Handler\Listener()
             );

           $component->process1();
          $this->response->redirect("../index?bearer=");
        }
         


    }

   

}