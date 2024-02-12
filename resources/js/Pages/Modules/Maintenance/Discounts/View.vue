<template>
    <b-modal v-model="showModal" title="Item Based Discount" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <div class="col-xl-12">
            <div class="mt-xl-0 mt-5">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h5>{{list.item.name}} - <span class="text-muted" :class="list.item.type == 'Package' ? 'text-danger' : ''">{{ list.item.brand }}</span></h5>
                        <div class="hstack gap-3 flex-wrap">
                            <div class="fw-bold text-success">{{(list.discount.subtype.name == 'Amount') ? formatMoney(list.discount.value) : list.discount.value+'%'}}</div>
                            <div class="vr"></div>
                            <div class="text-muted">Start At: <span class="text-body fw-medium">{{list.start}}</span></div>
                            <div class="vr"></div>
                            <div class="text-muted">End At : <span class="text-body fw-medium">{{list.end}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
        </template>
    </b-modal>
</template>
<script>
export default {
    data(){
        return {
            showModal: false,
            list: {
                item : {},
                discount: { subtype:{}}
            }
        }
    },
    methods : {
        show(data) {
            this.list = data;
            this.showModal = true;
        },
        hide(){
            this.showModal = false;
        },
        formatMoney(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return '₱'+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
    }
}
</script>
<style>
.multiselect__single {
    font-size: 12px;
}
</style>
