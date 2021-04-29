<?php 
	namespace App\Models;

	use CodeIgniter\Model;  //to use codeigniter model class


	class ToDoModel extends Model
	{
		protected $table = 'add_todo';
		protected $allowedFields = ['task'];  //table fields name
	}
?>