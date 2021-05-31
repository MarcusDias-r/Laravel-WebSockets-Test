<template>
    
    <div class="main-area">

        <div class="main-tabs" >
            <div class="tabs" 
                v-for="chat in openChats" :key="chat"
                @click="activateChat(chat.id)"
                :class="(chat.id === activeChat)?'active':''"
            >
                {{chat.name}}
            </div>
            
        </div>

        <div class="main-area-content">

            <div class="main-feed-area">
                
                <div class="messages"
                    v-for="message in messages" :key="message.id"
                    :class="(this.loggedUser.id === message.from)? 'from-me':'from-other'"
                >
                        
                    <div class="user-info">
                        <div class="photo-frame">
                            <img src="/img/avatar.png" alt="">
                        </div>
                        <div class="name-and-date">
                            <span>{{message.user.name}}</span>
                            <small>20/20/2020</small>
                        </div>
                    </div>

                    
                    <div class="message">
                        {{message.content}}
                   </div>

                </div>
                
            </div>

            <div class="main-input-area" v-if="activeChat">
                <form @submit.prevent="sendMessage($event)">
                    <input type="hidden" name="to_user" :value="activeChat">
                    <textarea name="message" id="" cols="30" rows="1"></textarea>
                    <button>Enviar</button>
                </form>
            </div>

        </div>

    </div>

</template>
<script>
import { computed } from 'vue'
import { usePage }  from '@inertiajs/inertia-vue3'

export default({

    setup() {
        const loggedUser = computed(() => usePage().props.value.auth.user)
        return { loggedUser }
    },

    data(){
        return{
            activeChat:null,
            messages:null
        }
    },

    props:{
        openChats:Array
    },

    methods:{
        async activateChat(id){
            this.activeChat = id
            let myId     = this.loggedUser.id;

            await axios.post(route('get.messages'),{'myId':myId, 'friendId':id}).then(
                (response)=>{

                   this.messages = response.data.messages

                } 
            )
        },

        sendMessage(event){

            const {to_user, message} = Object.fromEntries(new FormData(event.target));
            axios.post(route('send.message'),{to:to_user, content:message}).then(
                ()=>{
                    console.log(this.messages);
                    this.messages.push({
                        from: this.loggedUser.id,
                        to: to_user,
                        content: message,
                        user:{
                            name:this.loggedUser.name
                        }
                    });
                }
            )
            
            

        }
    }

})
</script>
