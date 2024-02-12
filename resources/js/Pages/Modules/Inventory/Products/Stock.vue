<template>
    <b-modal v-model="showModal" title="Stock Adjustment" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <b-form class="customform">
            <div class="row">
                <div class="col-md-12 mt-4">
                   <div class="form-group">
                        <label>Quantity: <span v-if="form.errors" v-text="form.errors.quantity" class="haveerror"></span></label>
                        <input type="number"  v-maska data-maska="#" class="form-control" min="1" v-model="quantity">
                    </div>
                </div> 
                <div class="col-md-12 mt-3">
                   <div class="form-group">
                        <textarea v-model="reason" class="form-control" maxlength="225" rows="3" placeholder="Reason"></textarea>
                    </div>
                </div>
            </div>
        </b-form>
        <template v-slot:footer>
            <b-button @click="showModal = false" variant="light" block>Cancel</b-button>
            <b-button @click="save('ok')" variant="primary"  block>Save</b-button>
        </template>
    </b-modal>
</template>

<script>
import { vMaska } from "maska"
export default {
        directives: { maska: vMaska },
    data() {
        return {
            currentUrl: window.location.origin,
            showModal: false,
            id: '',
            quantity: 1,
            reason: '',
            form: {}
        }
    },

    methods: {
        set(data){
            this.id = data.id;
            this.is_active = data.is_active;
            this.showModal = true;
        },
        save(){
            this.form = this.$inertia.form({
                product_id: this.id,
                reason: this.reason,
                quantity: this.quantity,
                type: 'adjustment'
            });

            this.form.put('/products/update',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.showModal = false;
                }
            });
        },
    }
}
</script>
