<template>
    <Vertical :role="role" :role_menus="role_menus"> <slot/> </Vertical>
    <b-modal v-model="message" hide-footer class="v-modal-custom" modal-class="zoomIn" body-class="p-0" centered hide-header-close>
        <div class="text-end me-4">
            <button type="button" class="btn-close text-end" @click="check()"></button>
        </div>
        <div class="text-center px-5 pt-2">
            <div class="mt-2">
                 <div class="avatar-md mx-auto">
                    <div class="avatar-title rounded-circle bg-light">
                        <i :class="'bx '+$page.props.flash.type+' h1 mb-0 text-'+$page.props.flash.color"></i>
                    </div>
                </div>
                <h5 class="mb-3 mt-4">{{$page.props.flash.message }}</h5>
            </div>
        </div>
        <div class="modal-footer bg-light p-3 mt-5 justify-content-center">
            <p class="mb-0 text-muted fs-10">Any suggestions please contact
                <b-link href="genpos8.com" target="_blank" class="link-secondary fw-semibold">Administrator</b-link>
            </p>
        </div>
    </b-modal>
</template>
<script>
import Vertical from './Vertical.vue';
export default {
    props: ['role','role_menus'],
    components : { Vertical },
    computed: {
        message() {
            return (this.$page.props.flash.message) ?  true : false;
        }
    },
    methods: {
        check(){
            this.$page.props.flash.message = '';
            this.message = false;
        }
    }
}
</script>
