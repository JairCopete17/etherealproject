const selectElement = document.getElementById('product-select')
const selectQuantity = document.getElementById('product-quantity')
const productValue = document.getElementById('product-value')
const productTotal = document.getElementById('product-total')

selectElement.addEventListener('change', (e) => {
	if (e.target.value == 'null') { productValue.innerHTML = '' }
	else if (e.target.value == 'portf') { productValue.innerHTML = 'Valor unitario: USD$5' }
	else if (e.target.value == 'nft') { productValue.innerHTML = 'Valor unitario: USD$15' }
	else if (e.target.value == 'hot') { productValue.innerHTML = 'Valor unitario: USD$25' }
	else if (e.target.value == 'ai') { productValue.innerHTML = 'Valor unitario: USD$50' }
})

selectQuantity.addEventListener('change', (e) => {
	if (e.target.value != null) {
		let quantity = e.target.value
		let value = productValue.innerHTML.split('$')[1]
		let total = quantity * value
		productTotal.innerHTML = 'USD$' + total
		document.getElementById('orderform').action = window.location.href.split('#')[0] + "?ordertotal=" + total
	}
})
