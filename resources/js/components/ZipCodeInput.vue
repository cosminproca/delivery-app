<template>
  <input
    v-mask="'######'"
    v-bind="$attrs"
    :value="modelValue"
    type="text"
    placeholder="Enter zip code..."
    class="py-3 px-4 rounded-md border-transparent shadow-md focus:outline-none focus:ring-2 focus:ring-blue-300"
    @change="$emit('update:modelValue', $event.target.value)"
  />
</template>

<script>
import { mask } from 'vue-the-mask';

export default {
  name: 'ZipCodeInput',
  directives: { mask },
  props: {
    modelValue: {
      type: String,
      default: ''
    }
  },
  emits: ['update:modelValue']
};
</script>

<style scoped></style>
