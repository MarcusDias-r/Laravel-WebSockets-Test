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
                <div class="photo-frame"
                :class="(onlineFriendsArray.includes(user.id))?'onlineStatus':'offline'"
                >
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
        users:[],
        onlineFriendsArray:[],
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

    },

    async userStatus(){
        let response =  await axios.get(route('is.online'));
        this.onlineFriendsArray = response.data;
    }

  },

  mounted(){
        this.getUsers();
        this.userStatus();

        setInterval(()=>{
            
            this.userStatus();

        }, 60000)
  }

})
</script>
<style>

    .onlineStatus{
        border: 1px solid rgb(28, 196, 28);
        box-shadow: 0px 0px 6px rgb(28, 196, 28);
    }

</style>
