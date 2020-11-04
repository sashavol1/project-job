<template>
    <div class="uk-width-1-2 uk-card-small uk-margin-left">
        <div v-if="jobs.length === 0">
            <div class="uk-alert-warning uk-alert" uk-alert>
                <p>Ничего не нашли!</p>
            </div>
        </div>
        <div class="uk-card uk-card-default uk-width-1-1@m uk-margin" v-for="i in jobs" :key="i.name">
            <div class="uk-card-header">
                <div class="uk-grid-small uk-flex-middle uk-grid" uk-grid="">
                    <div class="uk-width-auto uk-first-column">
                        <img class="uk-border-circle" width="40" height="40" v-bind:src="'http://job.loc/' + i.user_avatar">
                    </div>
                    <div class="uk-width-expand">
                        <h3 class="uk-card-title uk-margin-remove-bottom">{{i.name}}</h3>
                        <p class="uk-text-meta uk-margin-remove-top"><time datetime="{{i.dt_add}}">{{i.dt_add}}</time> | {{i.user_name}}</p>
                    </div>
                </div>
            </div>
            <div class="uk-card-body">
                <p>{{i.announcement}}</p>
            </div>
            <div class="uk-card-footer">
                <a class="uk-button uk-button-text" @click="setJob(i.id)">Подробнее</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  name: 'JobList',
  props: {
    jobs: Array
  },
  methods: {
    setJob(id = null) {
      this.$emit('set-job', {job_id: id });
    }
  }
};
</script>