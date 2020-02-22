<template>
  <div id="app">
    <div class="row mr-5 mt-5 ">
      <div class="col-12 ml-5">
        <div class="row mb-4">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudent">
            Add Student
          </button>
        </div>
        
        <div class="row mr-5">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">NIC</th>
                <th scope="col">DOB</th>
                <th scope="col">Address</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(data,index) in students.data" :key="index">
                <th scope="row">{{data.studentId}}</th>
                <td>{{data.studentName}}</td>
                <td>{{data.NIC}}</td>
                <td>{{data.dob}}</td>
                <td>{{data.address}}</td>
                <td>
                  <button type="button" class="btn btn-success mr-1" @click="getEditStudent(data.studentId)" data-toggle="modal" data-target="#EditStudent">
                    Edit
                  </button> 
                  <button class="btn btn-danger" @click="deleteStudent(data.studentId)">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row">
          <!-- Edit Student Model -->
          <div class="modal fade" id="EditStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <input type="text" v-model="updateStudent.name" placeholder="studentName">
                  <input type="text" v-model="updateStudent.NIC" placeholder="NIC">
                  <input type="text" v-model="updateStudent.dob" placeholder="dob">
                  <input type="text" v-model="updateStudent.address" placeholder="address">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary"  data-dismiss="modal">Close</button>
                  <button class="btn btn-primary" @click='editStudent()' data-dismiss="modal">Edit</button>
                </div>
              </div>
            </div>
          </div>
          <!-- Add Student Model -->
          <div class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Student From</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <input type="text" v-model="student.name" placeholder="studentName">
                  <input type="text" v-model="student.NIC" placeholder="NIC">
                  <input type="text" v-model="student.dob" placeholder="dob">
                  <input type="text" v-model="student.address" placeholder="address">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary" @click='addStudent()' data-dismiss="modal">add</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import axios from 'axios'
export default {
  name: 'app',
  components: {
    
  },
  data(){
    return{
      students:"",
      student:{
        name:"",
        dob:'',
        address:'',
        NIC:''
      },
      updateStudent:{
        name:"",
        dob:'',
        address:'',
        NIC:'',
        studentId:''
      }
    }
  },

  methods :{
    getAllStudents(){
      let studentX = '' ;
      axios.get('http://[::1]/attendance/index.php/welcome/getallStudents').then(function(res){
        if(res.data.error){
          console.log("some Error Occur")
        }else{
          studentX = res
        }
      }).then(()=>{
        this.students = studentX                           
      })
     
    },
    addStudent(){
      let studentX = '' ;
      let student = this.student
      axios.get('http://[::1]/attendance/index.php/welcome/addStudent?student='+JSON.stringify(student)).then(function(res){
        if(res.data.error){
          console.log("some Error Occur")
        }else{
          studentX = res
        }
      }).then(()=>{
        this.students = studentX                           
      })
    },
    getEditStudent(id){  
      let updateStudent = this.updateStudent;
      axios.get('http://[::1]/attendance/index.php/welcome/getEditBaseStudentDetails?id='+id).then(function(res){
        if(res.data.error){
          console.log("some Error Occur")
        }else{
          res.data.forEach(function(data){           
              updateStudent.name=data.studentName,
              updateStudent.dob=data.dob,
              updateStudent.address=data.address,
              updateStudent.NIC=data.NIC,
              updateStudent.studentId = id
          })
        }
      }).then(()=>{
        this.updateStudent = updateStudent;                 
      })
    },
    editStudent(){
      let studentX = '' ;
      let updateStudent = this.updateStudent
      axios.get('http://[::1]/attendance/index.php/welcome/updateStudent?updateStudent='+JSON.stringify(updateStudent)).then(function(res){
        if(res.data.error){
          console.log("some Error Occur")
        }else{
          studentX = res
        }
      }).then(()=>{
        this.students = studentX                           
      })
    },
    deleteStudent(id){
      let studentX = '' ;
      axios.get('http://[::1]/attendance/index.php/welcome/deleteStudent?id='+id).then(function(res){
        if(res.data.error){
          console.log("some Error Occur")
        }else{
          studentX = res
        }
      }).then(()=>{
        this.students = studentX                           
      })
    }
    
  },
  mounted: function(){
    this.getAllStudents();
   
  }
}
</script>

<style>

</style>
