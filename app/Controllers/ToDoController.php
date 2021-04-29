<?php
	namespace App\Controllers;
	use App\Models\ToDoModel;  //load user model class

	class ToDoController extends BaseController{

		
		
		public function index(){

			return view('ToDo/viewToDo');
		}

		public function addTask(){

			$taskName = $this->request->getPost('taskName');

			$toDo = new ToDoModel;
			$data = [

				'task' => $taskName
			];
			$toDo->save($data);
			// $data = ['status'=>'User inserted successfully'];
			// return $this->response->setJSON($data);
			$respData = array('status'=>200,'message'=>'Record inserted successfully');
			echo json_encode($respData);
		}


		public function getToDo(){

			$toDo = new ToDoModel();
			$data['toDoData'] = $toDo->findAll();
			return $this->response->setJSON($data); 
		}


		public function deleteTask(){

			$toDo_id = $this->request->getPost('toDoId');

			$toDo = new ToDoModel;
			$toDo->delete($toDo_id);
			$respData = array('status'=>200,'message'=>'Record deleted successfully');
			echo json_encode($respData);

		}
	}

?>