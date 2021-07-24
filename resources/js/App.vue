<template>
  <PageHeader />

  <EstimatedDeliveryDateContainer
    :zip-code="zipCode"
    :estimated-delivery-date="estimatedDeliveryDate"
    :loading="loading"
  />

  <ZipCodeInput v-model="zipCode" @keyup.enter="calculateDeliveryDate" />

  <Errors :errors="errors" />
</template>

<script>
import { ref } from 'vue';
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
    const estimatedDeliveryDate = ref('');
    const loading = ref(false);

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
      estimatedDeliveryDate.value = '';

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
      estimatedDeliveryDate,
      calculateDeliveryDate
    };
  }
};
</script>

<style scoped></style>
