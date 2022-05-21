<script>
export default {
    created(){
        if (!User.loggedIn()) {
            this.$router.push({name: 'login' })
        }
        let id = this.$route.params.id 
        axios.get('api/employee/'+id)
        .then(({data}) => (this.form = data))
        .catch(error=> console.log(error))
    },
    data(){
        return{
            form:{
                name: 'hello',
                email: null, 
                phone: null, 
                address: null, 
                salary: null,
                photo: null, 
                nid: null, 
                joining_date: null, 
            },
            editData:{},
            errors:{}
        }
    },
    methods:{
        employeeInsert(){
            axios.post('/api/employee', this.form)
            .then(response => { 
                this.$router.push({name: 'allEmployee' })
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Data inserted successfully.',
                    showConfirmButton: false,
                    timer: 1500
                });
            })
            .catch(error => this.errors = error.response.data.errors)
        },
        empPhotoSelect(event){
            let file = event.target.files[0];
            if(file.size > 1048770){
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Image size will be less then 1 mb.',
                    showConfirmButton: false,
                    timer: 1500
                });
            }else{
                let reader = new FileReader();
                reader.onload = event=>{
                    this.form.photo = event.target.result; 
                }
                reader.readAsDataURL(file)
            }
        }
    }
}
</script>

<template>
    <div class="sa-article sa-article--has-toc">
        <div class="sa-article__container container container--max--md">
            <div class="sa-article__header">
                <nav class="sa-article__breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-sa-simple">
                        <li class="breadcrumb-item"><RouterLink to="/dashboard">Dashboard</RouterLink></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Employee</li> 
                    </ol>
                </nav> 
                <RouterLink to="/all-employee" class="btn btn-info mt-4">All Employee</RouterLink>
            </div> 
            <div class="sa-article__content"> 
                <div class="sa-example my-5"> 
                    <div class="sa-example__body"> 
                       <form @submit.prevent="employeeInsert" enctype="multipart/form-data"> 
                            <h4 class="sa-article__title">Edit Employee</h4>
                           <div class="row">
                                <div class="col-6">
                                    <input type="text" placeholder="Name" class="form-control mt-3" v-model="form.name" />
                                    <small class="text-danger" v-if="errors.name">{{ errors.name[0]}}</small>
                                </div>   
                                <div class="col-6">
                                    <input type="email" placeholder="Email" class="form-control mt-3" v-model="form.email" />
                                    <small class="text-danger" v-if="errors.email">{{ errors.email[0]}}</small>
                                </div> 
                                <div class="col-6">
                                    <input type="text" placeholder="Phone" class="form-control mt-3" v-model="form.phone" />
                                    <small class="text-danger" v-if="errors.phone">{{ errors.phone[0]}}</small>
                                </div> 
                                <div class="col-6">
                                    <input type="text" placeholder="Address" class="form-control mt-3" v-model="form.address" />
                                    <small class="text-danger" v-if="errors.address">{{ errors.address[0]}}</small>
                                </div> 
                                <div class="col-6">
                                    <input type="text" placeholder="Salary" class="form-control mt-3" v-model="form.salary" />
                                    <small class="text-danger" v-if="errors.salary">{{ errors.salary[0]}}</small>
                                </div> 
                                <div class="col-6">
                                    <input type="text" placeholder="nid" class="form-control mt-3" v-model="form.nid" />
                                    <small class="text-danger" v-if="errors.nid">{{ errors.nid[0]}}</small>
                                </div> 
                                <div class="col-12">
                                    <input type="text" placeholder="Joining date" class="form-control mt-3" v-model="form.joining_date" />
                                    <small class="text-danger" v-if="errors.joining_date">{{ errors.joining_date[0]}}</small>
                                </div> 
                                <div class="col-6">
                                    <input type="file" class="form-control mt-3" id="empPhoto" @change="empPhotoSelect" />
                                    <small class="text-danger" v-if="errors.photo">{{ errors.photo[0]}}</small>
                                </div> 
                                <div class="col-6">
                                    <img :src="form.photo" class="mt-3" width="40" height="40" alt="" srcset="">
                                </div> 
                                <div class="col-12">
                                    <button type="submit" class="btn btn-info mt-4">Button</button>
                                </div> 
                           </div>
                       </form>

                    </div>  
                </div>  
            </div>
        </div>
    </div>
</template>
<style scoped>

</style>