const fetchMultipleTokens = async (currency, currency1, currency2, currency3, currency4) => {
	const response = await fetch(`https://api.coingecko.com/api/v3/coins/${currency}/market_chart?vs_currency=usd&days=30d&interval=daily`)
	const response1 = await fetch(`https://api.coingecko.com/api/v3/coins/${currency1}/market_chart?vs_currency=usd&days=30d&interval=daily`)
	const response2 = await fetch(`https://api.coingecko.com/api/v3/coins/${currency2}/market_chart?vs_currency=usd&days=30d&interval=daily`)
	const response3 = await fetch(`https://api.coingecko.com/api/v3/coins/${currency3}/market_chart?vs_currency=usd&days=30d&interval=daily`)
	const response4 = await fetch(`https://api.coingecko.com/api/v3/coins/${currency4}/market_chart?vs_currency=usd&days=30d&interval=daily`)

	const data = await response.json()
	const data1 = await response1.json()
	const data2 = await response2.json()
	const data3 = await response3.json()
	const data4 = await response4.json()

	const times = data.prices.map(e => e[0])
	const prices = data.prices.map(e => e[1])
	const prices1 = data1.prices.map(e => e[1])
	const prices2 = data2.prices.map(e => e[1])
	const prices3 = data3.prices.map(e => e[1])
	const prices4 = data4.prices.map(e => e[1])

	return { times, prices, prices1, prices2, prices3, prices4 }
}

let { times, prices, prices1, prices2, prices3, prices4 } = await fetchMultipleTokens('uniswap', 'terra-luna', 'chainlink', 'thorchain', 'pancakeswap-token')

const config = {
  type: 'line',
	data: {
		labels: times,
		datasets: [{
			label: 'Uniswap',
			backgroundColor: 'rgba(244,6,119,1)',
			borderColor: 'rgba(244,6,119,1)',
			borderWidth: 5,
			data: prices,
			fill: false,
			pointHitRadius: 10,
      pointRadius: 0,
      tension: .2,
			order: 3,
		},
		{
			label: 'Terra',
			backgroundColor: 'rgba(255,217,82,1)',
			borderColor: 'rgba(255,217,82,1)',
			borderWidth: 5,
			data: prices1,
			fill: false,
			pointHitRadius: 10,
      pointRadius: 0,
      tension: .2,
			order: 1,
		},
		{
			label: 'Chainlink',
			backgroundColor: 'rgba(51,93,210,1)',
			borderColor: 'rgba(51,93,210,1)',
			borderWidth: 5,
			data: prices2,
			fill: false,
			pointHitRadius: 10,
      pointRadius: 0,
      tension: .2,
			order: 2,
		},
 		{
			label: 'THORChain',
			backgroundColor: 'rgba(0,242,177,1)',
			borderColor: 'rgba(0,242,177,1)',
			borderWidth: 5,
			data: prices3,
			fill: false,
			pointHitRadius: 10,
      pointRadius: 0,
      tension: .2,
			order: 5,
		},
		{
			label: 'PancakeSwap',
			backgroundColor: 'rgba(209,136,79,1)',
		 	borderColor: 'rgba(209,136,79,1)',
			borderWidth: 5,
			data: prices4,
			fill: false,
			pointHitRadius: 10,
      pointRadius: 0,
      tension: .2,
			order: 4,
	 }]
	},
  options: {
		responsive: true,
		tooltips: {
			mode: 'index',
			intersect: false,
		},
		hover: {
			mode: 'nearest',
			intersect: true
		},
		scales: {
			xAxes: { display: false },
			yAxes: { display: true }
		},
		plugins: {
			title: { display: false },
			legend: { display: false },
			tooltip: {
				backgroundColor: 'rgba(255, 255, 255, 0.9)',
				bodyColor: '#000',
				bodyFont: { family: 'Poppins', size: '14' },
				displayColors: false,
				callbacks: { title: function() {} }
			}
		}
	}
}

const chart = new Chart( document.getElementById('defi-chart').getContext('2d'), config )
