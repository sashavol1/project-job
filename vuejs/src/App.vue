<template>
    <div class="uk-flex uk-flex-top">
        <FilterList msg="Welcome to Your Vue.js App"/>
        <JobList msg="Welcome to Your Vue.js App"/>
    </div>
</template>

<script>
import FilterList from './components/FilterList.vue'
import JobList from './components/JobList.vue'

export default {
  name: 'App',
  components: {
    FilterList, JobList
  }
}
</script>