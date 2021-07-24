<template>
  <span class="text-xl font-semibold">Estimated Delivery Date: </span>
  <span v-if="estimatedDeliveryDate" class="text-light text-xl">
    {{ estimatedDeliveryDate }} {{ dayWordForm }}
  </span>
</template>

<script>
export default {
  name: 'EstimatedDeliveryDate',
  props: {
    estimatedDeliveryDate: {
      type: Number,
      default: 0
    },
    dayWordForm: {
      type: String,
      default: 'days'
    }
  }
};
</script>

<style scoped></style>
