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
use App\Model\CategoriesModel as CategoriesModel;
use App\Model\LogModel as LogModel;

/**
 * Class CategoriesController.
 *
 * @author Levi Costa <levi.costa1@gmail.com>
 */
class CategoriesController extends Controller
{

    /**
     * @var CategoriesModel
     *
     */
    private $categories_model;

    /**
     * @var ResponseInterface
     *
     */
    private $response;

    /**
     * @var LogModel
     *
     */
    private $log_model;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct();
        $this->categories = new CategoriesModel;
        $this->log_model = new LogModel;
        $this->response = $response;            
    }

    public function index()
    {
        return $this->blade->make('categories', ['categories_data' => $this->categories->getAllCategories()]);
    }

    public function getById($request, $response)
    {
        $request = $request->getQueryParams();
        $id = $request['id'];
        return json_encode(['status' => 'success', 'data' => $this->categories->getCategorieById($id)]);
    }

    public function add($request, $response)
    {
        $request = $request->getParsedBody();

        $category_code = (int) $request['category_code'];
        $category_name = $request['category_name'];

        $last_id = $this->categories->insertCategory($category_code, $category_name);

        if($last_id) {
            $this->log_model->saveLog($this->default_user_id, 'Add a category');
            return json_encode(['status' => 'success', 'data' => $this->categories->getCategorieById($last_id)]);
        }
        return json_encode(['status' => 'error']);
    }

    public function delete($request, $response)
    {
        $request = $request->getParsedBody();

        $id = (int) $request['id'];
        $result = $this->categories->delete($id);

        if($result) {
            $this->log_model->saveLog($this->default_user_id, 'Delete a category');
            return json_encode(['status' => 'success']);
        }
        return json_encode(['status' => 'error']);
    }    

    public function update($request, $response)
    {
        $request = $request->getParsedBody();
        $id = $request['update_id'];
        $category_code = $request['category_code_update'];
        $category_name = $request['category_name_update'];

        $data = $this->categories->update($id, ['code' => $category_code, 'name' => $category_name]);
        
        if($data) {
            $this->log_model->saveLog($this->default_user_id, 'Update a category');
            return json_encode(['status' => 'success']);
        }
        return json_encode(['status' => 'error']);
    }
}
