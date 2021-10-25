const bitcoinChart = document.getElementById('bitcoin-chart').getContext('2d')

const btcData = async () => {
	const response = await fetch(`https://api.coingecko.com/api/v3/coins/bitcoin/market_chart?vs_currency=usd&days=30d&interval=daily`)
	const data = await response.json()
	const times = data.prices.map(e => e[0])
	const prices = data.prices.map(e => e[1])
	return { times, prices }
}

async function createBtcChart() {
  let { times, prices } = await btcData()

  let gradient = bitcoinChart.createLinearGradient(0, 0, 0, 400)
  gradient.addColorStop(0, 'rgba(247,147,26,.5)')
  gradient.addColorStop(.85, 'rgba(255,193,119,0)')

  const data = {
      labels: times,
      datasets: [{
        backgroundColor: gradient,
        borderCapStyle: 'round',
        borderColor: 'rgba(247,147,26,1)',
        borderJoinStyle: 'round',
        borderWidth: 3,
        data: prices,
        fill: false,
        label: 'USD$',
        pointHitRadius: 10,
        pointRadius: 0,
        tension: .2,
    }]
  }

  const config = {
    type: 'line',
    data: data,
    options: {
      scales: {
        x: { display: false },
        y: { display: false }
      },
      plugins: {
        legend: { display: false },
        title: { display: false },
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

 let btcChart = new Chart( bitcoinChart, config )
}

createBtcChart()