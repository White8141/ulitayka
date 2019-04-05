Vue.component('company-card', require ('../components/CompanyCard.vue'));

var vm = new Vue ({
    el: '#calculator',
    data: {
        testData: 'testData',
        cardArray: [
            {name: 'alpha', prem: 667,  assistance: 'Alpha'},
            {name: 'vsk',   prem: 1200, assistance: 'Vsk'}
        ]
    }
});

console.log ('vm mounted');

