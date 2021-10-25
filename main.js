const api_status = "https://api.coingecko.com/api/v3/ping"

const api_bitcoin = "https://api.coingecko.com/api/v3/coins/bitcoin?tickers=false&market_data=true&community_data=false&developer_data=false&sparkline=false"
const api_ethereum = "https://api.coingecko.com/api/v3/coins/ethereum?tickers=false&market_data=true&community_data=false&developer_data=false&sparkline=false"
const api_solana = "https://api.coingecko.com/api/v3/coins/solana?tickers=false&market_data=true&community_data=false&developer_data=false&sparkline=false"

setTimeout(async function getStatus() {
	const response = await fetch(api_status)
	const data = await response.json()
	document.getElementById("status").innerHTML = data.gecko_says
}, 500);

async function getCoins() {
	const response = await Promise.all([
		fetch(api_bitcoin),
		fetch(api_ethereum),
		fetch(api_solana)
	])

	const data = await Promise.all([
		response[0].json(),
		response[1].json(),
		response[2].json()
	])

	const bitcoin = data[0]
	const ethereum = data[1]
	const solana = data[2]

	document.getElementById("bitcoin-image").src = bitcoin.image.thumb
	document.getElementById("bitcoin-link").href = bitcoin.links.homepage[0]
	document.getElementById("bitcoin-price").innerHTML = `$${bitcoin.market_data.current_price.usd}`
	if (bitcoin.market_data.price_change_percentage_24h >= 0) {
		document.getElementById("bitcoin-change").style.color = '#4eaf0a';
		document.getElementById("bitcoin-change").innerHTML = `+${bitcoin.market_data.price_change_percentage_24h}%`
	}	else {
		document.getElementById("bitcoin-change").style.color = '#e15241';
		document.getElementById("bitcoin-change").innerHTML = `${bitcoin.market_data.price_change_percentage_24h}%`
	}
	document.getElementById("bitcoin-trade").href = `https://ftx.com/trade/${bitcoin.symbol}/USD`

	document.getElementById("ethereum-image").src = ethereum.image.thumb
	document.getElementById("ethereum-link").href = ethereum.links.homepage[0]
	document.getElementById("ethereum-price").innerHTML = `$${ethereum.market_data.current_price.usd}`
	if (ethereum.market_data.price_change_percentage_24h >= 0) {
		document.getElementById("ethereum-change").style.color = '#4eaf0a';
		document.getElementById("ethereum-change").innerHTML = `+${ethereum.market_data.price_change_percentage_24h}%`
	}	else {
		document.getElementById("ethereum-change").style.color = '#e15241';
		document.getElementById("ethereum-change").innerHTML = `${ethereum.market_data.price_change_percentage_24h}%`
	}
	document.getElementById("ethereum-trade").href = `https://ftx.com/trade/${ethereum.symbol}/USD`

	document.getElementById("solana-price").innerHTML = `$${solana.market_data.current_price.usd}`
	document.getElementById("solana-change").innerHTML = solana.market_data.price_change_percentage_24h
}

getCoins()