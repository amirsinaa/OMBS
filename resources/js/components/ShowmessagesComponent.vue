<template>
  <div class="container"  style="margin-top:20px;">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <button @click="loadMessages"  id="load_messages_btn"  type="button" class="btn btn-primary">Show  message(s) ({{messages_count}})</button>
        <div v-for="(message, index) in messages">
          <div class="alert alert-info" role="alert">
            {{message.sender.name}}:{{ message.message }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
  props: ['workuri', 'bidid','messages_count'],
    data() {
      return {
        messages: [],
      }
    },
    methods:{
      loadMessages(){
        $("#load_messages_btn").hide();
        axios.get(this.workuri+ '/message/get/' + this.bidid).then(response => {
              //console.log("messages: "+ response.data.messages);
          this.messages = response.data.messages;
        });
      },
    },
    mounted() {
      //console.log('Component mounted.');
      // this.loadMessages();
    }
  }
</script>