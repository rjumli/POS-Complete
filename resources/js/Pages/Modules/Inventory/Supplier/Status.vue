<template>
    <b-modal v-model="showModal" title="Update Status" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <b-form class="customform">
            <div class="col-md-12 mt-1">
              REFUND NOW!
            </div>
        </b-form>
        <template v-slot:footer>
            <b-button @click="showModal = false" variant="light" block>Cancel</b-button>
            <b-button @click="save('ok')" variant="primary"  block>Update</b-button>
        </template>
    </b-modal>
</template>

<script>
import Multiselect from '@suadelabs/vue3-multiselect';
export default {
    components : { Multiselect },
    props: ['dropdowns'],
    data() {
        return {
            currentUrl: window.location.origin,
            showModal: false,
            selected: '',
            reason: '',
            info: '',
            form: {}
        }
    },
    computed: {
        reasons : function() {
            return this.dropdowns.filter(x => x.classification == 'Reason');
        },
    },
    methods: {
        set(data){
            this.selected = data;
            this.showModal = true;
        },
        save(){
            this.form = this.$inertia.form({
                id: this.selected.return.id,
                reason_id: 36,
            });

            this.form.put('/supplier/update',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.showModal = false;
                    this.$emit('message',true);
                }
            });
        }
    }
}
</script>
