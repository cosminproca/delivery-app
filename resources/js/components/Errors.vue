<template>
  <div
    v-if="errors"
    class="bg-gray-50 rounded-md p-5 flex flex-col space-y-2 mt-10"
  >
    <span
      v-for="(zipCodeError, index) in errors.errors.zip_code"
      :key="index"
      class="text-red-600 font-semibold"
    >
      - {{ zipCodeError }}
    </span>
    <span
      v-for="(dateRangeError, index) in errors.errors.date_range"
      :key="index"
      class="text-red-600"
    >
      {{ dateRangeError }}
    </span>
  </div>
</template>

<script>
export default {
  name: 'Errors',
  props: {
    errors: {
      type: Object,
      default: null
    }
  }
};
</script>

<style scoped></style>
