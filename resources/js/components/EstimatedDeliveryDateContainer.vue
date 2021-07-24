<template>
  <div
    class="p-5 mt-10 bg-blue-400 w-96 min-h-16 text-center text-white rounded-md"
  >
    <div v-if="!loading">
      <EstimatedDeliveryDate
        :estimated-delivery-date="estimatedDeliveryDate"
        :day-word-form="dayWordForm"
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
    dayWordForm: {
      type: String,
      default: 'days'
    },
    estimatedDeliveryDate: {
      type: Number,
      default: 0
    },
    loading: {
      type: Boolean,
      default: false
    }
  }
};
</script>
