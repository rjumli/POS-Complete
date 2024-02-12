<template>
<!-- style="--vz-modal-width: 590px;" -->
    <b-modal v-model="showModal" title="New Name" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <b-form class="customform mb-2">
            <div class="row customerform">
                
                <div class="col-md-12 mt-4">
                   <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" v-model="name" style="text-transform: capitalize;">
                    </div>
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
export default {
    data(){
        return {
            currentUrl: window.location.origin,
            showModal: false,
            id: '',
            name: '',
            form: {},
            editable: false,
        }
    },
    methods : {
        show(data) {
            this.id = '';
            this.name = data;
            this.editable = false;
            this.showModal = true;
        },
        create(){
            this.form = this.$inertia.form({
                id: this.id,
                name: this.name,
                type: 'name',
                editable: this.editable
            })

            this.form.post('/suppliers',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.hide();
                },
            });
        },
        hide(){
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
