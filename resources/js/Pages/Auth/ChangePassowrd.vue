<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <template v-slot:header>
            <h5 class="fs-14 modal-title">Change Password</h5>
            <button @click="hide()" type="button" class="btn-close" aria-label="Close"></button>
        </template>
        <form class="customform">
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="form-group mb-4">
                        <label>Current Password: <span v-if="form.errors" v-text="form.errors.current_password" class="haveerror"></span></label>
                        <input type="password" class="form-control" v-model="current_password" >
                    </div>
                    <hr class="text-muted"/>
                </div>
                <div class="col-md-12 mt-4 mb-4" v-if="!this.$page.props.auth.data.is_active">
                    <div class="alert alert-danger mb-xl-0" role="alert"><strong>Please update your password.</strong> Thanks</div>
                </div>
                <div class="col-md-12">
                    <p class="mt-1 text-sm text-muted fs-11 mb-4">
                        Ensure your account is using a long, random password to stay secure.
                    </p>
                    
                    <div class="form-group mb-3">
                        <label>New Password: <span v-if="form.errors" v-text="form.errors.password" class="haveerror"></span></label>
                        <input type="password" class="form-control" v-model="password" >
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mb-2">
                        <label>Confirm Password: <span v-if="form.errors" v-text="form.errors.password_confirmation" class="haveerror"></span></label>
                        <input type="password" class="form-control" v-model="password_confirmation">
                    </div>
                </div>
            </div>
        </form>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="create('ok')" variant="primary" :disabled="form.processing" block>Save</b-button>
        </template>
    </b-modal>
</template>
<script>
export default {
    data(){
        return {
            currentUrl: window.location.origin,
            showModal: false,
            password: '',
            password_confirmation: '',
            current_password: '',
            form: {}
        }
    },
    methods: {
        show(){
            this.showModal = true;
        },
        hide(){
            this.showModal = false;
        },
        create() {
            this.form = this.$inertia.form({
                current_password: this.current_password,
                password: this.password,
                password_confirmation: this.password_confirmation,
            })

            this.form.put('/home/update',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.hide();
                }
            });
        },
    }
}
</script>