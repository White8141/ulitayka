<template>
    <div class="card insCard" >
        <h1>Карта компании</h1>
        <!--div class="row no-margin-row controls-panel">
            <div class="col-6">
                <img src="/assets/img/logo-alpha.png" alt="Alpha-Logo" class="img_logo">
            </div>
            <p class="col-3 prem">
                <b></b>
                <span class="fa fa-rub"></span>
            </p>
            <div class="col-3">
                <a class="btn" onclick=sendCalc('alpha')>Купить</a>
            </div>
        </div>

        <div class="tabs">
            <div class="row no-margin-row button-panel">
                <div class="col-4">
                    <button class="assistance" data-name="assistance">Ассистанс</button>
                </div>
                <div class="col-4">
                    <button data-name="franchise">Франшиза</button>
                </div>
                <div class="col-4">
                    <button data-name="rules">Правила страхования</button>
                </div>
            </div>

            <section class="assistance">
                <p></p>
            </section>
            <section class="franchise">
                <p></p>
            </section>
            <section class="rules">
                <p></p>
            </section>
        </div-->

    </div>
</template>
<style>

</style>
<script>
    export default{
        data(){
            return{
                msg:'hello vue'
            }
        },
        props: ['card-data'],
        mounted () {
            this.mount();
        },

        methods: {
            mount:function () {
                console.log ('card mounted');
            }
        }
    }
</script>
