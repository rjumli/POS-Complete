<template>
    <b-modal v-model="showModal" title="Add User" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <b-form class="customform mb-2">
            <div class="row customerform">
                
                <div class="col-md-12 mt-4">
                   <div class="form-group">
                        <label>Name: <span v-if="form.errors" v-text="form.errors.name" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="user.name" style="text-transform: capitalize;">
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                   <div class="form-group">
                        <label>Username: <span v-if="form.errors" v-text="form.errors.username" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="user.username">
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                   <div class="form-group">
                        <label>Email: <span v-if="form.errors" v-text="form.errors.email" class="haveerror"></span></label>
                        <input type="email" class="form-control" v-model="user.email">
                    </div>
                </div>
                <div class="col-md-12">
                    <label>Role: <span v-if="form.errors" v-text="form.errors.role" class="haveerror"></span></label>
                    <multiselect v-model="user.role" id="ajax" label="name" track-by="id"
                        placeholder="Select Role" open-direction="bottom" :options="roles"
                        :allow-empty="false"
                        :show-labels="false">
                    </multiselect> 
                </div>
    
            </div>
        </b-form>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="create('ok')" variant="primary" :disabled="form.processing" block>Save</b-button>
        </template>
    </b-modal>
</template>
<script>
import Multiselect from '@suadelabs/vue3-multiselect';
export default {
    props: ['roles'],
    components: { Multiselect },
    data(){
        return {
            showModal: false,
            user: {
                id: '',
                name: '',
                username: '',
                email: '',
                role: ''
            },
            // roles: ['Inventory Manager','Cashier','Assistant Clerk','Owner'],
            form: {},
            editable: false,
        }
    },

    methods : {
        show() {
            this.showModal = true;
        },
        edit(data){
            this.user = data;
            this.editable = true;
            this.showModal = true;
        },
        create(){
            this.form = this.$inertia.form({
                id: this.user.id,
                name: this.user.name,
                username: this.user.username,
                email: this.user.email,
                password: '123456789',
                role_id: this.user.role.id,
                editable: this.editable
            })

            this.form.post('/users',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.hide();
                },
            });
        },
        hide(){
            this.customers = {
                id: '',
                name: '',
                contact: '',
                email: '',
            };
            this.$emit('message',true);
            this.showModal = false;
        },
    }
}
</script>
<style>
.multiselect__single {
    font-size: 12px;
}
</style>
