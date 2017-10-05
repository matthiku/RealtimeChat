<template>
    <span class="small">
      <span class="badge badge-secondary mr-2"
        v-for="member,index in members"
        :key="member.index"
      >{{ member.user.name }}</span>
    </span>
</template>

<script>
  export default {
    props: [
      'members',
    ],
  }
</script>

<style>
</style>
