<template>
    <div id="layout-wrapper">
        <Header />
        <Menu :role_menus="role_menus" :role="role"/>
        <!-- @include('layouts.sidebar') -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <slot />
                </div>
            </div>
            
            <Footer />
        </div>
    </div>
</template>
<script>
import { SimpleBar } from "simplebar-vue3";
import Header from '../Components/Header.vue';
import Footer from '../Components/Footer.vue';
import Menu from '../Components/Menu.vue';
export default {
    props: ['role','role_menus'],
    components : { Footer, Header, SimpleBar, Menu },
    data() {
        return {
            isMenuCondensed: false,
            layoutType: 'vertical',
            layoutWidth: 'fluid',
            sidebarSize: 'lg',
            topbar: 'light',
            mode: 'light',
            position: 'fixed',
            sidebarView: 'default',
            sidebarColor: 'dark',
            sidebarImage: 'none',
            preloader: 'disable'
        };
    },
    created: () => {
      document.body.removeAttribute("data-layout", "horizontal");
      document.body.removeAttribute("data-topbar", "dark");
      document.body.removeAttribute("data-layout-size", "boxed");


    },
    methods : {
        initActiveMenu() {
            if (document.documentElement.getAttribute('data-sidebar-size') === 'sm-hover') {
                localStorage.setItem('hoverd',true)
                document.documentElement.setAttribute('data-sidebar-size', 'sm-hover-active');
            } else if (document.documentElement.getAttribute('data-sidebar-size') === 'sm-hover-active') {
                localStorage.setItem('hoverd',false)
                document.documentElement.setAttribute('data-sidebar-size', 'sm-hover');
            } else {
                document.documentElement.setAttribute('data-sidebar-size', 'sm-hover');
            }
        },
        toggleMenu() {
            document.body.classList.toggle("sidebar-enable");
    
            if (window.screen.width >= 992) {
            // eslint-disable-next-line no-unused-vars
                router.afterEach((routeTo, routeFrom) => {
                    document.body.classList.remove("sidebar-enable");
                    document.body.classList.remove("vertical-collpsed");
                });
                document.body.classList.toggle("vertical-collpsed");
            }else{
            // eslint-disable-next-line no-unused-vars
                router.afterEach((routeTo, routeFrom) => {
                    document.body.classList.remove("sidebar-enable");
                });
                document.body.classList.remove("vertical-collpsed");
            }
            this.isMenuCondensed = !this.isMenuCondensed;
        },
        toggleRightSidebar() {
            document.body.classList.toggle("right-bar-enabled");
        },
        hideRightSidebar() {
            document.body.classList.remove("right-bar-enabled");
        },
    }
}
</script>