<script>
export default {
    created(){
        if (!User.loggedIn()) {
            this.$router.push({name: 'login' })
        }
       this.allEmployee()
    }, 
    data(){
        return{
            employees:[],
            serchEmployee:''
        }
    },
    computed:{
        employeeFilter(){
            return this.employees.filter(employee =>{
                return employee.phone.match(this.serchEmployee)
            })
        }
    },
    methods:{
        allEmployee(){
            axios.get('/api/employee')
            .then(({data})=> (this.employees = data))
            .catch()
        },
        deleteEmployee(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/employee/'+id)
                    .then(()=>{
                        this.employees = this.employees.filter(employee =>{
                            return employee.id != id
                        })
                        
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                    })
                    .catch(()=>{
                        this.$router.push({name:'allEmployee'})
                    })
                }
            })
        }
    }, 
}
</script>

<template>
      <div class="sa-article">
                        <div class="sa-article__container container container--max--lg">
                            <div class="sa-article__header">
                                <nav class="sa-article__breadcrumb" aria-label="breadcrumb">
                                    <ol class="breadcrumb breadcrumb-sa-simple">
                                        <li class="breadcrumb-item"><RouterLink to="/dashboard">Dashboard</RouterLink></li>
                                        <li class="breadcrumb-item active" aria-current="page">All Employee</li> 
                                    </ol>
                                </nav>  
                            <RouterLink to="/store-employee" class="btn btn-info mt-4">Add Employee</RouterLink>
                            </div> 
                            <div class="sa-article__content"> 
                            <h4 class="sa-article__title">All Employee</h4> 
                            <input type="text" v-model="serchEmployee" class="form-control mt-4" placeholder="Serch for ....">
                                <div class="sa-example"> 
                                    <div class="sa-example__body">
                                        <div class="card">
                                            <table class="sa-datatables-init table table-bordered" data-order='[[ 0, "asc" ]]'>
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Photo</th>
                                                        <th>Phone</th>
                                                        <th>Salary</th>
                                                        <th>Joining date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="employee in employeeFilter" :key="employee.id">
                                                        <td>{{ employee.name }}</td>
                                                        <td><img :src="employee.photo" width="50" height="40" alt="" srcset=""></td>
                                                        <td>{{ employee.phone }}</td>
                                                        <td>{{ employee.salary }}</td>
                                                        <td>{{ employee.joining_date }}</td>
                                                        <td> 
                                                            <RouterLink :to="{name:'editEmployee', params:{id:employee.id}}" class="btn btn-sm btn-warning mr-2">Edit</RouterLink>
                                                            <a @click="deleteEmployee(employee.id)" class="btn btn-sm btn-danger">Delete</a>
                                                        </td>
                                                    </tr> 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
</template>