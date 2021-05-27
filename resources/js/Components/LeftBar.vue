<template>
     <div class="left-side-bar">

        <div class="left-tabs">
            <div class="tabs active">Amigos</div>
            <div class="tabs">Grupos</div>
        </div>

        <div class="friends-list">

            <div class="user-card user-active">
                <div class="photo-frame">
                    <img src="/img/avatar.png" alt="">
                </div>

                <div class="user-name">
                    <span>User Name</span>
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

        // axios.get(route('users.all')).then(
        //     (response)=>{
        //         this.users = response.data
        //         console.log(this.users);
        //     }
        // )
    }

  },

  mounted(){
      this.getUsers();
  }

})
</script>
