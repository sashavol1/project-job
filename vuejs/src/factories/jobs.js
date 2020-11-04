import axios from "axios";
import { reactive, toRefs } from "vue";
import { apiUrl } from "./../utils.js";

export default function () {

  const state = reactive({
    job: {},
    jobs: [],
    isLoad: false
  })

  async function loadJobs(params = []) {
    state.isLoad = true;
    let result = await axios.post(apiUrl + "api/get_jobs/?" + Object.keys(params).map(key => `${key}=${params[key]}`).join("&"));
    if (result.status === 200) {
      state.jobs.splice(0, state.jobs.length, ...result.data);
    }

    setTimeout(function () {
      state.isLoad = false;
    }, 500);
  }

  async function loadJob(params = []) {
    state.isLoad = true;
    let result = await axios.post(apiUrl + "api/get_job/?" + Object.keys(params).map(key => `${key}=${params[key]}`).join("&"));
    if (result.status === 200) {
      state.job = result.data[0]; // \__()__/
    }

    setTimeout(function () {
      state.isLoad = false;
    }, 500);
  }

  // function setCategory(id) {
  //   loadJobs({category_id: Number(id)});
  // }

  return {
    ...toRefs(state),
    loadJobs,
    loadJob
  };
}