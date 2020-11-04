<template>
    <div class="is-preload">
      <span class="uk-margin-small-right" uk-spinner="ratio: 3"></span>
    </div>
</template>

<script>
export default {
  name: 'Spinner'
}
</script>


<style>
  .is-preload {
    background-color: rgba(255,255,255, 0.8);
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 100;
    display: flex;
    align-items: center;
    justify-content: center;
  }
</style>