<template>
    <section id="appContent">

        <div class="appContainer">

            <main class="app-window">

                <left-bar></left-bar>
                <chat-area></chat-area>

            </main>

        </div>

    </section>
</template>
<script>

import LeftBar  from '@/Components/LeftBar'
import ChatArea from '@/Components/ChatArea'

export default ({
    
    components:{
        LeftBar,
        ChatArea,
    },
    methods:{

        

    },
    mounted(){



    }


})
</script>
