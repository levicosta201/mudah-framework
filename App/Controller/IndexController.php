<?php
namespace App\Controller;

class IndexController extends Controller
{

    public function index()
    {
        return $this->blade->make('index');
    }

    public function checkout()
    {
        return $this->blade->make('checkout');
    }

    public function address($request)
    {
        $request = (object) $_POST;
        return $this->blade->make('address')->with([
            'user' => $request
        ]);
    }

    public function order()
    {
        return $this->blade->make('order');
    }

    public function buy()
    {
        return $this->blade->make('buy');
    }

    public function finish()
    {
        return $this->blade->make('finish');
    }

    public function thankyou()
    {
        return $this->blade->make('thankyou');
    }

}