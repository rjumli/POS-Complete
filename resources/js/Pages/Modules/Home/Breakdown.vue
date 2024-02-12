<template>
    <div class="mt-1">
        <div class="d-flex mb-2">
            <h5 class="me-3 mb-0">{{total}} Total Sales <span class="text-muted fs-12">(By Status)</span></h5>
        </div>
        <div class="d-flex justify-content-between border-bottom border-bottom-dashed py-2" v-for="(b,index) in breakdown.sales" v-bind:key="index">
            <p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill align-middle me-2" :class="b.color"></i> {{ b.name }}</p>
            <div>
                <span class="text-success fw-medium fs-12">{{b.count}} Sales</span>
            </div>
        </div>
    </div>
    <hr class="text-muted mt-4 mb-4"/>
    <div class="mt-1">
        <div class="d-flex mb-2">
            <h5 class="me-3 mb-0">{{ptotal}} Total Product Sale <span class="text-muted fs-12">(By Status)</span></h5>
        </div>
        <div class="d-flex justify-content-between border-bottom border-bottom-dashed py-2" v-for="(b,index) in breakdown.salelists" v-bind:key="index">
            <p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill align-middle me-2" :class="b.color"></i> {{ b.name }}</p>
            <div>
                <span class="text-success fw-medium fs-12">{{b.count}} Sales</span>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['breakdown'],
    computed: {
        total(){
            return this.breakdown.sales.reduce(function (total, item) {
                return total + item.count;
            }, 0);
        },
        ptotal(){
            return this.breakdown.salelists.reduce(function (total, item) {
                return total + item.count;
            }, 0);
        }
    }
}
</script>