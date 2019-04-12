<template>
    <div class="card insCard" :id="card">
        <div class="row no-margin-row controls-panel">
            <div class="col-6">
                <img :src="imgLink" alt="Logo Img" class="img_logo">
            </div>
            <p class="col-3 prem">
                <b>{{ this.cardData.prem }}</b>
                <span class="fa fa-rub"></span>
            </p>
            <div class="col-3">
                <a class="btn" v-on:click="buyInsurance()">Купить</a>
            </div>
        </div>

        <div class="tabs">

            <div class="row no-margin-row button-panel">
                <div class="col-4">
                    <button :class="{active: assistanceActive}" v-on:click="selectTab('assistance')">Ассистанс</button>
                </div>
                <div class="col-4">
                    <button :class="{active: franchiseActive}" v-on:click="selectTab('franchise')">Франшиза</button>
                </div>
                <div class="col-4">
                    <button :class="{active: rulesActive}" v-on:click="selectTab('rules')">Правила страхования</button>
                </div>
            </div>

            <section v-if="assistanceActive">
                <p>{{ this.cardData.assistance }}</p>
            </section>
            <section v-if="franchiseActive">
                <p>{{ this.cardData.franchise }}</p>
            </section>
            <section v-if="rulesActive">
                <p>{{ this.cardData.rules }}</p>
            </section>

        </div>
        
    </div>
</template>
<style>

</style>
<script>
    export default{
        data(){
            return{
                card: String,
                imgLink: String,
                assistanceActive: true,
                franchiseActive: false,
                rulesActive: false
            }
        },
        props: ['cardData'],
        mounted () {
            this.mount();
        },

        methods: {
            mount:function () {
                this.card = this.cardData.card;
                this.imgLink =  "/assets/img/logo-" + this.card + ".png";
                //console.log ('card mounted, id:' + this.card);
            },
            buyInsurance:function () {
                console.log ('buy ' + this.card + ' card');
            },
            selectTab:function (tabId) {
                this.assistanceActive = false;
                this.franchiseActive = false;
                this.rulesActive = false;

                switch (tabId) {
                    case 'assistance':
                        this.assistanceActive = true;
                        break;
                    case 'franchise':
                        this.franchiseActive = true;
                        break;
                    case 'rules':
                        this.rulesActive = true;
                        break;

                }

            }
        }
    }
</script>
