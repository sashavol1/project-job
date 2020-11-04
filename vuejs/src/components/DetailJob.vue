<template>
<div uk-modal="" class="uk-modal uk-open" style="display: block;">
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">{{ job.name }}</h2>
        <p>{{ job.announcement }}</p>
        <p>{{ job.requirements }}</p>
        <p>{{ job.duties }}</p>
        <p>{{ job.contacts }}</p>
        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button" @click="setClose">Закрыть</button>
        </p>
    </div>
</div>
</template>

<script>
export default {
  name: 'DetailJob',
  props: {
    job: Object,
    handlerCloseJob: {
        type: Function
    }
  },
  methods: {
    setClose() {
      this.$emit('set-show', false);
    }
  }
};
</script>