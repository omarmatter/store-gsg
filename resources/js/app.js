require('./bootstrap');

require('alpinejs');

window.Echo.private('orders')
.listen('.order.created',function(event){
alert(`new order created  ${event.order.number}`)
})
