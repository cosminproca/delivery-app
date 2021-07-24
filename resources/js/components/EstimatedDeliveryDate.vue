<template>
  <span class="text-xl font-semibold">Estimated Delivery Date: </span>
  <span v-if="zipCode" class="text-light text-xl">
    {{ estimatedDeliveryDate }}
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
    zipCode: {
      type: String,
      default: ''
    }
  }
};
</script>

<style scoped></style>
