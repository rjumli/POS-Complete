<template>
    <b-modal v-model="showModal" title="Add Product" style="--vz-modal-width: 700px;" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <b-form class="mb-2">
            <div class="row customform ">
                <div class="col-md-12 mt-4">
                   <div class="form-group">
                        <label>Name: <span v-if="form.errors" v-text="form.errors.name" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="product.name">
                    </div>
                </div>
                <div class="col-md-6" style="margin-top: -2px;">
                    <label>Category: <span v-if="form.errors" v-text="form.errors.category_id" class="haveerror"></span></label>
                    <multiselect v-model="product.category" id="ajax" label="name" track-by="id"
                        placeholder="Select " open-direction="bottom" :options="categories_list"
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
            </div>
            <div class="row">
                <div class="col-md-12 mt-0"><hr class="text-muted"/></div>
                <div class="col-md-6">
                    <label style="margin-bottom: -10px; font-size: 11px;">Price: <span v-if="form.errors" v-text="form.errors.price" class="haveerror"></span></label>
                    <div class="input-group mb-1">
                        <input type="text" v-model="product.price" placeholder="Price" class="form-control" style="width: 50%;">
                        <select v-model="product.pricing" class="form-select" id="inputGroupSelect02" style="width: 50%;">
                            <option :value="null" selected>Select</option>
                            <option :value="list.id" v-for="list in pricings" v-bind:key="list.id">{{list.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label style="margin-bottom: -10px; font-size: 11px;">Total Price with Percentage: <span v-if="form.errors" v-text="form.errors.percentage_id" class="haveerror"></span></label>
                    <div class="input-group mb-1">
                        <input type="text" v-model="product.price" placeholder="Price" class="form-control" style="width: 70%;" readonly>
                        <select v-model="product.percentage" class="form-select" id="inputGroupSelect02" style="width: 30%;">
                            <option :value="null" selected>Select</option>
                            <option :value="list.id" v-for="list in percentages" v-bind:key="list.id">{{list.percentage}}%</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label style="margin-bottom: -10px; font-size: 11px;">Unit: <span v-if="form.errors" v-text="form.errors.size" class="haveerror"></span></label>
                    <div class="input-group mb-1">
                        <input type="text" v-model="product.size" placeholder="Size" class="form-control" style="width: 50%;">
                        <select v-model="product.unit" class="form-select" id="inputGroupSelect02" style="width: 50%;">
                            <option :value="null" selected>Select</option>
                            <option :value="list.id" v-for="list in units" v-bind:key="list.id">{{list.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label style="margin-bottom: -10px; font-size: 11px;">Warranty: <span class="text-muted fs-10">(optional)</span></label>
                    <div class="input-group mb-1">
                        <input type="number" v-model="product.warrantynumber" placeholder="Enter" class="form-control" style="width: 50%;">
                        <select v-model="product.warrantytype" class="form-select" id="inputGroupSelect02" style="width: 50%;">
                            <option :value="null" selected>Select</option>
                            <option value="Years" selected>Years</option>
                            <option value="Months" selected>Months</option>
                            <option value="Weeks" selected>Weeks</option>
                            <option value="Days" selected>Days</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                   <div class="form-group">
                        <textarea v-model="product.description" class="form-control" maxlength="225" rows="2" placeholder="Description"></textarea>
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                   <div class="form-group">
                        <label class="text-warning" style="margin-bottom: -10px; font-size: 11px;">Average Demand: <span v-if="form.errors" v-text="form.errors.reorder" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="product.demand">
                    </div>
                </div>
                 <div class="col-md-4 mt-2">
                   <div class="form-group">
                        <label class="text-warning" style="margin-bottom: -10px; font-size: 11px;">Lead Time: <span v-if="form.errors" v-text="form.errors.reorder" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="product.lead">
                    </div>
                </div>
                 <div class="col-md-4 mt-2">
                   <div class="form-group">
                        <label class="text-warning" style="margin-bottom: -10px; font-size: 11px;">Safety Stock: <span v-if="form.errors" v-text="form.errors.reorder" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="product.safety">
                    </div>
                </div>
                <!-- <div class="col-md-3 mt-2">
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
                </div> -->
                <!-- <div class="col-md-3 mt-2">
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
                </div> -->

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
    props: ['categories','suppliers','units','dropdowns','percentages'],
    components: { Multiselect },
    data(){
        return {
            showModal: false,
            product: {
                id: '',
                name: '',
                brand: '',
                stock: '',
                category: '',
                pricing: null,
                price: '',
                size: '',
                percentage: 1,
                warrantynumber: '',
                warrantytype: null,
                unit: this.units[12].id,
                description: '',
                demand: '',
                lead: '',
                stock: ''
            },
            form: {},
            editable: false,
        }
    },
    computed: {
        pricings : function() {
            return this.dropdowns.filter(x => x.classification == 'Pricing');
        },
        categories_list : function() {
            return this.categories.filter(x => x.is_active == 1);
        },
    },
    methods : {
        show() {
            this.showModal = true;
        },
        edit(data){
            this.product = data;
            this.product.pricing = data.pricing.id;
            this.product.unit = data.unit.id;
            this.product.percentage = data.percentage.id;
            this.editable = true;
            this.showModal = true;
        },
        create(){
            this.form = this.$inertia.form({
                id: this.product.id,
                name: this.product.name,
                brand: this.product.brand,
                pricing_id: (this.product.pricing) ? this.product.pricing : '',
                percentage_id: (this.product.percentage) ? this.product.percentage : '',
                price: this.product.price,
                unit_id: (this.product.unit) ? this.product.unit : '',
                size: this.product.size,
                description: this.product.description,
                warranty: (this.product.warrantynumber) ? this.product.warrantynumber+' '+this.product.warrantytype : '',
                category_id: (this.product.category) ? this.product.category.id : '',
                editable: this.editable,
                demand: this.product.demand,
                lead: this.product.lead,
                safety: this.product.safety,
            })

            this.form.post('/products',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.hide();
                },
            });
        },
        hide(){
            this.product = {
                id: '',
                name: '',
                brand: '',
                stock: '',
                information: '',
                category: '',
                pricing: '',
                price: '',
                size: '',
                demand: '',
                lead: '',
                safety: '',
                unit: this.units[12]
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
.input-group > :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
  font-size: 10px;
}
</style>
