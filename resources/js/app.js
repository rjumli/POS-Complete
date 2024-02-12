require('./bootstrap');

import { createApp, h } from 'vue'
import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from "@inertiajs/progress";

import VueApexCharts from "vue3-apexcharts";
import BootstrapVue3 from 'bootstrap-vue-3';
import Layout from "@/Shared/Layout/Index";

createInertiaApp({
    resolve: name => {
        let page = require(`./Pages/${name}`).default;
        if (page.layout === undefined) {
            page.layout = Layout;
        }
        return page;
    },
    setup({ el, App, props, plugin}) {
        createApp({
                render: () => h(App, props)
            })
            .use(plugin)
            .use(BootstrapVue3)
            .use(VueApexCharts)
            .component("Link", Link)
            .component("Head", Head)
            .mount(el)
    },
    title: title => `POS | ${title}`
})

