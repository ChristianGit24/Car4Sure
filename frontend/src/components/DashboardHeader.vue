<template>
  <header
    class="flex justify-between items-center shadow-md mb-3 p-3 px-5 bg-slate-100 text-black rounded-full"
  >
    <div class="logo">
      <h1 class="text-3xl">
        Car<b class="px-1 text-4xl leading-none" style="color: #f97316">4</b
        >Sure
      </h1>
    </div>
    <div class="header-info text-lg">
      <p>
        Welcome! Today is <span class="highlight">{{ currentDate }}</span>
      </p>
    </div>
  </header>
</template>

<script>
export default {
  name: "DashboardHeader",
  data() {
    return {
      currentDate: new Date().toLocaleDateString("en-US", {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
      }),
    };
  },
};
</script>

<style scoped>
.header-info {
  color: #374151;
}
.highlight {
  color: #f97316;
  font-weight: bold;
}
</style>
