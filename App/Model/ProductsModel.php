<?php

/*
 * This file is part of the leviframework to projetc webjump.
 *
 * (c) Levi Costa <levi.costa1@gmail.com>
 *
 * For non-commercial use
 * 
 */


/*
 * Set PHP heavily typed
 */
declare(strict_types=1);

namespace App\Model;

use FaaPz\PDO\Clause\JoinClause as Join;

class ProductsModel extends Connection
{

	/**
     * @var string
     * @label('table name')
     *
     */
	private static $table = 'products';

	/**
     * @var string
     * @label('table name')
     *
     */
	private static $table_categories = 'categories';

	public function __construct()
	{
		parent::__construct();
	}

	public function getAllProducts()
	{
		$data = $this->db->select(['*', self::$table . '.name AS product_name'])
			->from(self::$table)
			->execute()
			->fetchAll();
		return $data;
	}

	public function getProductById(int $id)
	{
		$data = $this->db->select()->from(self::$table)->where('id', '=', $id)->execute()->fetch();
		return $data;
	}

	public function insertProduct($name, $code, $price, $quantity, $categories, $description, $img)
	{

		$categories = str_replace(",", "|", $categories);

		$insert = $this->db->insert(['name' => $name, 'code' => $code,
			'price' => $price, 'quantity' => $quantity, 'description' => $description, 'category'  => $categories, 'img' => $img])->into(self::$table);
		$result = $insert->execute();
		$last_id = $result;
		return $last_id;
	}

	public function update($id, $name, $code, $price, $quantity, $categories, $description, $img)
	{
		$data = $this->db->update(['name' => $name, 'code' => $code,
			'price' => $price, 'quantity' => $quantity, 'description' => $description, 'category'  => $categories, 'img' => $img])->table(self::$table)->where('id', '=', $id)->execute();
		return $data;
	}

	public function delete($id)
	{
		$data = $this->db->delete()->from(self::$table)->where('id', '=', $id)->execute();
		return $data;
	}

	public function insetPorductByCsv($name, $code, $description, $quantity, $price, $category)
	{
		$name = $name ?? 'undefined';
		$code = $code ?? 0;
		$description ?? 'undefined';
		$quantity ?? 0;
		$price ?? 0.00;
		$category ?? 'undefined';
		
		$insert = $this->db->insert(['name' => $name, 'code' => $code, 'price' => $price, 'quantity' => $quantity, 'description' => $description, 'category' => $category])
				->into(self::$table);
		$result = $insert->execute();
		return $result;
	}
}