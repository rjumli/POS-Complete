<template>
    <div class="ms-1 header-item d-none d-sm-flex">
        <b-button type="button" variant="ghost-secondary" class="btn-icon btn-topbar rounded-circle"
            data-toggle="fullscreen" @click="initFullScreen">
            <i class="bx bx-fullscreen fs-22"></i>
        </b-button>
    </div>

    <div class="ms-1 header-item d-none d-sm-flex">
        <b-button type="button" variant="ghost-secondary" class="btn-icon btn-topbar rounded-circle light-dark-mode"
            @click="toggleDarkMode">
            <i class="bx bx-moon fs-22"></i>
        </b-button>
    </div>
</template>
<script>
    export default {
        methods: {
            initFullScreen() {
                document.body.classList.toggle("fullscreen-enable");
                if (
                    !document.fullscreenElement &&
                    /* alternative standard method */
                    !document.mozFullScreenElement &&
                    !document.webkitFullscreenElement
                ) {
                    // current working methods
                    if (document.documentElement.requestFullscreen) {
                        document.documentElement.requestFullscreen();
                    } else if (document.documentElement.mozRequestFullScreen) {
                        document.documentElement.mozRequestFullScreen();
                    } else if (document.documentElement.webkitRequestFullscreen) {
                        document.documentElement.webkitRequestFullscreen(
                            Element.ALLOW_KEYBOARD_INPUT
                        );
                    }
                } else {
                    if (document.cancelFullScreen) {
                        document.cancelFullScreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    } else if (document.webkitCancelFullScreen) {
                        document.webkitCancelFullScreen();
                    }
                }
            },

            toggleDarkMode() {
                if (document.documentElement.getAttribute("data-layout-mode") == "dark") {
                    document.documentElement.setAttribute("data-layout-mode", "light");
                } else {
                    document.documentElement.setAttribute("data-layout-mode", "dark");
                }
            },
        }
    }

</script>
