<template>
    <div>
        <h2 class="text-center">Users</h2>
        <button type="button" class="btn btn-sm btn-primary" @click="addUser">
            <i class="fa fa-plus-square"></i>
            Add New
        </button>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user,index in users" :key="user.id">
                <td>{{ index }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.role }}</td>
                <td>
                    <span class="badge badge-success" v-for="group in user.group" :key="group.id">{{ group.name }}</span>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        
                        <button class="btn btn-success" @click="editUser(user)">Edit</button>
                        <button class="btn btn-danger" @click="deleteUser(user)">Delete</button>

                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- Modal -->
        <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-if="!editmode">Create New User</h5>
                        <h5 class="modal-title" v-if="editmode==true">Update User</h5>
                        <h5 class="modal-title" v-else-if="editmode == 2">Delete User</h5>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" @click="closeModal()">&times;</span>
                        </button>
                
                    </div>
                    <form @submit.prevent>
                        <template v-if="editmode != 2">
                            <div class="modal-body">
                               <div class="form-group">
                                    <label>Name</label>
                                    <input v-model="user.name" type="text" name="name"
                                        class="form-control" :class="{ 'is-invalid': err.name }">
                                    <label>Email</label>
                                    <input v-model="user.email" type="email" name="email"
                                        class="form-control" :class="{ 'is-invalid': err.email }">
                                    <label>Password</label>
                                    <input v-model="user.password" type="password" name="password"
                                        class="form-control" :class="{ 'is-invalid': err.password }">
                                    <label>Role</label>
                                    <multiselect v-model="user.role" placeholder="Search Role" :options="user_roles" ></multiselect>
                                </div>
                            </div>
                        </template>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="closeModal()">Close</button>
                            <button v-if="!editmode" type="submit" class="btn btn-primary" @click="createUser()">Create</button>
                            <button v-if="editmode==true" type="submit" class="btn btn-success" @click="updateUser()">Update</button>
                            <button v-else-if="editmode==2" type="submit" class="btn btn-danger" @click="destroyUser()">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

</template>

<script>

import { computed } from 'vue';
    export default {
        data() {
            return {
                editmode: false,
                user_roles: ['admin','user'],
                users: [],
                user: new Form({
                    id : '',
                    name: '',
                    email: '',
                    password: '',
                    role: '',
                }),
                err: [],                
            }
        },

        created() {
            this.loadUser();
        },
        methods: {
            loadUser(){
                axios
                .get('/admins/users')
                .then(response => {
                    this.users = response.data;
                });
                
            },
            addUser(){
                this.editmode = false;
                this.user.reset();
                $('#userModal').modal('show');
             
            },
           createUser() {
                this.user.post('/admins')
                .then((response)=>{
                    $('#userModal').modal('hide');

                    this.loadUser();
                })
                .catch(e => {

                    this.err = e.response.data.error;
                    console.log(this.err);
                })
            },
            deleteUser(user) {
                this.editmode = 2;
                this.user.reset();
                $('#userModal').modal('show');
                this.user.fill(user);
            },
            destroyUser() { 
                this.user.delete('/admins/'+this.user.id)
                .then((response) => {
                  
                        let i = this.users.map(data => data.id).indexOf(this.user.id);
                        this.users.splice(i, 1);
                        $('#userModal').modal('hide');
                });
            },
            updateUser() {
                this.user.put('/admins/'+this.user.id)
                .then((response) => {
                    $('#userModal').modal('hide');
                    this.loadUser();
                })
                .catch(e => {

                    this.err = e.response.data.error;
                });
            },
            editUser(user) {
                this.err = [];
                this.editmode = true;
                this.user.reset();
                $('#userModal').modal('show');
                this.user.fill(user);  
            },
            closeModal() {
                $('#userModal').modal('hide');
            }
        

        }
    }
</script>