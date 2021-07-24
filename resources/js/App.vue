<template>
  <PageHeader />

  <ZipCodeInput v-model="zipCode" @keyup.enter="calculateDeliveryDate" />

  <Errors :errors="errors" />

  <EstimatedDeliveryDateContainer
    :day-word-form="dayWordForm"
    :estimated-delivery-date="estimatedDeliveryDate"
    :loading="loading"
  />
</template>

<script>
import { computed, ref } from 'vue';
import EstimatedDeliveryDateContainer from '@/components/EstimatedDeliveryDateContainer';
import ZipCodeInput from '@/components/ZipCodeInput';
import PageHeader from '@/components/PageHeader';
import Errors from '@/components/Errors';
import axios from 'axios';

export default {
  name: 'App',
  components: {
    EstimatedDeliveryDateContainer,
    ZipCodeInput,
    PageHeader,
    Errors
  },
  setup() {
    const zipCode = ref('');
    const errors = ref(null);
    const estimatedDeliveryDate = ref(0);
    const loading = ref(false);

    const dayWordForm = computed(() =>
      estimatedDeliveryDate.value === 1 ? 'day' : 'days'
    );

    const fetchDeliveryDate = async zipCode => {
      try {
        const { data } = await axios.post('api/estimate_delivery', {
          zip_code: zipCode
        });

        return data;
      } catch (e) {
        return e.response.data;
      }
    };

    const calculateDeliveryDate = async () => {
      if (zipCode.value === '') return;

      loading.value = true;
      errors.value = null;

      const res = await fetchDeliveryDate(zipCode.value);

      if (res.errors) {
        errors.value = res.errors;
      } else {
        estimatedDeliveryDate.value = res;
      }

      loading.value = false;
    };

    return {
      errors,
      loading,
      zipCode,
      dayWordForm,
      estimatedDeliveryDate,
      calculateDeliveryDate
    };
  }
};
</script>

<style scoped></style>
