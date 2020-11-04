import axios from "axios";
import { reactive, toRefs } from "vue";
import { apiUrl } from "./../utils.js";

export default function () {

  const state = reactive({
    categories: []
  })

  async function loadCategories() {
    let result = await axios.post(apiUrl + "api/get_categories/");
    if (result.status === 200) {
      state.categories.splice(0, state.categories.length, ...result.data);
    }
  }

  return {
    ...toRefs(state),
    loadCategories
  };
}