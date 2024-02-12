<template>
    <b-modal v-model="showModal" title="Add Product" style="--vz-modal-width: 700px;" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <b-form class="customform mb-2">
            <div class="row customerform">
                
                <div class="col-md-12 mt-4">
                   <div class="form-group">
                        <label>Name: <span v-if="form.errors" v-text="form.errors.name" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="product.name">
                    </div>
                </div>
                <div class="col-md-6" style="margin-top: -2px;">
                    <label>Category: <span v-if="form.errors" v-text="form.errors.category_id" class="haveerror"></span></label>
                    <multiselect v-model="product.category" id="ajax" label="name" track-by="id"
                        placeholder="Select " open-direction="bottom" :options="categories"
                        :allow-empty="false"
                        :show-labels="false">
                    </multiselect> 
                </div>
                <div class="col-md-6 mt-2">
                   <div class="form-group">
                        <label>Brand: <span v-if="form.errors" v-text="form.errors.brand" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="product.brand">
                    </div>
                </div>
                <div class="col-md-12 mt-0"><hr class="text-muted"/></div>
                <div class="col-md-3 mt-2">
                    <div class="form-group">
                        <label>Price: <span v-if="form.errors" v-text="form.errors.price" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="product.price">
                    </div>
                </div>
                <div class="col-md-3"  style="margin-top: -2px;">
                    <label>Pricing: <span v-if="form.errors" v-text="form.errors.pricing_id" class="haveerror"></span></label>
                    <multiselect v-model="product.pricing" id="ajax" label="name" track-by="id"
                        placeholder="Select" open-direction="bottom" :options="pricings"
                        :allow-empty="false"
                        :show-labels="false">
                    </multiselect> 
                </div>
                <div class="col-md-3 mt-2">
                    <div class="form-group">
                        <label>Size: <span class="fs-11 text-muted">(optional)</span> <span v-if="form.errors" v-text="form.errors.name" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="product.size">
                    </div>
                </div>
                <div class="col-md-3" style="margin-top: -2px;">
                    <label>Unit: <span v-if="form.errors" v-text="form.errors.unit_id" class="haveerror"></span></label>
                    <multiselect v-model="product.unit" id="ajax" label="name" track-by="id"
                        placeholder="Select" open-direction="bottom" :options="units"
                        :allow-empty="false"
                        :show-labels="false">
                    </multiselect> 
                </div>
                <div class="col-md-12 mt-0"><hr class="text-muted"/></div>
                <div class="col-md-12 mt-3">
                   <div class="form-group">
                        <textarea v-model="product.information" class="form-control" maxlength="225" rows="2" placeholder="Description"></textarea>
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
    props: ['categories','suppliers','units','dropdowns'],
    components: { Multiselect },
    data(){
        return {
            showModal: false,
            product: {
                id: '',
                name: '',
                brand: '',
                stock: '',
                information: '',
                category: '',
                pricing: '',
                price: '',
                size: '',
                unit: this.units[12]
            },
            form: {},
            editable: false,
        }
    },
    computed: {
        pricings : function() {
            return this.dropdowns.filter(x => x.classification == 'Pricing');
        },
    },
    methods : {
        show() {
            this.showModal = true;
        },
        edit(data){
            this.product = data;
            this.editable = true;
            this.showModal = true;
        },
        create(){
            this.form = this.$inertia.form({
                id: this.product.id,
                name: this.product.name,
                brand: this.product.brand,
                pricing_id: (this.product.pricing) ? this.product.pricing.id : '',
                price: this.product.price,
                unit_id: (this.product.unit) ? this.product.unit.id : '',
                size: this.product.size,
                information: this.product.information,
                category_id: (this.product.category) ? this.product.category.id : '',
                editable: this.editable
            })

            this.form.post('/products',{
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
        nameWithLang ({ name,supplier }) {
            return `${supplier.name} — ${name}`
        },
    }
}
</script>
<style>
.multiselect__single {
    font-size: 12px;
}
.multiselect__tags {
    border: 0;
    min-height: 37px;
    height: 37px;
} 
</style>
