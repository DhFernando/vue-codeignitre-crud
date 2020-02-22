<?php

class query extends CI_Model {

    public function getallStudents(){
        $query1 = $this->db->query("SELECT * FROM student ");
        return $query1;
    }

    public function deleteStudent(){
        $id = $_GET['id'];
        $query = $this->db->query("DELETE FROM student WHERE studentId = $id ");
        return $query;
    }
    public function addStudent(){
        $student = json_decode($_GET['student']);
        $student=array(
            'studentName'=>$student->name,
            'address'=>$student->address,
            'dob'=>$student->dob,
            'NIC'=>$student->NIC,
        );
         return $this->db->insert('student',$student);
    }

    public function getEditBaseStudentDetails(){
        $id=$_GET['id'];
        $query = $this->db->query("SELECT * FROM student WHERE  studentId = $id ");
        return $query;
    }

    public function updateStudent(){
        $updateStudent = json_decode($_GET['updateStudent']);
        $query = $this->db->query("UPDATE student SET studentName = '$updateStudent->name' , address = '$updateStudent->address' , dob = '$updateStudent->dob' ,NIC = '$updateStudent->NIC' WHERE studentId= '$updateStudent->studentId' ");
        return $query;
    }

}
?>