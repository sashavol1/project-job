import axios from "axios";
import { ref } from "vue";

export default function () {

  const categories = ref([]);

  async function load() {
    let result = await axios.post("http://job.loc/api/get_categories/");
    console.log(result);
    categories.value.splice(0, categories.value.length, ...result.data);
  }

  function removeItem(item) {
    let index = categories.value.indexOf(item);
    if (index > -1) {
      categories.value.splice(index, 1);
    }
  }

  return {
    categories,
    load,
    removeItem
  };
}