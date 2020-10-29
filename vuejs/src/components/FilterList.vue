<template>
    <div class="uk-card uk-card-default uk-card-body uk-width-1-4 uk-card-small">
        <div class="uk-width-1-1@s">       
            <ul class="uk-nav-default uk-nav-parent-icon uk-nav" uk-nav="">
                <li class="uk-active" v-for="i in categories" :key="i.name"><a @click="setCategory(i.id)">{{ i.name }}</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
import categoryFactory from "../factories/category";
import jobFactory from "../factories/jobs";
import { onMounted } from "vue";
export default {
  setup() {
    let { load, removeItem, categories } = categoryFactory();
    let { setCategory } = jobFactory();
    onMounted(async () => await load());
    return {
      categories,
      removeItem,
      setCategory
    };
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
