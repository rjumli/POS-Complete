<template>
    <b-modal v-model="showModal" title="Generate Backup" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <div class="col-xl-12">
            <div class="mt-xl-0 mt-5">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <b-alert v-if="flag" show variant="warning">
                            <strong> Please wait</strong>
                        </b-alert>
                         <b-alert v-else show variant="info">
                            <strong> Generate backup now?</strong>
                        </b-alert>
    
                    </div>
                    <!-- success Alert -->
   
                </div>
            </div>
        </div>
         <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="create('ok')" variant="primary" :disabled="form.processing" block>Generate</b-button>
        </template>
    </b-modal>
</template>
<script>
export default {
    data(){
        return {
            showModal: false,
            form: {},
            flag: false
        }
    },
    methods : {
        show() {
            this.showModal = true;
        },
        create(){
            this.flag = true;
            this.form = this.$inertia.form({});
            this.form.get('/backups/create',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.flag = false;
                    this.showModal = false;
                },
            });
        },
        hide(){
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
