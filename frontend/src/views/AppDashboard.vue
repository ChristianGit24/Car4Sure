<template>
  <div class="dashboard p-5 h-full flex flex-col">
    <!-- Header component -->
    <DashboardHeader />

    <!-- Table component -->
    <PolicyTable />
  </div>
</template>

<script>
// Import the components
import DashboardHeader from "../components/DashboardHeader.vue";
import PolicyTable from "../components/PolicyTable.vue";

export default {
  name: "AppDashboard",
  components: {
    DashboardHeader,
    PolicyTable,
  },
};
</script>

<style scoped></style>
