import axios from "axios";
import { ref } from "vue";

export default function () {

  const jobs = ref([]);

  async function load(params = []) {
    let result = await axios.post("http://job.loc/api/get_jobs/?" + Object.keys(params).map(key => `${key}=${params[key]}`).join("&"));
    if (result.status === 200) {
      jobs.value.splice(0, jobs.value.length, ...result.data);
    }
  }

  function removeItem(item) {
    let index = jobs.value.indexOf(item);
    if (index > -1) {
      jobs.value.splice(index, 1);
    }
  }

  function setCategory(id) {
    load({category_id: Number(id)});
  }

  return {
    jobs,
    load,
    removeItem,
    setCategory
  };
}