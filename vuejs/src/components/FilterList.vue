<template>
    <div class="uk-card uk-card-default uk-card-body uk-width-1-4 uk-card-small">
        <div class="uk-width-1-1@s">       
            <ul class="uk-nav-default uk-nav-parent-icon uk-nav" uk-nav="">
                <li class="uk-active" v-for="i in categories" :key="i.name"><a @click="removeItem(i)">{{ i.name }}</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
import dataFactory from "../factories";
import { onMounted, computed } from "vue";
export default {
  setup() {
    let { load, removeItem, categories } = dataFactory();
    onMounted(async () => await load());
    computed(() => {
        console.log(1);
    });
    return {
      categories,
      removeItem
    };
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
