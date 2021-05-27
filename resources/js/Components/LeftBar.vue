<template>
     <div class="left-side-bar">

        <div class="left-tabs">
            <div class="tabs active">Amigos</div>
            <div class="tabs">Grupos</div>
        </div>

        <div class="friends-list">

            <div class="user-card user-active" 
                v-for="user in users" :key="user.id"
                @click="openChat(user)"
            >
                <div class="photo-frame">
                    <img src="/img/avatar.png" alt="">
                </div>

                <div class="user-name">
                    <span>{{user.name}}</span>
                </div>
            </div>

        </div>
    </div>
</template>

<script>

export default ({

  data(){
    return{
        users:[]
    }
  },
  
  methods:{

    getUsers(){

        axios.get(route('users.all')).then(
            (response)=>{
                this.users = response.data
            }
        )
    },

    openChat(user){

        this.$emit('openChat', user);

    }

  },

  mounted(){
      this.getUsers();
  }

})
</script>
