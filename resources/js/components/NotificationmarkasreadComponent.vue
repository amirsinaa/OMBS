<template>
  <button @click="markNotification" class="float-right mark-as-read">Mark as read</button>
</template>

<script>
  export default {
    props: ['notification_id','workuri'],
    data() {
      return {
        id: this.notification_id,
        }
      },
      methods: {
        markNotification(){
          axios.post(this.workuri+'/mark-as-read',{
            id: this.id,
          }).then(response => {
            $('.message_ok').html(response.data);
            if(response.data.substr(0,2)=="OK"){
              $('.mark-as-read').parents('div.alert').hide('slow');
              $('.message_ok').show();
              $('.message_ok').html(response.data.substr(2));
            } else {
              $('.message_error').show();
              $('.message_error').html(response.data);
            }
          });
        },
      },
      components: {},
      mounted() {}
    }
</script>
