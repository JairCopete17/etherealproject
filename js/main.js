const api_status = "https://api.coingecko.com/api/v3/ping"

const api_bitcoin = "https://api.coingecko.com/api/v3/coins/bitcoin?tickers=false&market_data=true&community_data=false&developer_data=false&sparkline=false"
const api_ethereum = "https://api.coingecko.com/api/v3/coins/ethereum?tickers=false&market_data=true&community_data=false&developer_data=false&sparkline=false"
const api_solana = "https://api.coingecko.com/api/v3/coins/solana?tickers=false&market_data=true&community_data=false&developer_data=false&sparkline=false"
const api_terra = "https://api.coingecko.com/api/v3/coins/terra-luna?tickers=false&market_data=true&community_data=false&developer_data=false&sparkline=false"
const api_chainlink = "https://api.coingecko.com/api/v3/coins/chainlink?tickers=false&market_data=true&community_data=false&developer_data=false&sparkline=false"
const api_uniswap = "https://api.coingecko.com/api/v3/coins/uniswap?tickers=false&market_data=true&community_data=false&developer_data=false&sparkline=false"
const api_pancakeswap = "https://api.coingecko.com/api/v3/coins/pancakeswap-token?tickers=false&market_data=true&community_data=false&developer_data=false&sparkline=false"
const api_thorchain = "https://api.coingecko.com/api/v3/coins/thorchain?tickers=false&market_data=true&community_data=false&developer_data=false&sparkline=false"


setTimeout(async function getStatus() {
	const response = await fetch(api_status)
	const data = await response.json()
	/* document.getElementById("status").innerHTML = data.gecko_says */
	console.log(data.gecko_says)
}, 500);

const formatNumberWithSuffixes = (value) => {
	const suffixes = ['', 'K', 'M', 'B', 'T'];
	let suffixNum = 0;
	while (value >= 1000) {
		value /= 1000;
		suffixNum++;
	}
	return value.toFixed(2) + suffixes[suffixNum];
}

async function getCoins() {
	const response = await Promise.all([
		fetch(api_bitcoin),
		fetch(api_ethereum),
		fetch(api_solana),
		fetch(api_terra),
		fetch(api_chainlink),
		fetch(api_uniswap),
		fetch(api_pancakeswap),
		fetch(api_thorchain)
	])

	const data = await Promise.all([
		response[0].json(),
		response[1].json(),
		response[2].json(),
		response[3].json(),
		response[4].json(),
		response[5].json(),
		response[6].json(),
		response[7].json()
	])

	const bitcoin = data[0]
	const ethereum = data[1]
	const solana = data[2]
	const terra = data[3]
	const chainlink = data[4]
	const uniswap = data[5]
	const pancakeswap = data[6]
	const thorchain = data[7]

	document.getElementById("bitcoin-image").src = bitcoin.image.thumb
	document.getElementById("bitcoin-link").href = bitcoin.links.homepage[0]
	document.getElementById("bitcoin-price").innerHTML = `$${bitcoin.market_data.current_price.usd}`
	if (bitcoin.market_data.price_change_percentage_24h >= 0) {
		document.getElementById("bitcoin-change").style.color = '#4eaf0a';
		document.getElementById("bitcoin-change").innerHTML = `+${bitcoin.market_data.price_change_percentage_24h.toFixed(3)}%`
	}	else {
		document.getElementById("bitcoin-change").style.color = '#e15241';
		document.getElementById("bitcoin-change").innerHTML = `${bitcoin.market_data.price_change_percentage_24h.toFixed(3)}%`
	}
	document.getElementById("bitcoin-marketcap").innerHTML = formatNumberWithSuffixes(bitcoin.market_data.market_cap.usd)

	document.getElementById("ethereum-image").src = ethereum.image.thumb
	document.getElementById("ethereum-link").href = ethereum.links.homepage[0]
	document.getElementById("ethereum-price").innerHTML = `$${ethereum.market_data.current_price.usd}`
	if (ethereum.market_data.price_change_percentage_24h >= 0) {
		document.getElementById("ethereum-change").style.color = '#4eaf0a';
		document.getElementById("ethereum-change").innerHTML = `+${ethereum.market_data.price_change_percentage_24h.toFixed(3)}%`
	}	else {
		document.getElementById("ethereum-change").style.color = '#e15241';
		document.getElementById("ethereum-change").innerHTML = `${ethereum.market_data.price_change_percentage_24h.toFixed(3)}%`
	}
	document.getElementById("ethereum-marketcap").innerHTML = formatNumberWithSuffixes(ethereum.market_data.market_cap.usd)

	document.getElementById("solana-image").src = solana.image.thumb
	document.getElementById("solana-link").href = solana.links.homepage[0]
	document.getElementById("solana-price").innerHTML = `$${solana.market_data.current_price.usd}`
	if (solana.market_data.price_change_percentage_24h >= 0) {
		document.getElementById("solana-change").style.color = '#4eaf0a';
		document.getElementById("solana-change").innerHTML = `+${solana.market_data.price_change_percentage_24h.toFixed(3)}%`
	}	else {
		document.getElementById("solana-change").style.color = '#e15241';
		document.getElementById("solana-change").innerHTML = `${solana.market_data.price_change_percentage_24h.toFixed(3)}%`
	}

	document.getElementById("terra-image").src = terra.image.thumb
	document.getElementById("terra-link").href = terra.links.homepage[0]
	document.getElementById("terra-price").innerHTML = `$${terra.market_data.current_price.usd}`
	if (terra.market_data.price_change_percentage_24h >= 0) {
		document.getElementById("terra-change").style.color = '#4eaf0a';
		document.getElementById("terra-change").innerHTML = `+${terra.market_data.price_change_percentage_24h.toFixed(3)}%`
	}	else {
		document.getElementById("terra-change").style.color = '#e15241';
		document.getElementById("terra-change").innerHTML = `${terra.market_data.price_change_percentage_24h.toFixed(3)}%`
	}

	document.getElementById("chainlink-image").src = chainlink.image.thumb
	document.getElementById("chainlink-link").href = chainlink.links.homepage[0]
	document.getElementById("chainlink-price").innerHTML = `$${chainlink.market_data.current_price.usd}`
	if (chainlink.market_data.price_change_percentage_24h >= 0) {
		document.getElementById("chainlink-change").style.color = '#4eaf0a';
		document.getElementById("chainlink-change").innerHTML = `+${chainlink.market_data.price_change_percentage_24h.toFixed(3)}%`
	}	else {
		document.getElementById("chainlink-change").style.color = '#e15241';
		document.getElementById("chainlink-change").innerHTML = `${chainlink.market_data.price_change_percentage_24h.toFixed(3)}%`
	}

	document.getElementById("uniswap-image").src = uniswap.image.thumb
	document.getElementById("uniswap-link").href = uniswap.links.homepage[0]
	document.getElementById("uniswap-price").innerHTML = `$${uniswap.market_data.current_price.usd}`
	if (terra.market_data.price_change_percentage_24h >= 0) {
		document.getElementById("uniswap-change").style.color = '#4eaf0a';
		document.getElementById("uniswap-change").innerHTML = `+${uniswap.market_data.price_change_percentage_24h.toFixed(3)}%`
	}	else {
		document.getElementById("uniswap-change").style.color = '#e15241';
		document.getElementById("uniswap-change").innerHTML = `${uniswap.market_data.price_change_percentage_24h.toFixed(3)}%`
	}

	document.getElementById("pancakeswap-image").src = pancakeswap.image.thumb
	document.getElementById("pancakeswap-link").href = pancakeswap.links.homepage[0]
	document.getElementById("pancakeswap-price").innerHTML = `$${pancakeswap.market_data.current_price.usd}`
	if (pancakeswap.market_data.price_change_percentage_24h >= 0) {
		document.getElementById("pancakeswap-change").style.color = '#4eaf0a';
		document.getElementById("pancakeswap-change").innerHTML = `+${pancakeswap.market_data.price_change_percentage_24h.toFixed(3)}%`
	}	else {
		document.getElementById("pancakeswap-change").style.color = '#e15241';
		document.getElementById("pancakeswap-change").innerHTML = `${pancakeswap.market_data.price_change_percentage_24h.toFixed(3)}%`
	}

	document.getElementById("thorchain-image").src = thorchain.image.thumb
	document.getElementById("thorchain-link").href = thorchain.links.homepage[0]
	document.getElementById("thorchain-price").innerHTML = `$${thorchain.market_data.current_price.usd}`
	if (thorchain.market_data.price_change_percentage_24h >= 0) {
		document.getElementById("thorchain-change").style.color = '#4eaf0a';
		document.getElementById("thorchain-change").innerHTML = `+${thorchain.market_data.price_change_percentage_24h.toFixed(3)}%`
	}	else {
		document.getElementById("thorchain-change").style.color = '#e15241';
		document.getElementById("thorchain-change").innerHTML = `${thorchain.market_data.price_change_percentage_24h.toFixed(3)}%`
	}
}

getCoins()