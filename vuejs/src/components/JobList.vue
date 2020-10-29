<template>
    <div class="uk-width-1-2 uk-card-small uk-margin-left">
        <div class="uk-card uk-card-default uk-width-1-1@m uk-margin" v-for="i in jobs" :key="i.name">
            <div class="uk-card-header">
                <div class="uk-grid-small uk-flex-middle uk-grid" uk-grid="">
                    <div class="uk-width-auto uk-first-column">
                        <img class="uk-border-circle" width="40" height="40" v-bind:src="'http://job.loc/' + i.user_avatar">
                    </div>
                    <div class="uk-width-expand">
                        <h3 class="uk-card-title uk-margin-remove-bottom">{{i.name}} {{i.id}}</h3>
                        <p class="uk-text-meta uk-margin-remove-top"><time datetime="{{i.dt_add}}">{{i.dt_add}}</time> | {{i.user_name}}</p>
                    </div>
                </div>
            </div>
            <div class="uk-card-body">
                <p>{{i.announcement}}</p>
            </div>
            <div class="uk-card-footer">
                <a class="uk-button uk-button-text">Подробнее</a>
                <a class="uk-button uk-button-text" @click="removeItem(i)">Подробнее</a>
            </div>
        </div>
    </div>
</template>

<script>
import dataFactory from "../factories/jobs";
import { onMounted } from "vue";
export default {
  setup() {
    let { load, removeItem, jobs } = dataFactory();
    onMounted(async () => await load());
    return {
      jobs,
      removeItem
    };
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped></style>
