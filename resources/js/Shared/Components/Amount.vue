<template>
    <input type="text" class="form-control" :class="size" v-money="money" v-model.lazy="value" :readonly="readonly">
</template>
<script>
import {VMoney} from 'v-money'
export default {
    props: ['readonly','size','index'],
    data(){
        return {
            value: 0,
            money: {
                decimal: '.',
                thousands: ',',
                prefix: '₱ ',
                precision: 2,
                masked: false
            },
        }
    },
    watch: {
        value: function(val){
            if(this.index != null){
                this.$emit('amount',[val,this.index]);
            }else{
                this.$emit('amount',val);
            }
        }
    },
    methods: {
        empty(){
            this.value = 0;
        }
    },
    directives: {money: VMoney},
}
</script>