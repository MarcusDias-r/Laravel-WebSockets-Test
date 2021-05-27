<template>
    <section id="appContent">

        <div class="appContainer">

            <main class="app-window">

                <left-bar v-on:openChat="openChatTab"></left-bar>
                <chat-area :openChats="openChats"></chat-area>

            </main>

        </div>

    </section>
</template>
<script>

import LeftBar  from '@/Components/LeftBar'
import ChatArea from '@/Components/ChatArea'

export default ({
    data(){
        return{
            openChats:[],
        }
    },

    components:{
        LeftBar,
        ChatArea,
    },

    methods:{

        openChatTab(user){

           this.openChats.push(user)

            //Remove duplicates of multidimensional array

            let arr = this.openChats

            arr = arr.map(JSON.stringify)
                .reverse()
                .filter(
                    function(item, index, arr){ 
                        return arr.indexOf(item, index + 1) === -1; 
                    }
                )
                .reverse().map(JSON.parse)

            this.openChats = arr
        }

    },
    mounted(){



    }


})
</script>
