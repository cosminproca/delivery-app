<template>
  <div
    class="flex flex-col space-y-2 text-white p-5 bg-blue-400 mt-10 rounded-md"
  >
    <div>
      <div class="text-xl mb-2 font-semibold">
        Filter By Current Day - 10 days
      </div>
      <label>
        Current Day - 10 days
        <input
          v-model="currentDayMinusTenDaysFilter"
          type="checkbox"
          class="ml-2"
        />
      </label>
    </div>
    <div>
      <div class="text-xl mb-2 font-semibold">Filter By Starting Month</div>
      <MonthSelect v-model="startingMonthFilter">
        <template #label>
          Choose Starting Month
        </template>
      </MonthSelect>
    </div>
    <div class="flex flex-col space-y-2">
      <div class="text-xl mb-2 font-semibold">Filter Between Two Months</div>
      <MonthSelect v-model="betweenMonthsFilterStart">
        <template #label>
          Choose Starting Month
        </template>
      </MonthSelect>
      <MonthSelect v-model="betweenMonthsFilterEnd">
        <template #label>
          Choose Ending Month
        </template>
      </MonthSelect>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';
import MonthSelect from '@/components/MonthSelect';

export default {
  name: 'Filters',
  components: {
    MonthSelect
  },
  setup() {
    const currentDayMinusTenDaysFilter = ref(false);
    const startingMonthFilter = ref(0);
    const betweenMonthsFilterStart = ref(0);
    const betweenMonthsFilterEnd = ref(0);

    return {
      currentDayMinusTenDaysFilter,
      startingMonthFilter,
      betweenMonthsFilterStart,
      betweenMonthsFilterEnd
    };
  }
};
</script>

<style scoped></style>
