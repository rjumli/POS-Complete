<template>
    <b-modal v-model="showModal" title="New Terms and Condition" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <b-form class="customform mb-2">
            <div class="row customerform">
                
                <div class="col-md-12 mt-4">
                   <div class="form-group">
                        <label>Percentage: <span v-if="form.errors" v-text="form.errors.percentage" class="haveerror"></span></label>
                        <input type="number" class="form-control" v-model="pricing.percentage">
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
import Multiselect from '@suadelabs/vue3-multiselect';
export default {
    components: { Multiselect },
    data(){
        return {
            showModal: false,
            pricing: {
                id: '',
                percentage: ''
            },
            form: {},
            editable: false,
        }
    },
    methods : {
        show() {
            this.showModal = true;
        },
        edit(data){
            this.pricing = data;
            this.editable = true;
            this.showModal = true;
        },
        create(){
            this.form = this.$inertia.form({
                id: this.pricing.id,
                percentage: this.pricing.percentage,
                editable: this.editable
            })

            this.form.post('/pricings',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.hide();
                },
            });
        },
        hide(){
            this.pricing = {
                id: '',
                percentage: ''
            };
            this.$emit('message',true);
            this.showModal = false;
        },
    }
}
</script>
