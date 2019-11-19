<?php

/*
 * This file is part of the leviframework to projetc webjump.
 *
 * (c) Levi Costa <levi.costa1@gmail.com>
 *
 * For non-commercial use
 * 
 */
 
declare(strict_types=1);
namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use App\Model\ProductsModel as ProductsModel;
use App\Model\CategoriesModel as CategoriesModel;
use App\Model\LogModel as LogModel;

/**
 * Class ProductsController.
 *
 * @author Levi Costa <levi.costa1@gmail.com>
 */
class ProductsController extends Controller
{

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var ProductsModel
     */
    private $products_model;

    /**
     * @var CategoriesModel
     */
    private $categories_model;

    /**
     * @var LogNModel
     */
    private $log_model;

    public function __construct(ResponseInterface $response) 
    {        
        parent::__construct();
        $this->response = $response;
        $this->log_model = new LogModel;
        $this->products_model = new ProductsModel;
        $this->categories_model = new CategoriesModel;
    }

    public function index()
    {
        return $this->blade->make('products', ['categories_data' => $this->categories_model->getAllCategories(), 'products_data' => $this->products_model->getAllProducts()]);
    }

    public function getById($request)
    {
        $request = $request->getQueryParams();
        $id = $request['id'];
        return json_encode(['status' => 'success', 'data' => $this->products_model->getProductById((int)$id)]);
    }

    public function add($request)
    {
        $request = $request->getParsedBody();
        $file = $file = $this->uploadFile($_FILES['product_image']);
        
        $insert_product = $this->products_model->insertProduct($request['product_name'], $request['product_code'],
            $request['product_price'], $request['product_quantity'], $request['product_categories'], $request['product_description'], $file);

        if($insert_product) {
            $this->log_model->saveLog($this->default_user_id, 'Add a new product');
            return json_encode(['status' => 'success', 'data' => $this->products_model->getProductById((int)$insert_product)]);     
        }
    }

    public function delete($request)
    {
        $request = $request->getParsedBody();

        $id = (int) $request['id'];
        $result = $this->products_model->delete($id);

        if($result) {
            $this->log_model->saveLog($this->default_user_id, 'Delete a product');
            return json_encode(['status' => 'success']);
        }
        return json_encode(['status' => 'error']);
    }

    public function update($request)
    {
        $request = $request->getParsedBody();
        $file = $this->uploadFile($_FILES['product_image']);
        $data = $this->products_model->update($request['update_id'], $request['product_name'], $request['product_code'],
            $request['product_price'], $request['product_quantity'], $request['product_categories'], $request['product_description'], $file);
        
        if($data) {
            $this->log_model->saveLog($this->default_user_id, 'Update a product');
            return json_encode(['status' => 'success']);
        }
        return json_encode(['status' => 'error']);
    }

    public function indexImport()
    {
        return $this->blade->make('products_import');
    }

    public function processImport($request)
    {
        $request = $request->getParsedBody();
        $csv = $_FILES['csv']['tmp_name'];
        $file = fopen($csv, "r");
        $success = false;
        
        while (($data = fgetcsv($file, 10000, ";")) !== FALSE) {
            if(in_array('description', $data))
                continue;

            $name = $data[0] ?? null;
            $code = $data[1] ?? null;
            $description = $data[2] ?? null;
            $quantity = $data[3] ?? null;
            $price = $data[4] ?? null;
            $category = $data[5] ?? null;
            $insert = $this->products_model->insetPorductByCsv($name, $code, $description, $quantity, $price, $category);
            
            if($insert)
                $success = true;
            else
                $success = false;
        }

        if($success) {
            $this->log_model->saveLog($this->default_user_id, 'Imported new .csv file');
            return json_encode(['status' => 'success']);
        }
        return json_encode(['status' => 'error']);
    }

    private function uploadFile($getFile)
    {
        $product_image = getFileData($getFile);
        $upload_dir = '../public/images/product/';
        $file = uploadFile($upload_dir, generateRandFileName(), $product_image['extension'], $product_image['tmp_name']);


        if(!$file)
            return json_encode(['status' => 'error', 'msg' => 'File not uploaded']);
    }

}
