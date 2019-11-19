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

/**
 * Class CategoriesModel.
 *
 * @author Levi Costa <levi.costa1@gmail.com>
 */
class CategoriesModel extends Connection
{

	/**
     * @var string
     * @label('table name')
     */
	private static $table = 'categories';

	public function __construct()
	{
		parent::__construct();
	}

	public function insertCategory(int $code, string $name)
	{
		$insert = $this->db->insert(['code' => $code, 'name' => $name])->into(self::$table);
		$result = $insert->execute();
		return $result;
	}

	public function getAllCategories()
	{
		$data = $this->db->select()->from(self::$table)->execute()->fetchAll();
		return $data;
	}

	public function getCategorieById($id)
	{
		$data = $this->db->select()->from(self::$table)->where('id', '=', $id)->execute()->fetch();
		return $data;
	}

	public function delete($id)
	{
		$data = $this->db->delete()->from(self::$table)->where('id', '=', $id)->execute();
		return $data;
	}

	public function update($id, array $params)
	{
		$data = $this->db->update($params)->table(self::$table)->where('id', '=', $id)->execute();
		return $data;
	}
}