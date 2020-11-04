<template>
    <div class="uk-card uk-card-default uk-card-body uk-width-1-4 uk-card-small">
        <div class="uk-width-1-1@s">
            <ul class="uk-nav-default uk-nav-parent-icon uk-nav" uk-nav="">
                <li v-bind:class="{ 'uk-active': i.id === isActiveId }" v-for="i in categories" :key="i.name"><a @click="setCategory(i.id)">{{ i.name }}</a></li>
            </ul>
        </div>
        <hr>
        <label for="">Вознаграждение, руб.</label>
        <div class="uk-column-1-2@s">
          <div class="uk-margin">
            <input class="uk-input uk-form-width-medium uk-form-small" type="text" placeholder="От" v-model="salaryFrom" @change="setFilter" @keypress="isNumber" />
          </div>
          <div class="uk-margin">
            <input class="uk-input uk-form-width-medium uk-form-small" type="text" placeholder="До" v-model="salaryTo" @change="setFilter" @keypress="isNumber" />
          </div>
        </div>
        <hr>
        <button class="uk-button uk-button-default uk-width-1-1" @click="resetFilter">Сбросить фильтры ( {{ (isActiveId != '' ? 1 : 0) + (salaryFrom != '' ? 1 : 0) + (salaryTo != '' ? 1 : 0) }} )</button>
    </div>
</template>

<script>
export default {
  name: 'FilterList',
  props: {
    categories: Array,
    handlerSetCategory: {
        type: Function
    },
    handlerSetSalary: {
        type: Function
    }
  },
  data () {
    return {
        isActiveId: '',
        salaryFrom: '',
        salaryTo: ''
    }
  },
  methods: {
    isNumber: function(evt) {
      evt = (evt) ? evt : window.event;
      let charCode = (evt.which) ? evt.which : evt.keyCode;
      if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
        evt.preventDefault();
      } else {
        return true;
      }
    },
    resetFilter() {
      this.isActiveId =  '';
      this.salaryFrom =  '';
      this.salaryTo =  '';
      this.setFilter();
    },
    setCategory(id = 0) {
      this.isActiveId = id;
      this.setFilter();
    },
    setFilter() {
      this.$emit('set-filter', {from: this.salaryFrom, to: this.salaryTo, category_id: this.isActiveId });
    }
  }
};
</script>