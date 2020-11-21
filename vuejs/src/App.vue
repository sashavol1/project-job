<template>
    <div class="uk-flex uk-flex-top uk-grid-small" uk-grid>
        <Spinner v-if="isLoad" />
        <div class="uk-width-1-3@m">
          <FilterList 
            :categories="categories" 
            @set-filter="handlerSetFilter" />
        </div>
        <div class="uk-width-1-2@m">
          <JobList :jobs="jobs" @set-job="handlerLoadJob" />
        </div>
        <transition name="fade">
          <DetailJob v-if="showModal" :job="job" @set-show="handlerCloseJob" />
        </transition>
    </div>
</template>

<script>
import DetailJob from './components/DetailJob.vue'
import FilterList from './components/FilterList.vue'
import JobList from './components/JobList.vue'
import Spinner from './components/Spinner.vue'

import categoryFactory from "./factories/category";
import jobFactory from "./factories/jobs";
import { onMounted } from "vue";

export default {
  setup() {
    const { loadCategories, categories } = categoryFactory();
    const { loadJobs, loadJob, jobs, job, isLoad } = jobFactory();
    onMounted(async () => {
        await loadCategories();
        await loadJobs();
    })
    return {
      categories,
      jobs,
      job,
      loadCategories,
      loadJobs,
      loadJob,
      isLoad
    };
  },
  name: 'App',
  components: {
    FilterList, JobList, Spinner, DetailJob
  },
  data() {
    return {
      showModal: false
    }
  },
  methods: {
    async handlerSetFilter(array) {
      await this.loadJobs(array);
    },
    async handlerLoadJob(array) {
      this.showModal = true;
      await this.loadJob(array);
    },
    handlerCloseJob(bool) {
      this.showModal = bool
    }
  }
};

</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>