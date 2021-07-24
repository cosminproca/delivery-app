<template>
  <label>
    <slot name="label" />
    <select
      class="ml-2 text-black"
      v-bind="$attrs"
      :value="modelValue"
      @change="$emit('update:modelValue', $event.target.value)"
    >
      <option value="0" disabled selected>Select Month</option>
      <option v-for="(option, index) in 12" :key="index" :value="option">
        {{ option }}
      </option>
    </select>
  </label>
</template>

<script>
export default {
  name: 'MonthSelect',
  props: {
    modelValue: {
      type: Number,
      default: 0
    }
  },
  emits: ['update:modelValue']
};
</script>

<style scoped></style>
