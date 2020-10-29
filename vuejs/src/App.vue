<template>
    <div class="uk-flex uk-flex-top is-preload">
        <FilterList />
        <JobList />
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

<style lang="less" scoped>
    .is-preload {
        &:after {
            z-index: 100;
            background: rgba(0,0,0,.2);
            position: fixed;
            left: 0;
            top: 0;
        }
    }
</style>