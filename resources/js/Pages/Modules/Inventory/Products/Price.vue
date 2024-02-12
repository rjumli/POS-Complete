<template>
    <b-modal v-model="showModal" title="Update Price" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <b-form class="customform">
            <div class="row">
               <div class="col-md-12 mt-4">
                   <div class="form-group">
                        <label>Current Price:</label>
                        <input type="text" class="form-control" v-model="current" readonly>
                    </div>
                </div>
                 <div class="col-md-12 mt-2">
                   <div class="form-group">
                        <label>Price:</label>
                        <input type="text" class="form-control" v-model="price">
                    </div>
                </div>
            </div>
        </b-form>
        <template v-slot:footer>
            <b-button @click="showModal = false" variant="light" block>Cancel</b-button>
            <b-button @click="save('ok')" variant="primary"  block>Update</b-button>
        </template>
    </b-modal>
</template>

<script>
export default {
    data() {
        return {
            currentUrl: window.location.origin,
            showModal: false,
            price: '',
            current: '',
            form: {}
        }
    },
    methods: {
        set(data){
            this.id = data.id;
            this.current = data.price;
            this.showModal = true;
        },
        save(){
            this.form = this.$inertia.form({
                id: this.id,
                price: this.price,
                type: 'price'
            });

            this.form.put('/products/update',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.showModal = false;
                }
            });
        }
    }
}
</script>
