<template>
    <b-modal v-model="showModal" title="Update Status" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <b-form class="customform">
            <div class="row">
                <div class="col-md-12 mt-2 mb-n3" v-if="!is_available">
                    <div class="alert alert-success alert-dismissible alert-label-icon rounded-label" role="alert"><i class="ri-error-warning-line label-icon"></i>Mark as Available </div>
                </div>
                 <div class="col-md-12 mt-2 mb-n3" v-else>
                    <div class="alert alert-warning alert-dismissible alert-label-icon rounded-label" role="alert"><i class="ri-error-warning-line label-icon"></i>Mark as Not Available</div>
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
            is_available: '',
            form: {}
        }
    },
    methods: {
        set(data){
            this.id = data.id;
            this.is_available = data.is_available;
            this.showModal = true;
        },
        save(){
            this.form = this.$inertia.form({
                id: this.id,
                is_available: (this.is_available) ? 0 : 1,
                type: 'status'
            });

            this.form.put('/packages/update',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.showModal = false;
                }
            });
        }
    }
}
</script>
