<template>
  <div>
    <h1>Employee List</h1>
    <button @click="openAddForm">Add Employee</button>

    <div v-if="showAddForm" class="modal">
      <div class="modal-content">
        <span class="close" @click="closeAddForm">&times;</span>
        <h2>Add  Employee</h2>
        <form @submit.prevent="addEmployee">
          <label>Name:</label>
          <input type="text" v-model="newEmployee.name" required><br><br>
          <label>Age:</label>
          <input type="text" v-model="newEmployee.age" required><br><br>
          <button type="submit">Add</button>
        </form>
      </div>
    </div>

    
    <div v-if="showEditForm" class="modal">
      <div class="modal-content">
        <span class="close" @click="closeEditForm">&times;</span>
        <h2>Edit Employee</h2>
        <form @submit.prevent="updateEmployee">
          <label>Name:</label>
          <input type="text" v-model="editEmployee.name" required><br><br>
          <label>Age:</label>
          <input type="text" v-model="editEmployee.age" required><br><br>
          <button type="submit">Update</button>
        </form>
      </div>
    </div>

    <div class="center-table">
      <table class="employee-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="employee in employees" :key="employee.id">
            <td>{{ employee.name }}</td>
            <td>{{ employee.age }}</td>
            <td>
              <button class="edit-button" @click="openEditForm(employee)">Edit</button>
              <button class="delete-button" @click="deleteEmployee(employee.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      employees: [],
      showAddForm: false,
      showEditForm: false,
      newEmployee: {
        name: '',
        age: '',
      },
      editEmployee: {
        id: null,
        name: '',
        age: '',
      },
    };
  },
  mounted() {
    this.fetchEmployees();
  },
  methods: {
    async fetchEmployees() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/emplies');
        this.employees = response.data;
      } catch (error) {
        console.error('Error fetching employees', error);
      }
    },
    openAddForm() {
      this.showAddForm = true;
    },
    closeAddForm() {
      this.showAddForm = false;
      this.newEmployee = { name: '', age: '' };
    },
    async addEmployee() {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/emplies', this.newEmployee);
        this.employees.push(response.data);
        this.closeAddForm();
      } catch (error) {
        console.error('Error adding employee', error);
      }
    },
    openEditForm(employee) {
      this.editEmployee.id = employee.id;
      this.editEmployee.name = employee.name;
      this.editEmployee.age = employee.age;
      this.showEditForm = true;
    },
    closeEditForm() {
      this.showEditForm = false;
      this.editEmployee = { id: null, name: '', age: '' };
    },
    async updateEmployee() {
      try {
        const response = await axios.put(`http://127.0.0.1:8000/api/emplies/${this.editEmployee.id}`, this.editEmployee);
        const updatedEmployeeIndex = this.employees.findIndex(emp => emp.id === this.editEmployee.id);
        if (updatedEmployeeIndex !== -1) {
          this.employees.splice(updatedEmployeeIndex, 1, response.data);
        }
        this.closeEditForm();
      } catch (error) {
        console.error('Error updating employee', error);
      }
    },
    async deleteEmployee(employeeId) {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/emplies/${employeeId}`);
        this.employees = this.employees.filter(emp => emp.id !== employeeId);
      } catch (error) {
        console.error('Error deleting employee', error);
      }
    },
  },
};
</script>

<style>

  .modal {
    display: block;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
  }

  .modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
  }

  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
  .center-table {
  display: flex;
  justify-content: center;
}

.employee-table {
  border-collapse: collapse;
  width: 80%;
  margin-top: 20px;
}

.employee-table th,
.employee-table td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

.employee-table th {
  background-color: #f2f2f2;
}

.employee-table tr:nth-child(even) {
  background-color: #f9f9f9;
}

.employee-table tr:hover {
  background-color: #f1f1f1;
}
</style>
