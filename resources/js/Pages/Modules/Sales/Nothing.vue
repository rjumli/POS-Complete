<template>
    <b-modal v-model="showModal" hide-footer title="Item" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <div class="col-xl-12">
            <div class="mt-xl-0 mt-5">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h4>{{selected.name}}</h4>
                        <div class="hstack gap-3 flex-wrap">
                            <div><a href="#" class="text-primary d-block">{{selected.category.name}}</a></div>
                            <div class="vr"></div>
                            <div class="text-muted">Brand : <span class="text-body fw-medium">{{selected.brand}}</span></div>
                            <div class="vr"></div>
                            <div class="text-muted">Created At : <span class="text-body fw-medium">{{selected.created_at}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="text-muted"/>
            <div class="alert alert-danger mb-xl-0 text-center" role="alert">
                <strong> No Available stock. </strong>
            </div>
        </div>
    </b-modal>
</template>
<script>
export default {
    data(){
        return {
            showModal: false,
            selected: { category: ''}
        }
    },
    methods : {
        show(data) {
            this.selected = data;
            this.showModal = true;
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
