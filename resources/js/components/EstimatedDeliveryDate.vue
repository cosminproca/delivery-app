<template>
  <div class="text-xl font-semibold">Estimated Delivery Date:</div>
  <div v-if="estimatedDeliveryDate" class="text-light text-xl">
    {{ estimatedDeliveryDate }}
  </div>
</template>

<script>
export default {
  name: 'EstimatedDeliveryDate',
  props: {
    estimatedDeliveryDate: {
      type: String,
      default: ''
    },
    zipCode: {
      type: String,
      default: ''
    }
  }
};
</script>

<style scoped></style>
