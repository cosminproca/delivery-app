<template>
  <div
    class="p-5 mb-10 bg-blue-400 min-w-96 min-h-16 text-center text-white rounded-md"
  >
    <div v-if="!loading">
      <EstimatedDeliveryDate
        :estimated-delivery-date="estimatedDeliveryDate"
        :zip-code="zipCode"
      />
    </div>
    <div v-else class="flex justify-center">
      <Spinner />
    </div>
  </div>
</template>
<script>
import EstimatedDeliveryDate from '@/components/EstimatedDeliveryDate';
import Spinner from '@/components/Spinner';

export default {
  name: 'EstimatedDeliveryDateContainer',
  components: { EstimatedDeliveryDate, Spinner },
  props: {
    estimatedDeliveryDate: {
      type: String,
      default: ''
    },
    zipCode: {
      type: String,
      default: ''
    },
    loading: {
      type: Boolean,
      default: false
    }
  }
};
</script>
